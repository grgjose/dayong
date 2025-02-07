<?php

namespace App\Http\Controllers;

use DateTime;
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
use App\Models\Entry;
use App\Models\ExcelEntries;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Exception;

//List of Constants (COL)

    const TIMESTAMP = 0;
    const BRANCH = 1;
    const MARKETTING_AGENT = 2;
    const STATUS = 3;
    const PHMEMBER = 4;
    const OR_NUMBER = 5;
    const OR_DATE = 6;
    const AMOUNT_COLLECTED = 7;
    const MONTH_OF = 8;
    const NOP = 9;
    const DATE_REMITTED = 10;
    const DAYONG_PROGRAM = 11;
    const REACTIVATION = 12;
    const TRANSFERRED = 13;

//

class EntryController extends Controller
{
    //
    public function index()
    {
        if(auth()->check()){

            $my_user = auth()->user();
            $members = DB::table('members')->orderBy('id')->get();
            $programs = DB::table('programs')->orderBy('id')->get();
            $branches = DB::table('branches')->orderBy('id')->get();
            $entries = DB::table('entries')->orderBy('created_at', 'desc')->get();
            $users = DB::table('users')->orderBy('id')->get();

            return view('main', [
                'my_user' => $my_user,
                'members' => $members,
                'programs' => $programs,
                'branches' => $branches,
                'entries' => $entries,
                'users' => $users
            ])
            ->with('header_title', 'Collection')
            ->with('subview', 'dashboard-contents.modules.data-entry');

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
                "incentives" => ['nullable'],
                "fidelity" => ['nullable'],
                "reactivated" => ['nullable'],
                "transferred" => ['nullable'],
                "remarks" => ['nullable'],
            ]);
            
            $my_user = auth()->user();

            $fids = DB::table('fidelity')->where('user_id', $validated["marketting_agent"])->get();
            $fid = false;
            if(count($fids) == 0){ $fid = false; }
            else { $fid = true; }

            $contents = new Entry();

            $contents->branch_id = $validated["branch_id"];
            $contents->encoder_id = $my_user->id;
            $contents->marketting_agent = $validated["marketting_agent"];
            $contents->member_id = $validated["member_id"];
            $contents->or_number = $validated["or_number"];
            $contents->amount = $validated["amount"];
            $contents->number_of_payment = $validated["number_of_payment"];
            $contents->program_id = $validated["program_id"];
            $contents->month_from = $validated["month_from"];
            $contents->month_to = $validated["month_to"];
            $contents->incentives = $validated["incentives"];

            if($fid == true) {
                $contents->incentives_total = $validated["amount"] * ($validated["incentives"] / 100);
                $contents->incentives_total = $contents->incentives_total - ($contents->incentives_total * 0.1);
                $contents->net = $validated["amount"] - $contents->incentives_total;
                $contents->fidelity = ($contents->incentives_total * 0.1);
            } else {
                $contents->incentives_total = $validated["amount"] * ($validated["incentives"] / 100);
                $contents->net = $validated["amount"] - $contents->incentives_total;
                $contents->fidelity = 0;
            }

            $contents->is_reactivated = 0;
            if(isset($validated["reactivated"])){ $contents->is_reactivated = 1; }

            $contents->is_transferred = 0;
            if(isset($validated["transferred"])){ $contents->is_transferred = 1; }

            $contents->is_remitted = false;
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
 
