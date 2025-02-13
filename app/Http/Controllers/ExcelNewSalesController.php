<?php

namespace App\Http\Controllers;

use App\Events\ProcessExcelFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DateTime;
use App\Jobs\ImportExcelFile;
use App\Imports\SalesImport;
use App\Imports\ExcelImport;
use App\Imports\ExcelSalesImport;
use App\Models\Entry;
use App\Models\Member;
use App\Models\MembersProgram;
use App\Models\User;
use App\Models\Claimant;
use App\Models\Beneficiary;
use App\Models\ExcelMembers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use PHPUnit\Logging\Exception;
use Yajra\DataTables\Facades\DataTables;
use TypeError;

//List of Constants (NS)

    const TIMESTAMP = 0;
    const BRANCH = 1;
    const MARKETTING_AGENT = 2;
    const STATUS = 3;
    const PHMEMBER = 4;
    const ADDRESS = 5;
    const CIVIL_STATUS = 6;
    const BIRTHDATE = 7;
    const AGE = 8;
    const NAME = 9;
    const CONTACT_NO = 10;
    const TYPE_OF_TRANSACTION = 11;
    const WITH_REGISTRATION_FEE = 12;
    const REGISTRATION_AMOUNT = 13;
    const DAYONG_PROGRAM = 14;
    const APPLICATION_NO = 15;
    const OR_NUMBER = 16;
    const OR_DATE = 17;
    const AMOUNT_COLLECTED = 18;

    const NAME1 = 19;
    const AGE1 = 20;
    const RELATIONSHIP1 = 21;

    const NAME2 = 22;
    const AGE2 = 23;
    const RELATIONSHIP2 = 24;

    const NAME3 = 25;
    const AGE3 = 26;
    const RELATIONSHIP3 = 27;

    const NAME4 = 28;
    const AGE4 = 29;
    const RELATIONSHIP4 = 30;

//

class ExcelNewSalesController extends Controller
{
    public function index()
    {
        if(auth()->check()){

            $my_user = auth()->user();
            $members = DB::table('members')->orderBy('created_at', 'desc')->get();
            $programs = DB::table('programs')->orderBy('code')->get();
            $branches = DB::table('branches')->orderBy('branch')->get();

            return view('main', [
                'my_user' => $my_user,
                'members' => $members,
                'programs' => $programs,
                'branches' => $branches
            ])
            ->with('header_title', 'Excel New Sales')
            ->with('subview', 'dashboard-contents.settings.excel-new-sales');

        } else {
            return redirect('/');
        }
    }

    public function retrieve(Request $request)
    {
        if(auth()->check()){
            
            return DataTables::query(DB::table('excel_members'))->toJson();

        } else {
            return redirect('/');
        }   
    }

    public function destroy(Request $request)
    {
        if(auth()->check()){

            $memberProgram = DB::table('members_program')->where('id', $request->input("id"))->get();

            // Destroy Request Data
            Member::where("id", $request->input("id"))->delete();
            MembersProgram::where("id", $request->input("id"))->delete();
            
            foreach($memberProgram as $mp){
                Claimant::where("id", $mp->claimants_id)->delete();
                if($mp->beneficiaries_ids != ""){
                    $temp = explode(",", $mp->beneficiaries_ids);
                    foreach($temp as $t){
                        Beneficiary::where("id", (int)$t)->delete();
                    }
                }

            }

            return redirect('/members')->with("success_msg", "Deleted Successfully");

        } else {
            return redirect('/');
        }
    }

    public function upload(Request $request)
    {
        if(auth()->check()){

            $my_user = auth()->user();
            $validated = $request->validate([
                'upload_file' => ['required'],
                'sheetName' => ['required'],
            ]);

            $import = new ExcelSalesImport($validated['sheetName']);
            //Excel::toImport($import, $validated['upload_file']);
            (new ExcelSalesImport($validated['sheetName']))->import($validated['upload_file']);

            return redirect('/excel-new-sales')->with("success_msg", "Uploaded Successfully");

        } else {
            return redirect('/');
        }

    }

