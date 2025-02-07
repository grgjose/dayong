<div class="card-header">
    <h3 class="card-title" style="padding-top: 10px;">Edit Member Details</h3>
    <button class="btn btn-secondary float-right" style="color: white;" onclick="hideForm()">
        <span class="fas fa-times"></span> Close
    </button>
</div>

<form action="/members/update/{{ $id; }}" method="POST">
    @method('PUT')
    @csrf
    <div class="card-body">
        <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
            <legend class="h5 pl-2 pr-2" style="width: auto; !important">Location and Program</legend>
            <div class="row">
                <div class="form-group col">
                    <label for="branch_id">Branch</label>
                    <select class="form-control chosen-select" id="branch_id" name="branch_id" value="{{ $member_program->branch_id; }}">
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id; }}">{{ $branch->branch; }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col">
                    <label for="program_id">Program</label>
                    <select class="form-control chosen-select" id="program_id" name="program_id" value="{{ $member_program->program_id; }}" onchange="checkBeneficiaries()">
                        @foreach($programs as $program)
                            <option value="{{ $program->id; }}">{{ $program->code; }}</option>
                            <span style="display: none;" id="ben_{{ $program->id }}">{{ $program->with_beneficiaries; }}</span>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col">
                    <label for="or_num">OR #:</label>
                    <input type="number" class="form-control" id="or_number" name="or_number" placeholder="Enter OR Number" value="{{ $member_program->or_number; }}">
                </div>
                <div class="form-group col">
                    <label for="or_num">Application #:</label>
                    <input type="number" class="form-control" id="app_no" name="app_no" placeholder="Enter OR Number" value="{{ $member_program->app_no; }}" required>
                </div>
            </div>
        </fieldset>
        
        <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
            <legend class="h5 pl-2 pr-2" style="width: auto; !important">Personal Information</legend>
            <div class="row">
                <div class="form-group col">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" value="{{ $member->fname; }}">
                </div>
                <div class="form-group col">
                    <label for="mname">Middle Name</label>
                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter Middle Name" value="{{ $member->mname; }}">
                </div>
                <div class="form-group col">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" value="{{ $member->lname; }}">
                </div>
                <div class="form-group col">
                    <label for="ext">Ext Name</label>
                    <input type="text" class="form-control" id="ext" name="ext" placeholder="Enter Ext. Name (Jr, Sr, Etc.)" value="{{ $member->ext; }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="birthdate">Birthdate</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Enter Birthdate" value="{{ substr($member->birthdate, 0, 10); }}">
                </div>
                <div class="form-group col">
                    <label for="sex">Sex</label>
                    <select class="form-control chosen-select" id="sex" name="sex">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="birthplace">Place of Birth</label>
                    <input type="text" class="form-control" id="birthplace" name="birthplace" placeholder="Enter Place of Birth" value="{{ $member->birthplace; }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="citizenship">Citizenship</label>
                    <input type="text" class="form-control" id="citizenship" name="citizenship" placeholder="Enter Citizenship (Filipino, American, etc.)" value="{{ $member->citizenship; }}">
                </div>
                <div class="form-group col">
                    <label for="civil_status">Civil Status</label>
                    <select class="form-control chosen-select" id="civil_status" name="civil_status" value="{{ $member->civil_status; }}">
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="contact_num">Contact #</label>
                    <input type="number" class="form-control" id="contact_num" name="contact_num" placeholder="Enter Contact Number (+63)" value="{{ $member->contact_num; }}">
                </div>
                <div class="form-group col">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email (Optional)" value="{{ $member->email; }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Current Address" value="{{ $member->address; }}">
                </div>
            </div>
        </fieldset>
        
        <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
            <legend class="h5 pl-2 pr-2" style="width: auto; !important">Claimant's Personal Information</legend>
            <div class="row">
                <div class="form-group col">
                    <label for="fname_c">First Name</label>
                    <input type="text" class="form-control" id="fname_c" name="fname_c" placeholder="Enter First Name" value="{{ $claimant->fname; }}">
                </div>
                <div class="form-group col">
                    <label for="mname_c">Middle Name</label>
                    <input type="text" class="form-control" id="mname_c" name="mname_c" placeholder="Enter Middle Name" value="{{ $claimant->mname; }}">
                </div>
                <div class="form-group col">
                    <label for="lname_c">Last Name</label>
                    <input type="text" class="form-control" id="lname_c" name="lname_c" placeholder="Enter Last Name" value="{{ $claimant->lname; }}">
                </div>
                <div class="form-group col">
                    <label for="ext_c">Ext Name</label>
                    <input type="text" class="form-control" id="ext_c" name="ext_c" placeholder="Enter Ext. Name (Jr, Sr, Etc.)" value="{{ $claimant->ext; }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="birthdate_c">Birthdate</label>
                    <input type="date" class="form-control" id="birthdate_c" name="birthdate_c" placeholder="Enter Birthdate" value="{{ substr($claimant->birthdate, 0, 10); }}">
                </div>
                <div class="form-group col">
                    <label for="sex_c">Sex</label>
                    <select class="form-control chosen-select" id="sex_c" name="sex_c" value="{{ $claimant->sex; }}">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="contact_num_c">Contact #</label>
                    <input type="number" class="form-control" id="contact_num_c" name="contact_num_c" placeholder="Enter Contact Number (+63)" value="{{ $claimant->contact_num; }}">
                </div>
            </div>
        </fieldset>

        @php
            $count = 1;   
        @endphp

        @foreach($beneficiaries as $beneficiary)
        <fieldset class="border p-3 mb-2 rounded beneficiaries" style="diplay: none;">
            <legend class="h5 pl-2 pr-2" style="width: auto; !important">Beneficiaries #{{ $count; }}</legend>
            <div class="row">
                <div class="form-group col">
                    <label for="fname_b1">First Name</label>
                    <input type="text" class="form-control" id="fname_b{{ $count; }}" name="fname_b{{ $count; }}" placeholder="Enter First Name" value="{{ $beneficiary->fname; }}">
                </div>
                <div class="form-group col">
                    <label for="mname_b1">Middle Name</label>
                    <input type="text" class="form-control" id="mname_b{{ $count; }}" name="mname_b{{ $count; }}" placeholder="Enter Middle Name" value="{{ $beneficiary->mname; }}">
                </div>
                <div class="form-group col">
                    <label for="lname_b1">Last Name</label>
                    <input type="text" class="form-control" id="lname_b{{ $count; }}" name="lname_b{{ $count; }}" placeholder="Enter Last Name" value="{{ $beneficiary->lname; }}">
                </div>
                <div class="form-group col">
                    <label for="ext_">Ext Name</label>
                    <input type="text" class="form-control" id="ext_b{{ $count; }}" name="ext_b{{ $count; }}" placeholder="Enter Ext. Name (Jr, Sr, Etc.)" value="{{ $beneficiary->ext; }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="birthdate_b1">Birthdate</label>
                    <input type="date" class="form-control" id="birthdate_b{{ $count; }}" name="birthdate_b{{ $count; }}" placeholder="Enter Birthdate" value="{{ substr($beneficiary->birthdate,0 ,10); }}">
                </div>
                <div class="form-group col">
                    <label for="sex_b1">Sex</label>
                    <select class="form-control chosen-select" id="sex_b{{ $count; }}" name="sex_b{{ $count; }}" value="{{ $beneficiary->sex; }}">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="relationship_b1">Relationship</label>
                    <input type="text" class="form-control" id="relationship_b{{ $count; }}" name="relationship_b{{ $count; }}" placeholder="Enter Relationship" value="{{ $beneficiary->relationship; }}">
                </div>
                <div class="form-group col">
                    <label for="contact_num_b1">Contact #</label>
                    <input type="number" class="form-control" id="contact_num_b{{ $count; }}" name="contact_num_b{{ $count; }}" placeholder="Enter Contact Number (+63)" value="{{ $beneficiary->contact_num; }}">
                </div>
            </div>
        </fieldset>

        @php
            $count = $count + 1;   
        @endphp

        @endforeach

        <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
            <legend class="h5 pl-2 pr-2" style="width: auto; !important">Others</legend>
            <div class="row">
                <div class="form-group col">
                    <label for="contact_person">Contact Person</label>
                    <input type="text" class="form-control" id="contact_person" name="contact_person" 
                    placeholder="Enter Contact Person" value="{{ $member_program->contact_person; }}">
                </div>
                <div class="form-group col">
                    <label for="contact_person_num">Contact #:</label>
                    <input type="text" class="form-control" id="contact_person_num" name="contact_person_num" 
                    placeholder="Enter Contact Person's Number" value="{{ $member_program->contact_person_num; }}">
                </div>
                <div class="form-group col">
                    <label for="registration_fee">Registration Fee:</label>
                    <input type="number" class="form-control" id="registration_fee" name="registration_fee" 
                    placeholder="Enter Registration Fee Amount" value="{{ $member_program->registration_fee; }}">
                </div>
            </div>
        </fieldset>

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" style="margin-left: 10px;" onclick="hideForm()">Cancel</button>
    </div>
</form>