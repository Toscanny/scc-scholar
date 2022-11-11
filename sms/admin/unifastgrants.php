<!-- Includes&Session -->
<?php

include('../class/dbcon.php');

$object = new sms;

if(!$object->is_login())
{
    header("location:".$object->base_url."admin");
}

if($_SESSION['type'] != 'Admin')
{
    header("location:".$object->base_url."");
}

include('header.php');

?>
<!-- Table -->
<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">UNIFAST Approved Grantees Management</h1>

<!-- DataTales Example -->
    <span id="message"></span>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">Applicant List</h6>
                </div>
                <div class="col" align="right">
                    <button type="button" name="add_unifast" id="add_unifast" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></button>
                    <button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-times"></i></button>
                    <button type="button" name="approve_all" id="approve_all" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-thumbs-up"></i></button>
                    <button type="button" name="reject_all" id="reject_all" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-thumbs-down"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="unifast_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Address</th>
                            <th>Contact No.</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
include('footer.php');
?>
<!-- Add Modal -->
<div id="unifastModal" class="modal fade">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form method="post" id="unifast_form" class="needs-validation" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add UNIFAST Scholar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="form_message"></span>
                    <div class="form-group">
                    <div class="card">
                    <div class="card-header" style="font-weight: bold; font-size: 18px;">Student ID Details</div>
                    <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                                <label>Student ID NO.<span class="text-danger">*</span></label>
                                <input type="text" name="sustudent_id" id="sustudent_id" class="form-control" required/>
                                <span id="error_sustudent_id" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="card">
                    <div class="card-header" style="font-weight: bold; font-size: 18px;">Personal Details</div>
                    <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Last Name<span class="text-danger">*</span></label>
                                <input type="text" name="suslname" id="suslname" class="form-control" required/>
                                <span id="error_suslname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Given Name<span class="text-danger">*</span></label>
                                <input type="text" name="susfname" id="susfname" class="form-control" required/>
                                <span id="error_susfname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Middle Name<span class="text-danger">*</span></label>
                                <input type="text" name="susmname" id="susmname" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_susmname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Select Suffix<span class="text-danger">*</label>
                                <select name="susnext" id="susnext" class="form-control" required>
                                <option value="">-Select-</option>
                                <option value="N/A">N/A</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                </select>
                                <span id="error_susnext" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>Gender<span class="text-danger">*</label>
                                <select name="susgender" id="susgender" class="form-control" required>
                                <option value="">-Select-</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                </select>
                                <span id="error_susgender" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Date of Birth<span class="text-danger">*</label>
                                <input type="date" name="susdbirth" id="susdbirth" autocomplete="off" class="form-control" required>
                                <span id="error_susdbirth" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Contact No.<span class="text-danger">*</span></label>
                                <input type="text" name="suscontact" id="suscontact" class="form-control" required/>
                                <span id="error_suscontact" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label>Permanent Home Address<span class="text-danger">*</span></label>
                                <textarea type="text" name="susaddress" id="susaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                <span id="error_susaddress" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label>Previous School Attended<span class="text-danger">*</span></label>
                                <textarea type="text" name="susspattended" id="susspattended" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                <span id="error_susspattended" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>Course/Program<span class="text-danger">*</span></label>
                                <input type="text" name="suscp" id="suscp" class="form-control" required/>
                                <span id="error_suscp" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>Year Level<span class="text-danger">*</span></label>
                                <input type="text" name="susyl" id="susyl" class="form-control" required/>
                                <span id="error_susyl" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                            <label>Email Address<span class="text-danger">*</span></label>
                                <input type="text" name="suspemail" id="suspemail" class="form-control" required/>
                                <span id="error_suspemail" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="card">
                    <div class="card-header" style="font-weight: bold; font-size: 18px;">Family Details</div>
                    <div class="card-body">
                    <div class="form-group">
                        <h4 class="sub-title" style="font-weight: bold; font-size: 16px;">Father Details</h4>
                            <div class="row" >
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Last Name<span class="text-danger">*</span></label>
                                <input type="text" name="susflname" id="susflname" class="form-control" required/>
                                <span id="error_susflname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Given Name<span class="text-danger">*</span></label>
                                <input type="text" name="susffname" id="susffname" class="form-control" required/>
                                <span id="error_susffname" class="text-danger"></span>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Middle Name<span class="text-danger">*</span></label>
                                <input type="text" name="susfmname" id="susfmname" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_susfmname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Select Suffix<span class="text-danger">*</label>
                                <select name="susfnext" id="susfnext" class="form-control" required>
                                <option value="">-Select-</option>
                                <option value="N/A">N/A</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                </select>
                                <span id="error_susfnext" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <h4 class="sub-title" style="font-weight: bold; font-size: 16px;">Mother Details</h4>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Last Name<span class="text-danger">*</span></label>
                                <input type="text" name="susmlname" id="susmlname" class="form-control" required/>
                                <span id="error_susmlname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Given Name<span class="text-danger">*</span></label>
                                <input type="text" name="susmfname" id="susmfname" class="form-control" required/>
                                <span id="error_susmfname" class="text-danger"></span>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Middle Name<span class="text-danger">*</span></label>
                                <input type="text" name="susmmname" id="susmmname" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_susmmname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Select Suffix<span class="text-danger">*</label>
                                <select name="susmnext" id="susmnext" class="form-control" required>
                                <option value="">-Select-</option>
                                <option value="N/A">N/A</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                </select>
                                <span id="error_susmnext" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <label>DSWD Household / 4ps No.<span class="text-danger">*</label>
                                <input type="text" name="susdswd" id="susdswd" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_susdswd" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <label>Household Capital Income<span class="text-danger">*</label>
                                <input type="text" name="sushci" id="sushci" class="form-control" required/>
                                <span id="error_sushci" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <label>Specify Disability / Attached PWD Id<span class="text-danger">*</label>
                                <input type="text" name="susdid" id="susdid" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_susdid" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                            <label>Date Filed<span class="text-danger">*</label>
                                <input type="date" name="susdfilled" id="susdfilled" autocomplete="off" class="form-control" required>
                                <span id="error_susdfilled" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="card">
                        <div class="card-header" style="font-weight: bold; font-size: 18px;">Requirements Details</div>
                            <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Date Recv. Phoc. PSA<span class="text-danger">*</span></label>
                                        <input type="date" name="sudrpic" id="sudrpic" autocomplete="off" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Date Recv. 2x2 ID Picture<span class="text-danger">*</span></label>
                                        <input type="date" name="sudrpsa" id="sudrpsa" autocomplete="off" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Date Recv. Brgy. Indigency<span class="text-danger">*</span></label>
                                        <input type="date" name="sudrobr" id="sudrobr" autocomplete="off" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Select Phoc. PSA Status<span class="text-danger">*</span></label>
                                        <select name="sudrpicstat" id="sudrpicstat" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <option value="Received">Received</option>
                                        <option value="Not-Received">Not-Received</option>
                                        </select>
                                        <span id="error_sudrpicstat" class="text-danger"></span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Select 2x2 ID Pic. Status<span class="text-danger">*</span></label>
                                        <select name="sudrpsastat" id="sudrpsastat" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <option value="Received">Received</option>
                                        <option value="Not-Received">Not-Received</option>
                                        </select>
                                        <span id="error_sudrpsastat" class="text-danger"></span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Select Brgy. Res. Status<span class="text-danger">*</span></label>
                                        <select name="sudrobrstat" id="sudrobrstat" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <option value="Received">Received</option>
                                        <option value="Not-Received">Not-Received</option>
                                        </select>
                                        <span id="error_sudrobrstat" class="text-danger"></span>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="card">
                        <div class="card-header" style="font-weight: bold; font-size: 18px;">Account Details</div>
                            <div class="card-body">
                                <div class="form-group">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="text" name="susaemail" id="susaemail" class="form-control" required/>
                                <span id="error_susaemail" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                <label>Password<span class="text-danger">*</span></label>
                                <input type="password" name="susapass" id="susapass" class="form-control" required/>
                                <span id="error_susapass" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="card">
                        <div class="card-header" style="font-weight: bold; font-size: 18px;">Scholarship Details</div>
                            <div class="card-body">
                                <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                                    <label>Select Grant Status<span class="text-danger">*</span></label>
                                    <select name="susgrantstat" id="susgrantstat" class="form-control" required>
                                    <option value="">-Select-</option>
                                    <option value="New">New</option>
                                    <option value="Old">Old</option>
                                    </select>
                                    <span id="error_susgrantstat" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- View Modal -->
