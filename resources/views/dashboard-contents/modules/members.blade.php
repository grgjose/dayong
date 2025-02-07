<!-- Custom Style Component -->
<style>
    
    .modal { 
        overflow-y:auto !important; 
    }
    
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    
    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

</style>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- TABLE SECTION -->                
                <div class="card card-info" id="table">
                    <div class="card-header">
                      
                        <h2 class="card-title" style="padding-top: 10px;">Members List</h2>
                        @if($my_user->usertype != 3)
                            <button class="btn btn-success float-right" onclick="showForm()">
                                <span class="fas fa-plus"></span> Register a Member
                            </button>
                        @endif
                        @if($my_user->usertype == 1)
                            <button class="btn btn-secondary float-right mr-3" data-toggle="modal" data-target="#ImportModal">
                                <span class="fas fa-upload"></span> Import a Members List
                            </button>
                        @endif
                    </div>
                    <div class="card-body">
                        <table id="normalTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Member ID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>Contact No.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <td><input type="checkbox" /></td>
                                        <td>{{ $member->id; }}</td>
                                        <td id="{{ $member->id; }}_fname">{{ $member->fname; }}</td>
                                        <td id="{{ $member->id; }}_mname">{{ $member->mname; }}</td>
                                        <td id="{{ $member->id; }}_lname">{{ $member->lname; }}</td>
                                        <td id="{{ $member->id; }}_address">{{ $member->address; }}</td>
                                        <td id="{{ $member->id; }}_contact_num">{{ $member->contact_num; }}</td>

                                        <td>
                                           
                                            <button class="btn btn-outline-info" data-toggle="modal" data-target="#ViewModal"
                                                    title="View Member" onclick="viewFunction({{ $member->id; }})" >
                                                <span class="fas fa-eye"></span>
                                            </button>
                                            @if($my_user->usertype == 1)
                                                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#EditModal"
                                                        title="Edit Member Info" onclick="editFunction({{ $member->id; }})" >
                                                    <span class="fas fa-pen"></span>
                                                </button>
                                                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#DeleteModal"
                                                        title="Remove Member" onclick="deleteFunction({{ $member->id; }})" >
                                                    <span class="fas fa-trash"></span>
                                                </button>
                                            @endif
                                            <button class="btn btn-outline-success" title="Print Statement of Account" 
                                                    onclick="printFunction({{ $member->id; }})" >
                                                <span class="fas fa-print"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ADD MEMBER SECTION -->
                <div class="card card-primary" id="form" style="display: none;">
                    <div class="card-header">
                        <h3 class="card-title" style="padding-top: 10px;">Membership Application Form</h3>
                        <button class="btn btn-secondary float-right" style="color: white;" onclick="hideForm()">
                            <span class="fas fa-times"></span> Cancel
                        </button>
                    </div>
                    <form action="/members/store" method="POST">
                        @csrf
                        <div class="card-body">

                            <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
                                <legend class="h5 pl-2 pr-2" style="width: auto; !important">Location and Program</legend>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="branch_id">Branch</label>
                                        <select class="form-control chosen-select" id="branch_id" name="branch_id">
                                            @foreach($branches as $branch)
                                                <option value="{{ $branch->id; }}">{{ $branch->branch; }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="program_id">Program</label>
                                        <select class="form-control chosen-select" id="program_id" name="program_id" onchange="checkBeneficiaries()">
                                            @foreach($programs as $program)
                                                <option value="{{ $program->id; }}">{{ $program->code; }}</option>
                                            @endforeach
                                        </select>
                                        @foreach($programs as $program)
                                            <span style="display: none;" id="ben_{{ $program->id }}">{{ $program->with_beneficiaries; }}</span>
                                        @endforeach
                                    </div>
                                    <div class="form-group col">
                                        <label for="or_num">OR #:</label>
                                        <input type="number" class="form-control" id="or_number" name="or_number" placeholder="Enter OR Number">
                                    </div>
                                    <div class="form-group col">
                                        <label for="app_no">Application #:</label>
                                        <input type="number" class="form-control" id="app_no" name="app_no" placeholder="Enter Application Number">
                                    </div>
                                    @php
                                        $curr = date('Y-m-d');
                                    @endphp
                                    <div class="form-group col">
                                        <label for="app_no">Creation Date:</label>
                                        <input type="date" class="form-control" id="created_at" name="created_at" value="{{ $curr }}">
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
                                <legend class="h5 pl-2 pr-2" style="width: auto; !important">Personal Information</legend>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="fname">First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="mname">Middle Name</label>
                                        <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter Middle Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="ext">Ext Name</label>
                                        <input type="text" class="form-control" id="ext" name="ext" placeholder="Enter Ext. Name (Jr, Sr, Etc.)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="birthdate">Birthdate</label>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Enter Birthdate">
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
                                        <input type="text" class="form-control" id="birthplace" name="birthplace" placeholder="Enter Place of Birth">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="citizenship">Citizenship</label>
                                        <input type="text" class="form-control" id="citizenship" name="citizenship" placeholder="Enter Citizenship (Filipino, American, etc.)">
                                    </div>
                                    <div class="form-group col">
                                        <label for="civil_status">Civil Status</label>
                                        <select class="form-control chosen-select" id="civil_status" name="civil_status">
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="contact_num">Contact #</label>
                                        <input type="number" class="form-control" id="contact_num" name="contact_num" placeholder="Enter Contact Number (+63)">
                                    </div>
                                    <div class="form-group col">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email (Optional)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Current Address">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
                                <legend class="h5 pl-2 pr-2" style="width: auto; !important">Claimant's Personal Information</legend>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="fname_c">First Name</label>
                                        <input type="text" class="form-control" id="fname_c" name="fname_c" placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="mname_c">Middle Name</label>
                                        <input type="text" class="form-control" id="mname_c" name="mname_c" placeholder="Enter Middle Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="lname_c">Last Name</label>
                                        <input type="text" class="form-control" id="lname_c" name="lname_c" placeholder="Enter Last Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="ext_c">Ext Name</label>
                                        <input type="text" class="form-control" id="ext_c" name="ext_c" placeholder="Enter Ext. Name (Jr, Sr, Etc.)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="birthdate_c">Birthdate</label>
                                        <input type="date" class="form-control" id="birthdate_c" name="birthdate_c" placeholder="Enter Birthdate">
                                    </div>
                                    <div class="form-group col">
                                        <label for="sex_c">Sex</label>
                                        <select class="form-control chosen-select" id="sex_c" name="sex_c">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="contact_num_c">Contact #</label>
                                        <input type="number" class="form-control" id="contact_num_c" name="contact_num_c" placeholder="Enter Contact Number (+63)">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border p-3 mb-2 rounded beneficiaries" style="diplay: none;">
                                <legend class="h5 pl-2 pr-2" style="width: auto; !important">Beneficiaries #1</legend>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="fname_b1">First Name</label>
                                        <input type="text" class="form-control" id="fname_b1" name="fname_b1" placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="mname_b1">Middle Name</label>
                                        <input type="text" class="form-control" id="mname_b1" name="mname_b1" placeholder="Enter Middle Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="lname_b1">Last Name</label>
                                        <input type="text" class="form-control" id="lname_b1" name="lname_b1" placeholder="Enter Last Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="ext_">Ext Name</label>
                                        <input type="text" class="form-control" id="ext_b1" name="ext_b1" placeholder="Enter Ext. Name (Jr, Sr, Etc.)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="birthdate_b1">Birthdate</label>
                                        <input type="date" class="form-control" id="birthdate_b1" name="birthdate_b1" placeholder="Enter Birthdate">
                                    </div>
                                    <div class="form-group col">
                                        <label for="sex_b1">Sex</label>
                                        <select class="form-control chosen-select" id="sex_b1" name="sex_b1">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="relationship_b1">Relationship</label>
                                        <input type="text" class="form-control" id="relationship_b1" name="relationship_b1" placeholder="Enter Relationship">
                                    </div>
                                    <div class="form-group col">
                                        <label for="contact_num_b1">Contact #</label>
                                        <input type="number" class="form-control" id="contact_num_b1" name="contact_num_b1" placeholder="Enter Contact Number (+63)">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border p-3 mb-2 rounded beneficiaries" style="diplay: none;">
                                <legend class="h5 pl-2 pr-2" style="width: auto; !important">Beneficiaries #2</legend>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="fname_b2">First Name</label>
                                        <input type="text" class="form-control" id="fname_b2" name="fname_b2" placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="mname_b2">Middle Name</label>
                                        <input type="text" class="form-control" id="mname_b2" name="mname_b2" placeholder="Enter Middle Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="lname_b2">Last Name</label>
                                        <input type="text" class="form-control" id="lname_b2" name="lname_b2" placeholder="Enter Last Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="ext_b2">Ext Name</label>
                                        <input type="text" class="form-control" id="ext_b2" name="ext_b2" placeholder="Enter Ext. Name (Jr, Sr, Etc.)">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="birthdate_b2">Birthdate</label>
                                        <input type="date" class="form-control" id="birthdate_b2" name="birthdate_b2" placeholder="Enter Birthdate">
                                    </div>
                                    <div class="form-group col">
                                        <label for="sex_b2">Sex</label>
                                        <select class="form-control chosen-select" id="sex_b2" name="sex_b2">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="relationship_b2">Relationship</label>
                                        <input type="text" class="form-control" id="relationship_b2" name="relationship_b2" placeholder="Enter Relationship">
                                    </div>
                                    <div class="form-group col">
                                        <label for="contact_num_b2">Contact #</label>
                                        <input type="number" class="form-control" id="contact_num_b2" name="contact_num_b2" placeholder="Enter Contact Number (+63)">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
                                <legend class="h5 pl-2 pr-2" style="width: auto; !important">Others</legend>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="contact_person">Contact Person</label>
                                        <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Enter Contact Person">
                                    </div>
                                    <div class="form-group col">
                                        <label for="contact_person_num">Contact #:</label>
                                        <input type="text" class="form-control" id="contact_person_num" name="contact_person_num" placeholder="Enter Contact Person's Number">
                                    </div>
                                    <div class="form-group col">
                                        <label for="registration_fee">Registration Fee:</label>
                                        <input type="number" class="form-control" id="registration_fee" name="registration_fee" placeholder="Enter Registration Fee Amount">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="contact_person_num">Agent:</label>
                                        <select class="form-control chosen-select" id="agent_id" name="agent_id">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id; }}">{{ $user->fname.' '.$user->mname.' '.$user->lname; }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="contact_person_num">Amount Collected:</label>
                                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
                                    </div>
                                    <div class="form-group col">
                                        <label for="contact_person_num">Incentives (%):</label>
                                        <input type="text" class="form-control" id="incentives" name="incentives" placeholder="Enter Incentive's Percentage">
                                    </div>
                                    <div class="form-group col">
                                        <label for="contact_person_num">Fidelity (%):</label>
                                        <input type="text" class="form-control" id="fidelity" name="fidelity" placeholder="Enter Fidelity">
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" style="margin-left: 10px;" onclick="hideForm()">Cancel</button>
                        </div>
                    </form>
                </div>

                <!-- VIEW SECTION -->
                <div class="card card-primary" id="view" style="display: none;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Delete Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Delete Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" action="/members/destroy" method="POST">
                @csrf
                <div class="modal-body">
                    <h6>Do you want to remove <span id="del_fname"></span> <span id="del_lname"></span> as a Member?</h6>
                    <input type="hidden" id="delete_id" name="id" value="" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-danger" value="Delete" />
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="ImportModal" tabindex="-1" role="dialog" aria-labelledby="ImportModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uploadForm" action="/members/importMembers" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <label for="data_count">Data Count (The higher the slower)</label>
                            <select class="form-control chosen-select" id="data_count" name="data_count" value="10">
                                <option value="10">10</option>
                                <option value="20">50</option>
                                <option value="20">100</option>
                                <option value="20">200</option>
                                <option value="20">500</option>
                            </select>
                        </div>
                    </div> <br>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<form id="soa_printer" method="POST">
    @csrf
