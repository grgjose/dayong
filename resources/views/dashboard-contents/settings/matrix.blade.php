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

                <div class="card card-info" id="table">
                    <div class="card-header">
                        <h2 class="card-title" style="padding-top: 10px;">Incentives Matrix</h2>
                        <button class="btn btn-success float-right" style="color: antiquewhite;" onclick="showForm()">
                            <span class="fas fa-plus"></span> Add Matrix Item
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="normalTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Program</th>
                                    <th>NOP</th>
                                    <th>Percentage (%)</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matrix as $m)   
                                    <tr>
                                        <td><input type="checkbox" /></td>
                                        <td id="program_{{ $m->id; }}">
                                            @foreach($programs as $program)
                                                @if($program->id == $m->program_id)
                                                    {{ $program->code; }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td id="nop_{{ $m->id; }}">{{ $m->nop; }}</td>
                                        <td id="percentage_{{ $m->id; }}">{{ $m->percentage; }}</td>
                                        <td id="created_at_{{ $m->id; }}">{{ $m->created_at; }}</td>
                                        <td id="updated_at_{{ $m->id; }}">{{ $m->updated_at; }}</td>
                                        <td>
                                            <button class="btn btn-outline-primary" onclick="editFunction({{ $m->id; }})">
                                                <span class="fas fa-pen"></span>
                                            </button>
                                            <button class="btn btn-outline-danger" data-toggle="modal" data-target="#DeleteModal"
                                            onclick="deleteFunction({{ $m->id; }})">
                                                <span class="fas fa-trash"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card card-primary" id="form" style="display: none;">
                    <div class="card-header">
                        <h3 class="card-title" style="padding-top: 10px;">Create Program Form</h3>
                        <button class="btn btn-secondary float-right" style="color: white;" onclick="hideForm()">
                            <span class="fas fa-times"></span> Cancel
                        </button>
                    </div>
                    <form id="form_tag" action="/program/store" method="post">
                        @csrf
                        <div class="card-body">
                            <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
                                <legend class="h5 pl-2 pr-2" style="width: auto; !important">Program Details</legend>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="code">Code:</label>
                                        <input type="text" class="form-control" id="code" name="code" value="" required>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="description">Description:</label>
                                        <input type="text" class="form-control" id="description" name="description" value="" required>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="with_beneficiaries">With Beneficiaries:</label>
                                        <select type="text" class="form-control chosen-select" id="with_beneficiaries" name="with_beneficiaries" value="" required>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="age_min">Minimum Age:</label>
                                        <input type="number" class="form-control" id="age_min" name="age_min" value="">
                                    </div>
                                    <div class="form-group col">
                                        <label for="age_max">Maximum Age:</label>
                                        <input type="number" class="form-control" id="age_max" name="age_max" value="">
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

                <div class="card card-primary" id="edit_form" style="display: none;">
                    <div class="card-header">
                        <h3 class="card-title" style="padding-top: 10px;">Update Program Form</h3>
                        <button class="btn btn-secondary float-right" style="color: white;" onclick="hideForm()">
                            <span class="fas fa-times"></span> Cancel
                        </button>
                    </div>
                    <form id="editForm" action="/program/update" method="post">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <fieldset class="border p-3 mb-2 rounded" style="--bs-border-opacity: .5;">
                                <legend class="h5 pl-2 pr-2" style="width: auto; !important">Program Details</legend>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="code">Code:</label>
                                        <input type="text" class="form-control" id="edit_code" name="code" value="" required>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="description">Description:</label>
                                        <input type="text" class="form-control" id="edit_description" name="description" value="" required>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="with_beneficiaries">With Beneficiaries:</label>
                                        <select class="form-control chosen-select" id="edit_with_beneficiaries" name="with_beneficiaries" required>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label for="age_min">Minimum Age:</label>
                                        <input type="number" class="form-control" id="edit_age_min" name="age_min" value="">
                                    </div>
                                    <div class="form-group col">
                                        <label for="age_max">Maximum Age:</label>
                                        <input type="number" class="form-control" id="edit_age_max" name="age_max" value="">
                                    </div>
                                </div> <br>
                            </fieldset>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" style="margin-left: 10px;" onclick="hideForm()">Cancel</button>
                        </div>
                    </form>
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
                <h5 class="modal-title">Delete Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" action="/program/destroy" method="POST">
                @csrf
                <div class="modal-body">
                    <h6>Do you want to remove <span id="del_display"></span> Program?</h6>
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

<script>

    function hideForm(){
        $("#form").attr("style", "display: none;");
        $("#edit_form").attr("style", "display: none;");
        $("#table").removeAttr("style");
    }

    function showForm(){
        $("#table").attr("style", "display: none;");
        $("#form").removeAttr("style");
    }

    function editFunction(id){
        $("#table").attr("style", "display: none;");
        $("#edit_form").removeAttr("style");

        $("#edit_code").val($("#code_"+id).html());
        $("#edit_description").val($("#description_"+id).html());
        $("#edit_with_beneficiaries").val($("#with_beneficiaries_"+id).html().toLowerCase().trim()).trigger("chosen:updated");;
        $("#edit_age_min").val($("#age_min_"+id).html());
        $("#edit_age_max").val($("#age_max_"+id).html());

        $("#editForm").attr("action", "/program/update/"+id);
    }

    function deleteFunction(id){
        var display = $("#code_"+id).html();
        $("#del_display").html(display);
        $("#delete_id").val(id);
    }

    function formatDate(date) {
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
 
</script>