<div id="viewModal" class="modal fade">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">View Student Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="nonacad_details">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- CSS Style -->
<style>
.removeRow
{
    background-color: #FF0000;
    color:#FFFFFF;
}
</style>
<!-- Table Function -->
<!-- Script -->
<script>
$(document).ready(function(){

    var dataTable = $('#unifast_table').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            url:"unifastgrants_action.php",
            type:"POST",
            data:{action:'fetch'}
        },
        "columnDefs":[
            {
                "targets":[0],
                "orderable":false,
                'checkboxes': {
                'selectRow': true
            }
            },
        ],
        'select': {
        'style': 'multi'
        },
        // 'order': [[1, 'asc']]	
    });

    // $('#susdbirth').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });
    // $('#sudrpic').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });
    // $('#sudrpsa').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });
    // $('#sudrobr').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });
    // $('#susdfilled').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });

// Add 
$('#add_unifast').click(function(){

    $('#unifast_form')[0].reset();

    $('#unifast_form').parsley().reset();

    $('#modal_title').text('Add UNIFAST Scholar');

    $('#action').val('Add');

    $('#submit_button').val('Add');

    $('#unifastModal').modal('show');

    $('#form_message').html('');
});
// Submit
$('#unifast_form').parsley();

$('#unifast_form').on('submit', function(event){
    event.preventDefault();
    if($('#unifast_form').parsley().isValid())
    {		
        $.ajax({
            url:"unifastgrants_action.php",
            method:"POST",
            data: new FormData(this),
            dataType:'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend:function()
            {
                $('#submit_button').attr('disabled', 'disabled');
                $('#submit_button').val('wait...');
            },
            success:function(data)
            {
                $('#submit_button').attr('disabled', false);
                if(data.error != '')
                {
                    $('#form_message').html(data.error);
                    $('#submit_button').val('Add');
                }
                else
                {
                    $('#unifastModal').modal('hide');
                    $('#message').html(data.success);
                    dataTable.ajax.reload();

                    setTimeout(function(){

                        $('#message').html('');

                    }, 5000);
                }
            }
        })
    }
});

