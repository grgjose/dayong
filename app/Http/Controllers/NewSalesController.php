<?php

namespace App\Http\Controllers;

use App\Events\ProcessExcelFile;
use DateTime;
use App\Jobs\ImportExcelFile;
use App\Imports\SalesImport;
use App\Imports\ExcelImport;
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

class NewSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->check()){

            $my_user = auth()->user();
            $users = DB::table('users')->orderBy('usertype', 'asc')->get();
            $members = DB::table('members')->orderBy('created_at', 'desc')->get();
            $members_program = DB::table('members_program')->where('is_deleted', false)->get();
            $programs = DB::table('programs')->orderBy('code')->get();
            $branches = DB::table('branches')->orderBy('branch')->get();

            return view('main', [
                'my_user' => $my_user,
                'members' => $members,
                'members_program' => $members_program,
                'programs' => $programs,
                'branches' => $branches,
                'users' => $users,
            ])
            ->with('header_title', 'New Sales')
            ->with('subview', 'dashboard-contents.modules.new-sales');

        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if(auth()->check()){

            // Get Request Data
            $my_user = auth()->user();
            $validated = $request->validate([

                // Location and Program
                "program_id" => ['required'],
                "branch_id" => ['required'],
                "or_number" => ['required'],
                "app_no" => ['required'],
                "created_at" => ['required'],

                // Personal Information
                "fname" => ['required'],
                "mname" => ['required'],
                "lname" => ['required'],
                "ext" => ['nullable'],
                "birthdate" => ['required'],
                "sex" => ['required'],
                "birthplace" => ['required'],
                "citizenship" => ['required'],
                "civil_status" => ['required'],
                "contact_num" => ['required'],
                "email" => ['nullable'],
                "address" => ['required'],
                
                // Claimant's Personal Information
                "fname_c" => ['required'],
                "mname_c" => ['required'],
                "lname_c" => ['required'],
                "ext_c" => ['nullable'],
                "birthdate_c" => ['required'],
                "sex_c" => ['required'],
                "contact_num_c" => ['required'],

                // Beneficiaries's #1 Personal Information
                "fname_b1" => ['nullable'],
                "mname_b1" => ['nullable'],
                "lname_b1" => ['nullable'],
                "ext_b1" => ['nullable'],
                "birthdate_b1" => ['nullable'],
                "sex_b1" => ['nullable'],
                "relationship_b1" => ['nullable'],
                "contact_num_b1" => ['nullable'],

                // Beneficiaries's #2 Personal Information
                "fname_b2" => ['nullable'],
                "mname_b2" => ['nullable'],
                "lname_b2" => ['nullable'],
                "ext_b2" => ['nullable'],
                "birthdate_b2" => ['nullable'],
                "sex_b2" => ['nullable'],
                "relationship_b2" => ['nullable'],
                "contact_num_b2" => ['nullable'],
                
                // Others
                "contact_person" => ['required'],
                "contact_person_num" => ['required'],
                "registration_fee" => ['nullable'],
                "agent_id" => ['nullable'],
                "amount" => ['nullable'],
                "incentives" => ['nullable'],
                "fidelity" => ['nullable'],

            ]);

            // Get Next Auto Increment
            $statement = DB::select("SHOW TABLE STATUS LIKE 'members'");
            $member_id = $statement[0]->Auto_increment;
            
            // Save Request Data (Member's Personal Information)
            $member = new Member();

            $member->fname = $validated['fname'];
            $member->mname = $validated['mname'];
            $member->lname = $validated['lname'];
            $member->ext = $validated['ext'];
            $member->birthdate = $validated['birthdate'];
            $member->sex = $validated['sex'];
            $member->birthplace = $validated['birthplace'];
            $member->citizenship = $validated['citizenship'];
            $member->civil_status = $validated['civil_status'];
            $member->contact_num = $validated['contact_num'];
            $member->email = $validated['email'];
            $member->address = $validated['address'];

            $member->save();

            // Get Next Auto Increment
            $statement = DB::select("SHOW TABLE STATUS LIKE 'claimants'");
            $claimants_id = $statement[0]->Auto_increment;

            // Save Request Data (Member's Claimants Information)
            $claimant = new Claimant();

            $claimant->fname = $validated['fname_c'];
            $claimant->mname = $validated['mname_c'];
            $claimant->lname = $validated['lname_c'];
            $claimant->ext = $validated['ext_c'];
            $claimant->birthdate = $validated['birthdate_c'];
            $claimant->sex = $validated['sex_c'];
            $claimant->contact_num = $validated['contact_num_c'];

            $claimant->save();

            // Get Next Auto Increment
            $statement = DB::select("SHOW TABLE STATUS LIKE 'beneficiaries'");
            $beneficiary_id = $statement[0]->Auto_increment;
            $beneficiaries_ids = "";
            
            // Save Request Data (Member's Beneficiaries Information)

            if($validated['fname_b1'] != ""){
                $beneficiary_1 = new Beneficiary();

                $beneficiary_1->fname = $validated['fname_b1'];
                $beneficiary_1->mname = $validated['mname_b1'];
                $beneficiary_1->lname = $validated['lname_b1'];
                $beneficiary_1->ext = $validated['ext_b1'];
                $beneficiary_1->birthdate = $validated['birthdate_b1'];
                $beneficiary_1->relationship = $validated['relationship_b1'];
                $beneficiary_1->sex = $validated['sex_b1'];
                $beneficiary_1->contact_num = $validated['contact_num_b1']; 

                $beneficiary_1->save();
                $beneficiaries_ids = $beneficiaries_ids . $beneficiary_id;
            }

            if($validated['fname_b2'] != ""){
                $beneficiary_2 = new Beneficiary();

                $beneficiary_2->fname = $validated['fname_b2'];
                $beneficiary_2->mname = $validated['mname_b2'];
                $beneficiary_2->lname = $validated['lname_b2'];
                $beneficiary_2->ext = $validated['ext_b2'];
                $beneficiary_2->birthdate = $validated['birthdate_b2'];
                $beneficiary_2->relationship = $validated['relationship_b2'];
                $beneficiary_2->sex = $validated['sex_b2'];
                $beneficiary_2->contact_num = $validated['contact_num_b2']; 

                $beneficiary_2->save();
                $beneficiaries_ids = $beneficiaries_ids . "," . (string)((int)$beneficiary_id + 1);
            }

            // Save Request Data (Members_Program)
            $memberProgram = new MembersProgram();
            $memberProgram->app_no = $validated['app_no'];
            $memberProgram->user_id = $my_user->id;
            $memberProgram->member_id = $member_id;
            $memberProgram->program_id = $validated['program_id'];
            $memberProgram->branch_id = $validated['branch_id'];
            $memberProgram->claimants_id = $claimants_id;
            $memberProgram->beneficiaries_ids = $beneficiaries_ids;
            $memberProgram->or_number = $validated['or_number'];
            $memberProgram->registration_fee = $validated['registration_fee'];
            $memberProgram->agent_id = $validated['agent_id'];
            $memberProgram->amount = $validated['amount'];
            $memberProgram->incentives = $validated['incentives'];
            $memberProgram->incentives_total = $memberProgram->amount - ($memberProgram->amount * ($memberProgram->incentives / 100));
            $memberProgram->fidelity = $validated['fidelity'];
            $memberProgram->fidelity_total = $memberProgram->incentives_total * ($memberProgram->fidelity / 100);
            $memberProgram->incentives_total = $memberProgram->incentives_total - $memberProgram->fidelity_total;
            $memberProgram->net = $memberProgram->amount  - $memberProgram->incentives_total - $memberProgram->fidelity_total;
            $memberProgram->contact_person = $validated['contact_person'];
            $memberProgram->contact_person_num = $validated['contact_person_num'];
            $memberProgram->status = "active";

            $memberProgram->save();

            // Save Request Data (Entry)

            /*
            if($validated['registration_fee'] != ""){
                $entry = new Entry();

                $entry->branch_id = $validated['branch_id'];;
                $entry->marketting_agent = $validated['agent_id'];
                $entry->member_id = $member_id;
                $entry->or_number = $validated["or_number"];
                $entry->amount = $validated['registration_fee'];
                $entry->number_of_payment = 1;
                $entry->program_id = $validated['program_id'];
                $entry->month_from = date('Y-m');
                $entry->month_to = date('Y-m');
                $entry->is_reactivated = 0;
                $entry->is_transferred = 0;
                $entry->remarks = "REGISTRATION";

                $entry->save();
            }
            */

            // Back to View
            return redirect('/members')->with("success_msg", $member->lname." Member Created Successfully");

        } else {
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