    public function importEntries(Request $request)
    {
        set_time_limit(240);
        $programs = DB::table('programs')->orderBy('code')->get();
        $branches = DB::table('branches')->orderBy('branch')->get();
        $toImportEntries = DB::table('excel_entries')->orderBy('id')->skip(0)->take((int)$request->input('data_count'))->get();

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

            $validated = $request->validate([
                'upload_file' => ['required', 'file']
            ]);

            $programs = DB::table('programs')->orderBy('code')->get();
            $branches = DB::table('branches')->orderBy('branch')->get();

            $array = (new EntryImport)->toArray($request->file('upload_file'));
            
            foreach($array as $sheet){

                for ($row = 1; $row < sizeOf($sheet); $row++) {

                    if($sheet[$row][TIMESTAMP] != ""){

                        $contents = new Entry();

                        foreach($branches as $branch){
                            if(strtolower(trim($branch->branch)) == strtolower(trim($sheet[$row][BRANCH]))){
                                $contents->branch_id = $branch->id;
                                break; break;
                            }
                        }

                        $name = ucwords(strtolower(trim($sheet[$row][MARKETTING_AGENT])), " .");
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

                        if(count($users) == 0){
                            // Show Error
                        } else {
                            $user_id = $users[0]->id;
                        }

                        $contents->marketting_agent = $user_id;

                        $name = ucwords(strtolower(trim($sheet[$row][PHMEMBER])), " .");
                        if(strpos($name, ",") > 0){
                            $tmp = explode(",", $name);
                            $fname = ucwords($tmp[1]);
                            $lname = ucwords($tmp[0]);
                        } else {
                            $fname = substr($name, strpos($name, " ") + 1);
                            $lname = substr($name, 0, strpos($name, " "));
                        }

                        $members = DB::table('members')->where('lname', $lname)
                        ->where('fname', 'LIKE', $fname)->get();

                        if(count($members) == 0){
                            
                        } else {
                            $member_id = $members[0]->id;
                        }

                        $contents->member_id = $member_id;
                        $contents->or_number = $validated["or_number"];
                        $contents->amount = $validated["amount"];
                        $contents->number_of_payment = $validated["number_of_payment"];

                        foreach($programs as $program){
                            if(strtolower(trim($program->code)) == strtolower(trim($sheet[$row][DAYONG_PROGRAM]))){
                                $contents->program_id = $program->id; 
                                break; break;
                            }
                        }

                        $contents->month_from = $validated["month_from"];
                        $contents->month_to = $validated["month_to"];
                        $contents->is_reactivated = 0;
                        $contents->is_transferred = 0;
                        $contents->remarks = $validated["remarks"];
            
                        $contents->save();
                    }
                }
            }
            

            //ImportExcelFile::dispatch($array);

            return redirect('/members')->with("success_msg", "Uploaded Successfully");

        } else {
            return redirect('/');
        }

    }

    public function viewDetails($id)
    {

        if(auth()->check()){
            $my_user = auth()->user();
            $entries = DB::table('entries')->where('id', $id)->get();
            $agent = DB::table('users')->where('id', $entries[0]->marketting_agent)->get();
            $members = DB::table('members')->where('id', $entries[0]->member_id)->get();
            $branches = DB::table('branches')->where('id', $entries[0]->branch_id)->get();
            $programs = DB::table('programs')->where('id', $entries[0]->program_id)->get();
            
            return view('dashboard-contents.modules.data-entry-view', [
                'id' => $id,
                'entries' => $entries[0],
                'agent' => $agent[0],
                'members' => $members[0],
                'branches' => $branches[0],
                'programs' => $programs[0],
            ]);

        } else {
            return redirect('/');
        }
    }

    public function editDetails($id)
    {

        if(auth()->check()){
            $my_user = auth()->user();
            $entries = DB::table('entries')->where('id', $id)->get();
            $agent = DB::table('users')->where('id', $entries[0]->marketting_agent)->get();
            $member = DB::table('members')->where('id', $entries[0]->member_id)->get();
            $branch = DB::table('branches')->where('id', $entries[0]->branch_id)->get();
            $program = DB::table('programs')->where('id', $entries[0]->program_id)->get();

            $users = DB::table('users')->get();
            $branches = DB::table('branches')->get();
            $programs = DB::table('programs')->get();

            return view('dashboard-contents.modules.data-entry-edit', [
                'id' => $id,
                'entries' => $entries[0],
                'agent' => $agent[0],
                'member' => $member[0],
                'branch' => $branch[0],
                'program' => $program[0],
                'branches' => $branches,
                'programs' => $programs,
                'users' => $users
            ]);

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

    public function getIncentivesMatrix($id, $program_id){
        $matrix = DB::table('matrix')->where('program_id', $program_id)->orderBy('program_id')->get();
        $entries = DB::table('entries')
            ->where('member_id', $id)
            ->where('program_id', $program_id)
            ->where('remarks', "!=", "REGISTRATION")
            ->get();
        $nop = count($entries) + 1;

        if(count($matrix) == 0){ return ""; }

        foreach($matrix as $m){
            $arr = explode('-', $m->nop);
            if($arr[0] != 'up' && $arr[1] != 'up'){
                if((int)$arr[0] <= (int)$nop && (int)$arr[1] >= (int)$nop){
                    return $m->percentage;
                }
            } else {
                if((int)$arr[0] >= $nop){
                    return $m->percentage;
                }
            }
        }

        return "";
    }

}