// Edit
$(document).on('click', '.edit_button', function(){

    var sunifast_id = $(this).data('id');

    $('#unifast_form')[0].reset();

    $('#unifast_form').parsley().reset();

    $('#form_message').html('');

    $.ajax({

        url:"unifastgrants_action.php",

        method:"POST",

        data:{sunifast_id:sunifast_id, action:'fetch_single'},

        dataType:'JSON',

        success:function(data)
        {
// Account Details
            $('#susaemail').val(data.susaemail);
            $('#susapass').val(data.susapass);
// Personal Details
            $('#sustudent_id').val(data.sustudent_id);
            $('#susfname').val(data.susfname);
            $('#susmname').val(data.susmname);
            $('#suslname').val(data.suslname);
            $('#susnext').val(data.susnext);
            $('#susgender').val(data.susgender);
            $('#susdbirth').val(data.susdbirth);
            $('#suscontact').val(data.suscontact);
            $('#susaddress').val(data.susaddress);
            $('#susspattended').val(data.susspattended);
            $('#suscp').val(data.suscp);
            $('#susyl').val(data.susyl);
            $('#suspemail').val(data.suspemail);     
// Family Details
    // Father Details
            $('#susffname').val(data.susffname);
            $('#susfmname').val(data.susfmname);
            $('#susflname').val(data.susflname);
            $('#susfnext').val(data.susfnext);
    // Mother Details
            $('#susmfname').val(data.susmfname);
            $('#susmmname').val(data.susmmname);
            $('#susmlname').val(data.susmlname);
            $('#susmnext').val(data.susmnext);
// Other Details
            $('#susdswd').val(data.susdswd);
            $('#sushci').val(data.sushci);
            $('#susdid').val(data.susdid);
            $('#susdfilled').val(data.susdfilled);
// Requirement Details
            $('#sudrpsa').val(data.sudrpsa);
            $('#sudrpsastat').val(data.sudrpsastat);
            $('#sudrpic').val(data.sudrpic);
            $('#sudrpicstat').val(data.sudrpicstat);
            $('#sudrobr').val(data.sudrobr);
            $('#sudrobrstat').val(data.sudrobrstat);
// Scholarship Details
            $('#sustype').val(data.sustype);
            $('#susgrantstat').val(data.susgrantstat);
            $('#susschstat').val(data.susschstat);
            $('#susdapply').val(data.susdapply);

            $('#modal_title').text('Edit Applicant Info');

            $('#action').val('Edit');

            $('#submit_button').val('Edit');

            $('#unifastModal').modal('show');

            $('#hidden_id').val(sunifast_id);

        }

    })

    });

