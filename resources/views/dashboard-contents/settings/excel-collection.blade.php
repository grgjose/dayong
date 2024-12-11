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
                        <h2 class="card-title" style="padding-top: 10px;">Excel Collection</h2>
                        @if($my_user->usertype == 1)
                            <button class="btn btn-secondary float-right mr-3" onclick="importExcel()" data-toggle="modal" data-target="#ImportModal">
                                <span class="fas fa-upload"></span> Import Excel
                            </button>
                        @endif
                    </div>
                    <div class="card-body">
                        <table id="excelCollectionTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Timestamp</td>
                                    <td>Branch</td>
                                    <td>Marketting Agent</td>
                                    <td>Status</td>
                                    <td>PH/MEMBER</td>
                                    <td>OR#</td>
                                    <td>OR Date</td>
                                    <td>Amount Collected</td>
                                    <td>Month Of</td>
                                    <td>NOP</td>
                                    <td>Date Remitted</td>
                                    <td>Dayong Program</td>
                                    <td>Reactivation</td>
                                    <td>Transferred</td>
                                    <td>Is Imported?</td>
                                    <td>Created At</td>
                                    <td>Updated At</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

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
            <form id="uploadForm" action="/excel-collection/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <label for="formFileSm">Database Excel:</label>
                            <input class="form-control form-control-sm" id="upload_file" name="upload_file" type="file" style="padding-bottom: 30px;">
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