</form>

<script>
    
    function showForm()
    {
        $("#table").attr("style", "display: none;");
        $("#form").removeAttr("style");
    }

    function hideForm()
    {
        $("#form").attr("style", "display: none;");
        $("#view").attr("style", "display: none;");
        $("#view").html("");
        $("#table").removeAttr("style");
    }

    function checkBeneficiaries()
    {
        var program = $("#program_id").val();
        var x = $("#ben_" + program).html();
        if(x == 0){
            $(".beneficiaries").removeAttr("style");
            $(".beneficiaries").attr("style", "display: none;");
        } else {
            $(".beneficiaries").removeAttr("style");
            $(".beneficiaries").attr("style", "--bs-border-opacity: .5;");
        }
    }

    function viewFunction(id)
    {
        $("#view").load('/members/view/'+id);
        checkBeneficiaries();
        $("#table").attr("style", "display: none;");
        $("#view").removeAttr("style");
    }

    function editFunction(id)
    {
        $("#view").load('/members/edit/'+id);
        checkBeneficiaries();
        $("#table").attr("style", "display: none;");
        $("#view").removeAttr("style");
    }

    function deleteFunction(id)
    {
        var fname = $("#"+id+"_fname").html();
        var lname = $("#"+id+"_lname").html();
        $("#del_fname").html(fname);
        $("#del_lname").html(lname);
        $("#delete_id").val(id);
    }

    function printFunction(id){
        window.open('/members/print/'+id);
        //$("#soa_printer").attr('action','/members/print/'+id);
        //$("#soa_printer").submit();
    }

</script>