// Change Status
$(document).on('click', '.status_button', function(){
    var id = $(this).data('id');
    var status = $(this).data('status');
    var next_status = 'Approved';
    if(status == 'Approved')
    {
        next_status = 'Rejected';
    }
    if(confirm("Are you sure you want to "+next_status+" it?"))
    {

        $.ajax({

            url:"unifastgrants_action.php",

            method:"POST",

            data:{id:id, action:'change_status', status:status, next_status:next_status},

            success:function(data)
            {

                $('#message').html(data);

                dataTable.ajax.reload();

                setTimeout(function(){

                    $('#message').html('');

                }, 5000);

            }

        })

    }
});

// Delete Function
$(document).on('click', '.delete_button', function(){

var id = $(this).data('id');

if(confirm("Are you sure you want to remove it?"))
{

    $.ajax({

        url:"unifastgrants_action.php",

        method:"POST",

        data:{id:id, action:'delete'},

        success:function(data)
        {

            $('#message').html(data);

            dataTable.ajax.reload();

            setTimeout(function(){

                $('#message').html('');

            }, 5000);

        }

    })

}

});

// View Function
$(document).on('click', '.view_button', function(){
    var sunifast_id = $(this).data('id');

    $.ajax({

        url:"unifastgrants_action.php",

        method:"POST",

        data:{sunifast_id:sunifast_id, action:'fetch_single'},

        dataType:'JSON',

        success:function(data)
        {
            var html = '<div class="table-responsive">';
            html += '<table class="table">';
        // Account Details
            html += '<tr><th width="40%" class="text-right" style="font-size:20px">Account Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">Email Address</th><td width="60%">'+data.susaemail+'</td></tr>';
        // Personal Details
            html += '<tr><th width="40%" class="text-left" style="font-size:20px">Personal Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">Student ID</th><td width="60%">'+data.sustudent_id+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.susfname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.susmname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.suslname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.susnext+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Gender</th><td width="60%">'+data.susgender+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date of Birth</th><td width="60%">'+data.susdbirth+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.suscontact+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Permanent Home Address</th><td width="60%">'+data.susaddress+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Previous School Attended</th><td width="60%">'+data.susspattended+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Course/Program</th><td width="60%">'+data.suscp+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Year Level</th><td width="60%">'+data.susyl+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Email Address</th><td width="60%">'+data.suspemail+'</td></tr>';
        // Family Details
            // Father Details
            html += '<tr><th width="40%" class="text-left" style="font-size:18px">Father Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.susffname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.susfmname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.susflname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.susfnext+'</td></tr>';
            // Mother Details
            html += '<tr><th width="40%" class="text-left" style="font-size:18px">Mother Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.susmfname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.susmmname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.susmlname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.susmnext+'</td></tr>';
        // Achievement Details
            html += '<tr><th width="40%" class="text-left" style="font-size:20px">Other Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">DSWD Household / 4ps No.</th><td width="60%">'+data.susdswd+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Household Capital Income</th><td width="60%">'+data.sushci+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Specify Disability / Attached PWD Id</th><td width="60%">'+data.susdid+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Filed</th><td width="60%">'+data.susdfilled+'</td></tr>';
        // Requirement Details
            html += '<tr><th width="40%" class="text-left" style="font-size:20px">Requirement Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Receive Photocopy of PSA</th><td width="60%">'+data.sudrpsa+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Photocopy of PSA Status</th><td width="60%">'+data.sudrpsastat+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Receive 2x2 ID Picture</th><td width="60%">'+data.sudrpic+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">2x2 ID Picture Status</th><td width="60%">'+data.sudrpicstat+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Receive Brgy. Residency</th><td width="60%">'+data.sudrobr+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Brgy. Residency Status</th><td width="60%">'+data.sudrobrstat+'</td></tr>';
        // Scholarship Details
            html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">Scholarship Type</th><td width="60%">'+data.sustype+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Grant Status</th><td width="60%">'+data.susgrantstat+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Scholarship Status</th><td width="60%">'+data.susschstat+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Applied</th><td width="60%">'+data.susdapply+'</td></tr>';
            html += '</table></div>';

            $('#viewModal').modal('show');

            $('#nonacad_details').html(html);

        }

    })
});