    public function parseFullName($fullName) 
    {
        // Define common name extensions
        $extensions = ['Jr.', 'Sr.', 'II', 'III', 'IV', 'V'];

        // Trim and clean up extra spaces
        $fullName = trim(preg_replace('/\s+/', ' ', $fullName));

        // Check if input is in "Last, First, Middle" or "Last, First Extension, Middle" format
        if (strpos($fullName, ',') !== false) {
            $parts = array_map('trim', explode(',', $fullName));

            $lastName = $parts[0] ?? '';
            $firstName = $parts[1] ?? '';
            $middleName = $parts[2] ?? '';

            // Split first name to check for an extension
            $firstNameParts = explode(' ', $firstName);
            if (count($firstNameParts) > 1 && in_array(end($firstNameParts), $extensions)) {
                $nameExtension = array_pop($firstNameParts);
                $firstName = implode(' ', $firstNameParts);
            } else {
                $nameExtension = '';
            }

            return [
                'fname' => ucwords(strtolower($firstName)),
                'mname' => ucwords(strtolower($middleName)),
                'lname' => ucwords(strtolower($lastName)),
                'ext' => ucwords(strtolower($nameExtension))
            ];
        }

        // Default format: "First Middle Last Extension"
        $parts = explode(' ', $fullName);
        $count = count($parts);

        $firstName = '';
        $middleName = '';
        $lastName = '';
        $nameExtension = '';

        if ($count == 1) {
            $firstName = $parts[0];
        } elseif ($count == 2) {
            $firstName = $parts[0];
            $lastName = $parts[1];
        } elseif ($count >= 3) {
            if (in_array($parts[$count - 1], $extensions)) {
                $nameExtension = $parts[$count - 1];
                array_pop($parts);
                $count--;
            }

            $firstName = $parts[0];
            $lastName = $parts[$count - 1];

            if ($count > 2) {
                $middleName = implode(' ', array_slice($parts, 1, $count - 2));
            }
        }

        return [
            'fname' => $firstName,
            'mname' => $middleName,
            'lname' => $lastName,
            'ext' => $nameExtension
        ];
    }

    public function loadSheets(Request $request)
    {
        if(auth()->check()){

            ini_set('memory_limit', '2048M');
            
  
            $validated = $request->validate(['upload_file' => ['required', 'file']]);
            //$spreadsheet = IOFactory::load($validated['upload_file']);
            $reader = IOFactory::createReaderForFile($validated['upload_file']);
            /** @var IReader $reader */
            $sheetNames = $reader->listWorksheetNames($validated['upload_file']); // No need to fully load the spreadsheet!

            return $sheetNames;

        } else {
            return redirect('/');
        }

    }

    public function print($id)
    {

        $my_user = DB::table('users')->where('id', $id)->get()[0];
        $branches = DB::table('branches')->orderBy('id')->get();
        $users = DB::table('users')->orderBy('id')->get();
        $name = 'John Wick';

        $pdf = Pdf::loadView('forms.daily-report', [
            'branches' => $branches,
            'users' => $users,
            'monthAndYear' => date('F Y'),
            'date' => date('m/d/Y'),
            'branch' => $name,
            'cashier' => $my_user->lname.' '.$my_user->fname,
        ])->setOptions(['defaultFont' => 'Courier']);

        return $pdf->stream('daily-report.pdf');
    }

    public function viewDetails($id)
    {
        $my_user = auth()->user();
        $member = DB::table('members')->where('id', $id)->get();
        $member_program = DB::table('members_program')->where('member_id', $id)->get();
        $claimant = DB::table('claimants')->where('id', $member_program[0]->claimants_id)->get();
        $arr = explode(",", $member_program[0]->beneficiaries_ids); array_pop($arr);
        $beneficiaries = DB::table('beneficiaries')->whereIn('id', $arr)->get();
        $branches = DB::table('branches')->where('id', $member_program[0]->branch_id)->get();
        $programs = DB::table('programs')->where('id', $member_program[0]->program_id)->get();
        
        if(auth()->check()){

            return view('dashboard-contents.modules.members-view', [
                'id' => $id,
                'member' => $member[0],
                'member_program' => $member_program[0],
                'claimant' => $claimant[0],
                'beneficiaries' => $beneficiaries,
                'programs' => $programs[0],
                'branches' => $branches[0]
            ]);

        } 
    }

