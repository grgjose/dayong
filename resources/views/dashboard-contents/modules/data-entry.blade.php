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

    .chosen-container-single {
        border-radius: 5px;
        height: calc(2.25rem + 2px);
        /* padding-top: 10px; */
    }

    .class-with-tooltip:hover:after{
        opacity: 1;
        transition: all 0.8s ease 0.5s;
        visibility: visible;
    }

    .class-with-tooltip:after{
        content: attr(data-title);
        position: absolute;
        padding: 5px;
        border: 1px solid gray;
        background: black;
        font-size: 14px;
        visibility: hidden;
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
                        <h2 class="card-title" style="padding-top: 10px;">Collection Table</h2>
                        @if($my_user->usertype != 3)
                            <button class="btn btn-success float-right" onclick="showForm()">
                                <span class="fas fa-plus"></span> Add Collection
                            </button>
                            <button class="btn btn-secondary float-right mr-3" data-toggle="modal" data-target="#ImportModal">
                                <span class="fas fa-upload"></span> Import From Excel Collection
                            </button>
                        @endif
                    </div>
                    <div class="card-body">
                        <table id="normalTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch</th>
                                    <th>Agent</th>
                                    <th>Member</th>
                                    <th>OR</th>
                                    <th>Amount</th>
                                    <th>NOP</th>
                                    <th>Program</th>
                                    <th>Is Reactivated</th>
                                    <th>Is Transferred</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entries as $entry)   
                                    <tr>
                                        <td><input type="checkbox" /></td>
                                        <td>
                                            @foreach($branches as $branch)
                                                @if($branch->id == $entry->branch_id)
                                                    {{ $branch->branch; }}
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($users as $user)
                                                @if($user->id == $entry->agent_id)
                                                    {{ $user->fname.' '.$user->lname; }}
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($members as $member)
                                                @if($member->id == $entry->member_id)
                                                    {{ $member->fname.' '.$member->lname; }}
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $entry->or_number; }}</td>
                                        <td>{{ $entry->amount; }}</td>
                                        <td>{{ $entry->number_of_payment; }}</td>
                                        <td>
                                            @foreach($programs as $program)
                                                @if($program->id == $entry->program_id)
                                                    {{ $program->code; }}
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ ($entry->is_reactivated == 1)?'YES':'NO'; }}</td>
                                        <td>{{ ($entry->is_transferred)?'YES':'NO'; }}</td>
                                        <td>{{ $entry->remarks; }}</td>
                                        <td>
                                            <button class="btn btn-outline-info class-with-tooltip" data-toggle="modal" data-target="#ViewModal"
                                                onclick="viewFunction({{ $entry->id; }})" data-title="View Details">
                                                <span class="fas fa-eye"></span>
                                            </button>

                                            @if($my_user->usertype == 1)
                                                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#EditModal" 
                                                    onclick="editFunction({{ $entry->id; }})" data-title="Edit Details">
                                                    <span class="fas fa-pen"></span>
                                                </button>
                                                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#DeleteModal"
                                                onclick="deleteFunction({{ $entry->id; }})" data-title="Delete">
                                                    <span class="fas fa-trash"></span>
                                                </button>
                                            @endif
                                            
                                            <!--button class="btn btn-outline-info" data-toggle="modal" data-target="#PrintModal"
                                                onclick="">
                                                <span class="fas fa-print"></span>
                                            </button -->

                                            <button class="btn btn-outline-success" data-toggle="modal" data-target="#RemitModal"
                                                onclick="pushRemittance({{ $entry->id; }})" data-title="Remit">
                                                <span class="fas fa-money-bill-wave-alt"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ADD ENTRY SECTION -->
                <div class="card card-primary" id="form" style="display: none;">
                    <div class="card-header">
                        <h3 class="card-title" style="padding-top: 10px;">New Collections Form</h3>
                        <button class="btn btn-secondary float-right" style="color: white;" onclick="hideForm()">
                            <span class="fas fa-times"></span> Cancel
                        </button>
                    </div>
                    <form id="form_tag" action="/entries/store" method="post">
                        @csrf
                        <div class="card-body">
                            <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
                                <legend class="h5 pl-2 pr-2" style="width: auto; !important">Collection Details</legend>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="member_id">Member:</label>
                                        <select class="form-control chosen-select" id="member_id" name="member_id" onload="checkAutoFills()" onchange="checkAutoFills()">
                                            @foreach($members as $member)
                                                <option value="{{ $member->id; }}">{{ $member->fname.' '.$member->mname.' '.$member->lname; }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="branch_id">Branch:</label>
                                        <select class="form-control chosen-select" id="branch_id" name="branch_id">
                                            @foreach($branches as $branch)
                                                <option value="{{ $branch->id; }}">{{ $branch->branch; }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="member_id">Agent:</label>
                                        <select class="form-control chosen-select" id="agent_id" name="agent_id">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id; }}">{{ $user->fname.' '.$user->mname.' '.$user->lname; }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="branch_id">Program:</label>
                                        <select class="form-control chosen-select" id="program_id" name="program_id" onload="checkAutoFills()" onchange="checkAutoFills()">
                                            @foreach($programs as $program)
                                                <option value="{{ $program->id; }}">{{ $program->code; }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="or_number">OR:</label>
                                        <input type="text" class="form-control" id="or_number" name="or_number" value="" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="amount">Amount:</label>
                                        <input type="number" class="form-control" id="amount" name="amount" value="" required>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="times">How many Payments:</label>
                                        <input type="number" class="form-control" id="times" name="number_of_payment" value="" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="month_from">From (Month):</label>
                                        <input type="month" class="form-control" id="times" name="month_from" value="" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="month_to">To (Month):</label>
                                        <input type="month" class="form-control" id="times" name="month_to" value="" required>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="incentive">Incentive 1-50 (%):</label>
                                        <input type="number" class="form-control" id="incentives" name="incentives" onkeyup="enforceMinMax(this)" min="1" max="50">
                                    </div>
                                    {{-- <div class="form-group col">
                                        <label for="fidelity">Fidelity 1-10 (%):</label>
                                        <input type="number" class="form-control" id="fidelity" name="fidelity" onkeyup="enforceMinMax(this)" min="1" max="10">
                                    </div> --}}
                                    <div class="form-group col">
                                        <div class="custom-control custom-switch custom-switch-on-warning" style="padding-left: 3.25rem; padding-top: 2.25rem;">
                                            <input type="checkbox" class="custom-control-input" id="reactivated" name="reactivated" value="reactivated">
                                            <label for="reactivated" class="custom-control-label">Is Reactivated</label>
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <div class="custom-control custom-switch custom-switch-on-success" style="padding-left: 3.25rem; padding-top: 2.25rem;">
                                            <input type="checkbox" class="custom-control-input" id="transferred" name="transferred" value="transferred">
                                            <label for="transferred" class="custom-control-label">Is Transferred</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="remarks">Remarks:</label>
                                        <input type="text" class="form-control" id="remarks" name="remarks" value="">
                                    </div>
                                </div> <br>
                            </fieldset>

                        </div>
                        <div class="card-footer">
                            <button id="store_btn" type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" style="margin-left: 10px;" onclick="hideForm()">Cancel</button>
                        </div>
                    </form>
                </div>

                <!-- UPDATE ENTRY SECTION -->
                <div class="card card-primary" id="edit_form" style="display: none;">
                    <div class="card-header">
                        <h3 class="card-title" style="padding-top: 10px;">New Collections Form</h3>
                        <button class="btn btn-secondary float-right" style="color: white;" onclick="hideForm()">
                            <span class="fas fa-times"></span> Cancel
                        </button>
                    </div>
                    <form id="editForm" action="/entries/update" method="post">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
                                <legend class="h5 pl-2 pr-2" style="width: auto; !important">Collection Details</legend>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="branch_id">Branch:</label>
                                        <select class="form-control chosen-select" id="edit_branch_id" name="branch_id">
                                            @foreach($branches as $branch)
                                                <option value="{{ $branch->id; }}">{{ $branch->branch; }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="member_id">Agent:</label>
                                        <select class="form-control chosen-select" id="edit_agent_id" name="agent_id">
                                            @foreach($users as $user)
                                                <option value="{{ $user->id; }}">{{ $user->fname.' '.$user->mname.' '.$user->lname; }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="member_id">Member:</label>
                                        <select class="form-control chosen-select" id="edit_member_id" name="member_id">
                                            @foreach($members as $member)
                                                <option value="{{ $member->id; }}">{{ $member->fname.' '.$member->mname.' '.$member->lname; }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="branch_id">Program:</label>
                                        <select class="form-control chosen-select" id="edit_program_id" name="program_id">
                                            @foreach($programs as $program)
                                                <option value="{{ $program->id; }}">{{ $program->code; }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="or_number">OR:</label>
                                        <input type="text" class="form-control" id="edit_or_number" name="or_number" value="" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="amount">Amount:</label>
                                        <input type="number" class="form-control" id="edit_amount" name="amount" value="" required>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="times">How many Payments:</label>
                                        <input type="number" class="form-control" id="edit_times" name="number_of_payment" value="" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="month_from">From (Month):</label>
                                        <input type="month" class="form-control" id="edit_month_from" name="month_from" value="" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="month_to">To (Month):</label>
                                        <input type="month" class="form-control" id="edit_month_to" name="month_to" value="" required>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="remarks">Remarks:</label>
                                        <input type="text" class="form-control" id="edit_remarks" name="remarks" value="">
                                    </div>
                                </div> <br>
                            </fieldset>

                        </div>
                        <div class="card-footer">
                            <button id="store_btn" type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" style="margin-left: 10px;" onclick="hideForm()">Cancel</button>
                        </div>
                    </form>
                </div>

                <!-- VIEW ENTRY SECTION -->
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
                <h5 class="modal-title">Delete Collection Data?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" action="/entries/destroy" method="POST">
                @csrf
                <div class="modal-body">
                    <h6>Do you want to remove this Collection?</h6>
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
            <form id="uploadForm_collection" action="/entries/import" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <label for="data_count">Data Count (The higher the slower)</label>
                            <div id="response"></div>
                            <select class="form-control chosen-select" id="data_count" name="data_count" value="1000">
                                <option value="1000">1000</option>
                                <option value="5000">5000</option>
                                <option value="10000">10000</option>
                                <option value="12000">12000</option>
                                <option value="15000">15000</option>
                            </select>
                        </div>
                    </div> <br>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" id="uploadButton_collection" class="btn btn-primary">Upload</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<span style="display: none;" id="temp"></span>

<script>

    function hideForm()
    {
        $("#form").attr("style", "display: none;");
        $("#edit_form").attr("style", "display: none;");
        $("#view").attr("style", "display: none;");
        $("#view").html("");
        $("#table").removeAttr("style");
    }

    function showForm()
    {
        $("#table").attr("style", "display: none;");
        $("#form").removeAttr("style");
    }

    function viewFunction(id)
    {
        $("#view").load('/entries/view/'+id);
        $("#table").attr("style", "display: none;");
        $("#view").removeAttr("style");
    }

    function editFunction(id)
    {
        $("#view").load('/entries/edit/'+id);
        $("#table").attr("style", "display: none;");
        $("#view").removeAttr("style");
    }

    function deleteFunction(id)
    {
        var display = $("#branch_"+id).html();
        $("#del_display").html(display);
        $("#delete_id").val(id);
    }

    function checkAutoFills()
    {

        $( "#temp" ).load( "/entries/getIncentivesMatrix/"+$("#member_id").val()+"/"+$("#program_id").val(), function( response, status, xhr ) {
            if ( status == "error" ) {
                var msg = "Sorry but there was an error: ";
                $( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
                window.alert(msg + xhr.status + " " + xhr.statusText);
            }
            if ( status == "success" ) {
                $("#incentives").val(response);
            }
        });
    }

    function formatDate(date)
    {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('-');
    }

    function enforceMinMax(el) {
        if (el.value != "") {
            if (parseInt(el.value) < parseInt(el.min)) {
            el.value = el.min;
            }
            if (parseInt(el.value) > parseInt(el.max)) {
            el.value = el.max;
            }
        }
    }
 
</script>