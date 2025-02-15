<?php

namespace App\Http\Controllers;

use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Jobs\ImportExcelFile;
use App\Models\Beneficiary;
use App\Models\Member;
use App\Models\MembersProgram;
use App\Models\Claimant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use App\Imports\UsersImport;
use App\Imports\EntryImport;
use App\Imports\ExcelEntryImport;
use App\Models\Entry;
use App\Models\ExcelEntries;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class ExcelCollectionController extends Controller
{
    //
    public function index()
    {
        if(auth()->check()){

            $my_user = auth()->user();
            $excel_entries = DB::table('excel_entries')->orderBy('id')->get();
            $headers = array_keys((array) $excel_entries->first());

            return view('main', [
                'my_user' => $my_user,
                'excel_entries' => $excel_entries,
                'headers' => $headers,
            ])
            ->with('header_title', 'Excel Collection')
            ->with('subview', 'dashboard-contents.settings.excel-collection');

        } else {
            return redirect('/');
        }

    }

    public function retrieve(Request $request)
    {
        if(auth()->check()){
            
            return DataTables::query(DB::table('excel_entries')->where('isImported', false))->toJson();

        } else {
            return redirect('/');
        }   
    }

    public function store(Request $request)
    {
        if(auth()->check()){

            $validated = $request->validate([
                "branch_id" => ['required'],
                "marketting_agent" => ['nullable'],
                "member_id" => ['nullable'],
                "or_number" => ['nullable'],
                "amount" => ['nullable'],
                "number_of_payment" => ['nullable'],
                "program_id" => ['nullable'],
                "month_from" => ['nullable'],
                "month_to" => ['nullable'],
                "remarks" => ['nullable'],
            ]);

            //dd($validated["month_from"]);

            $contents = new Entry();

            $contents->branch_id = $validated["branch_id"];
            $contents->marketting_agent = $validated["marketting_agent"];
            $contents->member_id = $validated["member_id"];
            $contents->or_number = $validated["or_number"];
            $contents->amount = $validated["amount"];
            $contents->number_of_payment = $validated["number_of_payment"];
            $contents->program_id = $validated["program_id"];
            $contents->month_from = $validated["month_from"];
            $contents->month_to = $validated["month_to"];
            $contents->is_reactivated = 0;
            $contents->is_transferred = 0;
            $contents->remarks = $validated["remarks"];

            $contents->save();

            // Back to View
            return redirect('/entries')->with("success_msg", "Collection Added");

        } else {
            return redirect('/');
        }
    }

    public function update(Request $request)
    {
        //code
    }

    public function destroy(Request $request)
    {
        if(auth()->check()){

            // Destroy Request Data
            Entry::where("id", $request->input("id"))->delete();
            return redirect('/entries')->with("success_msg", "Deleted Successfully");

        } else {
            return redirect('/');
        }
    }
 
    public function importEntries()
    {
        set_time_limit(240);
        $programs = DB::table('programs')->orderBy('code')->get();
        $branches = DB::table('branches')->orderBy('branch')->get();
        $toImportEntries = DB::table('excel_entries')->orderBy('id')->skip(0)->take(1000)->get();

        foreach($toImportEntries as $toImport) {
            if($toImport->timestamp != ""){

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
                
                // Save Entry Data (Member's Collection Information)
                $entry = new Entry();

                $name = ucwords(strtolower(trim($toImport->phmember)), " .");
                if(strpos($name, ",") > 0){
                    $tmp = explode(",", $name);
                    $fname = ucwords($tmp[1]);
                    $lname = ucwords($tmp[0]);
                } else {
                    $fname = substr($name, strpos($name, " ") + 1);
                    $lname = substr($name, 0, strpos($name, " "));
                }

                $members = DB::table('members')
                ->where('lname', $entry->lname)
                ->where('fname', 'LIKE', $entry->fname)
                ->get();

                //$anotherMembers = DB::table('members')->where('or_number', $toImport->or_number)->get();
                //$excel_members = DB::table('excel_members')->where('or_number', $toImport->or_number)->get();

                

                if(count($members) > 0){

                    if(is_numeric($toImport->timestamp)){
                        $timestamp = $this->excelTimestampToString((float)trim($toImport->timestamp));
                    } else {
                        break;
                    }
                    
                    $entry->created_at = $timestamp;

                    try{
                        $entry->save();
                    }
                    catch(Exception $e){
                        dd($e->getMessage());   // insert query
                    }

                    $branch_id = 0;
                    foreach($branches as $branch){
                        if(strtolower(trim($branch->branch)) == strtolower(trim($toImport->branch))){
                            $branch_id = $branch->id;
                            break; break;
                        }
                    }

                    $program_id = 0;
                    foreach($programs as $program){
                        if(strtolower(trim($program->code)) == strtolower(trim($toImport->dayong_program))){
                            $program_id = $program->id;
                            break; break;
                        }
                    }

                    $entry->branch_id = $branch_id;

                    $entry->marketting_agent = $user_id;
                    $entry->member_id = $members[0]->id;
                    $entry->or_number = $toImport->or_number;
                    $entry->amount = $toImport->amount_collected;
                    $entry->number_of_payment = $toImport->nop;
                    $entry->program_id = $program_id; 
                    $entry->is_reactivated = $toImport->reactivation == "Yes" ? 1 : 0;
                    $entry->is_transferred = $toImport->transferred == "Yes" ? 1 : 0;

                    $entry->save();

                    $toDelete = ExcelEntries::find($toImport->id);
                    $toDelete->delete();

                }                        
            }
        }

        // Back to View
        return redirect('/entries')->with("success_msg","Created Successfully"); 
    }

    public function upload(Request $request)
    {

        if(auth()->check()){

            set_time_limit(400);
            //ini_set('memory_limit', '2048M');

            $my_user = auth()->user();
            $validated = $request->validate([
                'upload_file' => ['required'],
                'sheetName' => ['required'],
            ]);

            $import = new ExcelEntryImport($validated['sheetName']);
            //Excel::toImport($import, $validated['upload_file']);
            (new ExcelEntryImport($validated['sheetName']))->import($validated['upload_file']);

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

    public function excelTimestampToString($excelTimestamp) 
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
}