// Select
$(document).on('click', '.select_all', function(){
    var inputs = $("check_all");
    for(var i = 0; i < inputs.length; i++) 
    { 
        var id = inputs[i].getAttribute("id");
        if(type == "check_all") 
        {
            if(this.checked) 
            {
                inputs[i].checked = true;
            } 
            else 
            {
                inputs[i].checked = false;
            }
        } 
    }
    });
// Checkbox
$(document).on('click', '.checkbox', function(){
    if($(this).is(':checked'))
    {
        $(this).closest('tr').addClass('removeRow');
    }
    else
    {
        $(this).closest('tr').removeClass('removeRow');
    }
    });

// Approve 
$('#approve_all').click(function(){
    var checkbox = $('.checkbox:checked');
    var approve_status = 'Approved';
    if(checkbox.length > 0)
    {
        var checkbox_value = [];
        $(checkbox).each(function(){
            checkbox_value.push($(this).val());
        });

        $.ajax({
            url:"unifastgrants_action.php",
            method:"POST",
            data:{checkbox_value:checkbox_value, approve_status:approve_status, action:'approve_all'},
            success:function(data)
            {
                $('.removeRow').fadeOut(1500);
                $('#message').html(data);

                dataTable.ajax.reload();

                setTimeout(function(){

                    $('#message').html('');

                }, 5000);
            }
        });
    }
    else
    {
        alert("Please select at least one records");
    }
});

// Reject
$('#reject_all').click(function(){
    var checkbox = $('.checkbox:checked');
    var reject_status = 'Rejected';
    if(checkbox.length > 0)
    {
        var checkbox_value = [];
        $(checkbox).each(function(){
            checkbox_value.push($(this).val());
        });

        $.ajax({
            url:"unifastgrants_action.php",
            method:"POST",
            data:{checkbox_value:checkbox_value, reject_status:reject_status, action:'reject_all'},
            success:function(data)
            {
                $('.removeRow').fadeOut(1500);
                $('#message').html(data);

                dataTable.ajax.reload();

                setTimeout(function(){

                    $('#message').html('');

                }, 5000);
            }
        });
    }
    else
    {
        alert("Please select at least one records");
    }
});

// Delete All
$('#delete_all').click(function(){
    var checkbox = $('.checkbox:checked');
    if(checkbox.length > 0)
    {
        var checkbox_value = [];
        $(checkbox).each(function(){
            checkbox_value.push($(this).val());
        });

        $.ajax({
            url:"unifastgrants_action.php",
            method:"POST",
            data:{checkbox_value:checkbox_value, action:'delete_all'},
            success:function(data)
            {
                $('.removeRow').fadeOut(1500);
                $('#message').html(data);

                dataTable.ajax.reload();

                setTimeout(function(){

                    $('#message').html('');

                }, 5000);
            }
        });
    }
    else
    {
        alert("Please select at least one records");
    }
});

});
</script>