    public function editDetails($id)
    {
        $my_user = auth()->user();

        $branches = DB::table('branches')->orderBy('id')->get();
        $programs = DB::table('programs')->orderBy('id')->get();

        $member = DB::table('members')->where('id', $id)->get();
        $member_program = DB::table('members_program')->where('member_id', $id)->get();
        $claimant = DB::table('claimants')->where('id', $member_program[0]->claimants_id)->get();
        $arr = explode(",", $member_program[0]->beneficiaries_ids); array_pop($arr);
        $beneficiaries = DB::table('beneficiaries')->whereIn('id', $arr)->get();

        
        $branch_one = DB::table('branches')->where('id', $member_program[0]->branch_id)->get();
        $program_one = DB::table('programs')->where('id', $member_program[0]->program_id)->get();
        
        if(auth()->check()){

            return view('dashboard-contents.modules.members-edit', [
                'id' => $id,
                'member' => $member[0],
                'member_program' => $member_program[0],
                'claimant' => $claimant[0],
                'beneficiaries' => $beneficiaries,
                'programs' => $programs,
                'branches' => $branches,
                'branch_one' => $branch_one[0],
                'program_one' => $program_one[0],
            ]);

        } 
    }

    public function importMembers()
    {
        set_time_limit(240);
        $programs = DB::table('programs')->orderBy('code')->get();
        $branches = DB::table('branches')->orderBy('branch')->get();
        $toImportMembers = DB::table('excel_members')->orderBy('id')->skip(0)->take(500)->get();

        foreach($toImportMembers as $toImport) {
            if($toImport->timestamp != "" && trim(strtolower($toImport->type_of_transaction)) == "new sales"){

                // Check if Marketting Agent in the User List
                // If not, Create Default User for Agent
                $name = ucwords(strtolower(trim($toImport->marketting_agent)), " .");
                if(strpos($name, ",") > 0){
                    $tmp = explode(",", $name);
                    $fname = ucwords($tmp[1]);
                    $lname = ucwords($tmp[0]);
                } else {
                    $fname = substr($name, strpos($name, " ") + 1);
                    $lname = substr($name, 0, strpos($name, " "));
                }
                
                $users = DB::table('users')->where('lname', $lname)
                ->where('fname', 'LIKE', $fname)->get();

                // Get Next Auto Increment
                $statement = DB::select("SHOW TABLE STATUS LIKE 'users'");
                $user_id = $statement[0]->Auto_increment;

                if(count($users) == 0){
                    // Save User Data
                    $newuser = new User();

                    $newuser->username = strtolower($lname);
                    $newuser->usertype = 3;
                    $newuser->fname = $fname;
                    $newuser->lname = $lname;
                    $newuser->profile_pic = "default.png";
                    $newuser->password = "password";

                    $newuser->save();
                } else {
                    $user_id = $users[0]->id;
                }

                // Get Next Auto Increment
                $statement = DB::select("SHOW TABLE STATUS LIKE 'members'");
                $member_id = $statement[0]->Auto_increment;
                
                // Save Request Data (Member's Personal Information)
                $member = new Member();

                $name = ucwords(strtolower(trim($toImport->phmember)), " .");
                if(strpos($name, ",") > 0){
                    $tmp = explode(",", $name);
                    $member->fname = ucwords($tmp[1]);
                    $member->lname = ucwords($tmp[0]);
                } else {
                    $member->fname = substr($name, strpos($name, " ") + 1);
                    $member->lname = substr($name, 0, strpos($name, " "));
                }

                $members = DB::table('members')
                ->where('lname', $member->lname)
                ->where('fname', 'LIKE', $member->fname)
                ->get();

                //$anotherMembers = DB::table('members')->where('or_number', $toImport->or_number)->get();
                //$excel_members = DB::table('excel_members')->where('or_number', $toImport->or_number)->get();

                if(count($members) == 0){

                    if(trim($toImport->birthdate) != ""){
                        $birthdate = $this->excelTimestampToString((float)trim($toImport->birthdate));
                        //$member->birthdate = new DateTime($birthdate);
                        //$member->birthdate->format('Y-m-d H:i:s');
                        $member->birthdate = $birthdate;
                    }

                    $member->civil_status = ucwords(strtolower(trim($toImport->civil_status)), " .");
                    $member->contact_num = ucwords(strtolower(trim($toImport->contact_num)), " .");
                    $member->address = strval(ucwords(strtolower(trim($toImport->address)), " ."));

                    if(is_numeric($toImport->timestamp)){
                        $timestamp = $this->excelTimestampToString((float)trim($toImport->timestamp));
                    } else {
                        break;
                    }
                    
                    $member->created_at = $timestamp;

                    try{
                        $member->save();
                    }
                    catch(Exception $e){
                        dd($e->getMessage());   // insert query
                    }

                    // Get Next Auto Increment
                    $statement = DB::select("SHOW TABLE STATUS LIKE 'claimants'");
                    $claimants_id = $statement[0]->Auto_increment;

                    // Save Request Data (Member's Claimants Information)
                    $claimant = new Claimant();

                    $name = ucwords(strtolower(trim($toImport->name)), " .");
                    if(strpos($name, ",") > 0){
                        $tmp = explode(",", $name);
                        $claimant->fname = ucwords($tmp[1]);
                        $claimant->lname = ucwords($tmp[0]);
                    } else {
                        $claimant->fname = substr($name, strpos($name, " ") + 1);
                        $claimant->lname = substr($name, 0, strpos($name, " "));
                    }

                    $claimant->contact_num = $toImport->contact_num;

                    $claimant->save();

                    // Get Next Auto Increment
                    $statement = DB::select("SHOW TABLE STATUS LIKE 'beneficiaries'");
                    $beneficiary_id = $statement[0]->Auto_increment;
                    $beneficiaries_ids = "";

                    // Save Request Data (Member's Beneficiaries Information)

                    if(strtolower($toImport->name1) != ""
                    && strtolower($toImport->name1) != "n/a"
                    && strtolower($toImport->name1) != "na"
                    && strtolower($toImport->name1) != "none"){
                        $beneficiary_1 = new Beneficiary();

                        $name = ucwords(strtolower(trim($toImport->name1)), " .");
                        if(strpos($name, ",") > 0){
                            $tmp = explode(",", $name);
                            $beneficiary_1->fname = ucwords($tmp[1]);
                            $beneficiary_1->lname = ucwords($tmp[0]);
                        } else {
                            $beneficiary_1->fname = substr($name, strpos($name, " ") + 1);
                            $beneficiary_1->lname = substr($name, 0, strpos($name, " "));
                        }

                        $beneficiary_1->relationship = ucwords(strtolower(trim($toImport->relationship1)));

                        $beneficiary_1->save();
                        $beneficiaries_ids = $beneficiaries_ids . $beneficiary_id . ",";
                        $beneficiary_id = $beneficiary_id + 1;
                    }

                    if(strtolower($toImport->name2) != ""
                    && strtolower($toImport->name2) != "n/a"
                    && strtolower($toImport->name2) != "na"
                    && strtolower($toImport->name2) != "none"){
                        $beneficiary_2 = new Beneficiary();

                        $name = ucwords(strtolower(trim($toImport->name2)), " .");
                        if(strpos($name, ",") > 0){
                            $tmp = explode(",", $name);
                            $beneficiary_2->fname = ucwords($tmp[1]);
                            $beneficiary_2->lname = ucwords($tmp[0]);
                        } else {
                            $beneficiary_2->fname = substr($name, strpos($name, " ") + 1);
                            $beneficiary_2->lname = substr($name, 0, strpos($name, " "));
                        }

                        $beneficiary_2->relationship = ucwords(strtolower(trim($toImport->relationship2)));

                        $beneficiary_2->save();
                        $beneficiaries_ids = $beneficiaries_ids . $beneficiary_id . ",";
                        $beneficiary_id = $beneficiary_id + 1;
                    }

                    if(strtolower($toImport->name3) != ""
                    && strtolower($toImport->name3) != "n/a"
                    && strtolower($toImport->name3) != "na"
                    && strtolower($toImport->name3) != "none"){
                        $beneficiary_3 = new Beneficiary();

                        $name = ucwords(strtolower(trim($toImport->name3)), " .");
                        if(strpos($name, ",") > 0){
                            $tmp = explode(",", $name);
                            $beneficiary_3->fname = ucwords($tmp[1]);
                            $beneficiary_3->lname = ucwords($tmp[0]);
                        } else {
                            $beneficiary_3->fname = substr($name, strpos($name, " ") + 1);
                            $beneficiary_3->lname = substr($name, 0, strpos($name, " "));
                        }

                        $beneficiary_3->relationship = ucwords(strtolower(trim($toImport->relationship3)));

                        $beneficiary_3->save();
                        $beneficiaries_ids = $beneficiaries_ids . $beneficiary_id . ",";
                        $beneficiary_id = $beneficiary_id + 1;
                    }

                    if(strtolower($toImport->name4) != ""
                    && strtolower($toImport->name4) != "n/a"
                    && strtolower($toImport->name4) != "na"
                    && strtolower($toImport->name4) != "none"){
                        $beneficiary_4 = new Beneficiary();

                        $name = ucwords(strtolower(trim($toImport->name4)), " .");
                        if(strpos($name, ",") > 0){
                            $tmp = explode(",", $name);
                            $beneficiary_4->fname = ucwords($tmp[1]);
                            $beneficiary_4->lname = ucwords($tmp[0]);
                        } else {
                            $beneficiary_4->fname = substr($name, strpos($name, " ") + 1);
                            $beneficiary_4->lname = substr($name, 0, strpos($name, " "));
                        }

                        $beneficiary_4->relationship = ucwords(strtolower(trim($toImport->relationship4)));

                        $beneficiary_4->save();
                        $beneficiaries_ids = $beneficiaries_ids . $beneficiary_id . ",";
                        $beneficiary_id = $beneficiary_id + 1;
                    }

                    // Save Request Data (Members_Program)
                    $memberProgram = new MembersProgram();
                    $memberProgram->app_no = $toImport->application_no;
                    $memberProgram->user_id = $user_id;
                    $memberProgram->member_id = $member_id;

                    $program_id = 0;
                    foreach($programs as $program){
                        if(strtolower(trim($program->code)) == strtolower(trim($toImport->dayong_program))){
                            $program_id = $program->id; 
                            break; break;
                        }
                    }

                    $branch_id = 0;
                    foreach($branches as $branch){
                        if(strtolower(trim($branch->branch)) == strtolower(trim($toImport->branch))){
                            $branch_id = $branch->id;
                            break; break;
                        }
                    }

                    $memberProgram->program_id = $program_id; 
                    $memberProgram->branch_id = $branch_id;
                    $memberProgram->claimants_id = $claimants_id;
                    $memberProgram->beneficiaries_ids = $beneficiaries_ids;

                    if(is_numeric($toImport->registration_amount)){
                        $memberProgram->registration_fee = $toImport->registration_amount;
                    }

                    $memberProgram->contact_person = ucwords(trim($toImport->name), " .");
                    $memberProgram->contact_person_num = $toImport->contact_num;
                    $memberProgram->status = "active";

                    $memberProgram->save();

                    // Save Request Data (Entry)

                    if((trim($toImport->registration_amount) != "")&&(is_numeric($toImport->registration_amount))){
                        $entry = new Entry();

                        $entry->branch_id = $branch_id;
                        $entry->marketting_agent = $user_id;
                        $entry->member_id = $member_id;
                        $entry->or_number = $toImport->or_number;
                        $entry->amount = $toImport->registration_amount;
                        $entry->number_of_payment = 1;
                        $entry->program_id = $program_id; 
                        $entry->is_reactivated = 0;
                        $entry->is_transferred = 0;
                        $entry->remarks = "REGISTRATION";

                        $entry->save();
                    }

                    $toDelete = ExcelMembers::find($toImport->id);
                    $toDelete->delete();

                }                        
            }
        }

        // Back to View
        return redirect('/members')->with("success_msg","Created Successfully"); 
    }

    public function excelTimestampToString($excelTimestamp) 
    {
        try
        {
            // Define the base date for Excel dates (January 1, 1900 is considered day 1 in Excel)
            $excelEpoch = new DateTime('1899-12-30'); // Excel date 0 corresponds to 1899-12-30
            
            // Separate the integer part (days) and fractional part (time)
            $days = floor($excelTimestamp);
            $fractionalDay = $excelTimestamp - $days;
            
            // Add the days to the epoch
            $excelEpoch->modify("+{$days} days");
            
            // Calculate the time from the fractional day
            $totalSeconds = round($fractionalDay * 86400); // 86400 seconds in a day
            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $seconds = $totalSeconds % 60;
            
            // Add the time to the date
            $excelEpoch->setTime($hours, $minutes, $seconds);
            
            // Return the formatted date string
            return $excelEpoch->format('Y-m-d H:i:s');
        } 
        catch(TypeError $e){
            dd($excelTimestamp);
        }

    }
}
