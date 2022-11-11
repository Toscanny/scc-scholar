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

	$object->query = "
    SELECT * FROM tbl_student
    WHERE s_id = '".$_SESSION["admin_id"]."'
    ";

	$result = $object->get_result();


	include('header.php');

	?>
<!-- Table -->
		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Student Management</h1>

		<!-- DataTales Example -->
		<span id="message"></span>
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col">
						<h6 class="m-0 font-weight-bold text-primary">Student List</h6>
					</div>
					<div class="col" align="center">
						<div class="dropdown">
						<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success btn-circle btn-sm"><i class="fas fa-file-excel"></i></button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
							<button class="dropdown-item" type="button" name="add_csv" id="add_csv">Import CSV</button>
							<button class="dropdown-item" type="button" name="export_csv" id="export_csv">Export CSV</button>
						</div>
							<!-- <button type="button" name="add_pdf" id="add_pdf" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-file-pdf"></i></button> -->
						</div>
					</div>
					<div class="col" align="right">
						<button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-times"></i></button>
						<button type="button" name="active_all" id="active_all" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-thumbs-up"></i></button>
						<button type="button" name="inactive_all" id="inactive_all" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-thumbs-down"></i></button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="scholars_table" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>
									<input type="checkbox" name="select_all" id="select_all" />
								</th>
								<th>Last Name</th>
								<th>First Name</th>
								<th>Middle Name</th>
								<th>Current Course</th>
								<th>Current Year Level</th>
								<th>Contact No.</th>
								<th>Account Status</th>
								<th>Scholarship Type</th>
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
<!-- Edit Student Modal -->
	<div id="studentModal" class="modal fade">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<form method="post" id="student_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="studentModal_title">Edit Student Info</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<span id="form_message"></span>
						<div class="form-group">
							<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">Student ID Details</div>
								<div class="card-body">
								<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
									<label>Student ID NO.<span class="text-danger">*</span></label>
									<input type="text" name="ss_id" id="ss_id" class="form-control" required/>
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
									<label>First Name<span class="text-danger">*</span></label>
									<input type="text" name="sfname" id="sfname" class="form-control" required/>
									<span id="error_sfname" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label>Middle Name<span class="text-danger">*</span></label>
									<input type="text" name="smname" id="smname" class="form-control" placeholder="Put N/A if none" required/>
									<span id="error_smname" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label>Last Name<span class="text-danger">*</span></label>
									<input type="text" name="slname" id="slname" class="form-control" required/>
									<span id="error_slname" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
									<label>Select Suffix<span class="text-danger">*</span></label>
									<select name="snext" id="snext" class="form-control" required>
									<option value="">-Select-</option>
									<option value="N/A">N/A</option>
									<option value="Jr.">Jr.</option>
									<option value="Sr.">Sr.</option>
									</select>
									<span id="error_snext" class="text-danger"></span>
								</div>
								<div class="col-xs-10 col-sm-12 col-md-5">
									<label>Date of Birth<span class="text-danger">*</span></label>
									<input type="date" name="sdbirth" id="sdbirth" autocomplete="off" class="form-control" required />
									<span id="error_sdbirth" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
									<label>Select Gender<span class="text-danger">*</span></label>
									<select name="sgender" id="sgender" class="form-control" required>
									<option value="">Select Gender</option>
									<option value="M">Male</option>
									<option value="F">Female</option>
									</select>
									<span id="error_sgender" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-5">
									<label>Contact Number<span class="text-danger">*</span></label>
									<input type="text" name="scontact" id="scontact" class="form-control" required/>
									<span id="error_scontact" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
									<label>Civil Status<span class="text-danger">*</span></label>
									<input type="text" name="scivilstat" id="scivilstat" class="form-control" required/>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<label>Address<span class="text-danger">*</span></label>
									<textarea type="text" name="saddress" id="saddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
									<span id="error_saddress" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<label>Previous School Attended<span class="text-danger">*</span></label>
									<textarea type="text" name="spschname" id="spschname" class="form-control" required data-parsley-trigger="keyup"></textarea>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Student Course<span class="text-danger">*</span></label>
									<select name="sccourse" id="sccourse" class="form-control" required>
									<option value="">-Select-</option>
									<option value="BSIT">BSIT</option>
									<option value="BSBA">BSBA</option>
									<option value="BEED">BEED</option>
									<option value="BSED">BSED</option>
									<option value="BSCRIM">BSCRIM</option>
									<option value="BSHM">BSHM</option>
									<option value="BSTM">BSTM</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
									<label>Student Year Level<span class="text-danger">*</span></label>
									<select name="scsyrlvl" id="scsyrlvl" class="form-control" required>
									<option value="">-Select-</option>
									<option value="1st Year">1st Year</option>
									<option value="2nd Year">2nd Year</option>
									<option value="3rd Year">3rd Year</option>
									<option value="4th Year">4th Year</option>
									</select>
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
							<h5 class="sub-title" style="font-weight: bold; font-size: 16px;">Guardian Details</h5>
								<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<label>Full Name<span class="text-danger">*</span></label>
									<input type="text" name="sgfname" id="sgfname" class="form-control" required/>
									<span id="error_sgfname" class="text-danger"></span>
								</div>
								</div>
							</div>
							<div class="form-group">
							<h5 class="sub-title" style="font-weight: bold; font-size: 16px;">Father Details</h5>
								<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<label>Full Name<span class="text-danger">*</span></label>
									<input type="text" name="sffname" id="sffname" class="form-control" required/>
									<span id="error_sffname" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<label>Occupation<span class="text-danger">*</span></label>
									<input type="text" name="sfoccu" id="sfoccu" class="form-control" placeholder="Put N/A if none" required/>
									<span id="error_sfoccu" class="text-danger"></span>
								</div>
							</div>
							</div>
							<div class="form-group">
							<h5 class="sub-title" style="font-weight: bold; font-size: 16px;">Mother Details</h5>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<label>Full Name<span class="text-danger">*</span></label>
									<input type="text" name="smfname" id="smfname" class="form-control" required/>
									<span id="error_smfname" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<label>Occupation<span class="text-danger">*</span></label>
									<input type="text" name="smoccu" id="smoccu" class="form-control" placeholder="Put N/A if none" required/>
									<span id="error_smoccu" class="text-danger"></span>
								</div>
							</div>
							</div>
						</div>
						</div>
						</div>
						<div class="form-group">
						<div class="card">
						<div class="card-header" style="font-weight: bold; font-size: 18px;">Scholarship Details</div>
						<div class="card-body">
							<div class="form-group">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-5">
										<label>Scholarship Type<span class="text-danger">*</span></label>
										<input type="text" name="s_scholarship_type" id="s_scholarship_type" class="form-control" required/>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
										<label>Select Account Status<span class="text-danger">*</span></label>
										<select name="s_account_status" id="s_account_status" class="form-control" required>
										<option value="">Select Status</option>
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="student_hidden_id" id="student_hidden_id" />
						<input type="hidden" name="action" id="student_action" value="add_student" />
						<input type="submit" name="submit" id="student_submit_button" class="btn btn-success" value="Add" />
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>

<!-- View Acad Modal -->
	<div id="viewstudentModal" class="modal fade">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal_title">View Student Details</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" id="acad_details">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div id="viewchedModal" class="modal fade">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">View Student Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="ched_details">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- CSV Upload Modal -->
	<div id="csvUPModal" class="modal fade">
		<div class="modal-dialog modal-sm modal-dialog-centered">
			<form method="post" id="upload_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal_title" style="font-weight: bold; font-size: 20px;">Upload CSV File</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div id="upload_message"></div>
							<div class="row justify-content-center" id="upload_area">
								<div class="col-md-6">
									<input type="file" name="file" id="csv_file" />
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="action" value="upload" />
						<input type="submit" name="upload_file" id="upload_file" class="btn btn-success" value="Upload" />
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<!-- Import -->
	<div id="csvIMPModal" class="modal fade">
	<form method="post" id="import_form">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal_title" style="font-weight: bold; font-size: 20px;">Import Selected CSV File</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
					<div id="import_message"></div>
						<div class="card">
							<div class="card-header">
								<h5 class="card-title" style="font-weight: bold; font-size: 16px;">Select Column Target Data</h5>
							</div>
							<div class="card-body">
								<div class="table-responsive" id="process_area">

								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" name="import" id="import" class="btn btn-success" disabled value="Import" />
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
		</div>
	</form>
	</div>
	
<!-- CSS Style -->
	<style>
	.removeRow
	{
		background-color: #FF0000;
		color:#FFFFFF;
	}
	.modal.modal-fullscreen .modal-dialog {
	width:100vw;
	height:100vh;
	margin:0;
	padding:0;
	max-width:none;
	}
	.modal.modal-fullscreen .modal-content {
	height:auto;
	height:100vh;
	border-radius:0;
	border:none;
	}
	.modal.modal-fullscreen .modal-body {
	overflow-y:auto;
	}
	</style>
	<script>
	$(document).ready(function(){
// Table Function
	var dataTable = $('#scholars_table').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax" : {
			url:"csv_action.php",
			type:"POST",
			data:{action:'fetch'}
		},
		'columnDefs': [{
				'targets': 0,
				'searchable':false,
				'orderable':false,
			}],
			'order': [1, 'asc']
	});

// add_acad
	$('#add_acad').click(function(){

		$('#student_form')[0].reset();

		$('#student_form').parsley().reset();

		$('#studentModal_title').text('Add Academic Scholar');

		$('#action').val('add_acad');

		$('#student_submit_button').val('Add');

		$('#studentModal').modal('show');

		$('#form_message').html('');

	});

// Submit_student_form
	$('#student_form').parsley();

	$('#student_form').on('submit', function(event){
		event.preventDefault();
		if($('#student_form').parsley().isValid())
		{		
			$.ajax({
				url:"csv_action.php",
				method:"POST",
				data: new FormData(this),
				dataType:'json',
				contentType: false,
				cache: false,
				processData:false,
				beforeSend:function()
				{
					$('#student_submit_button').attr('disabled', 'disabled');
					$('#student_submit_button').val('wait...');
				},
				success:function(data)
				{
					$('#student_submit_button').attr('disabled', false);
					if(data.error != '')
					{
						$('#form_message').html(data.error);
						$('#student_submit_button').val('Add');
					}
					else
					{
						$('#studentModal').modal('hide');
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
// Upload CSV
		$('#add_csv').click(function(){
		
		$('#upload_form')[0].reset();

		$('#upload_form').parsley().reset();

		$('#action').val('Upload');

		$('#upload_file').val('Upload');

		$('#csvUPModal').modal('show');

		$('#upload_message').html('');

		});

// Upload Form
	$('#upload_form').parsley();
		
		$('#upload_form').on('submit', function(event){
		event.preventDefault();

			if($('#upload_form').parsley().isValid())
			{	
				$.ajax({
					url:"csv_action.php",
					method:"POST",
					data:new FormData(this),
					dataType:'json',
					contentType:false,
					cache:false,
					processData:false,
					success:function(data)
					{
						if(data.error != '')
						{
							$('#upload_message').html(data.error);
							setTimeout(function(){

							$('#upload_message').html('');

							}, 5000);
						}
						else
						{
							$('#csvUPModal').modal('hide');
							$('#csvIMPModal').modal('show');
							$('#process_area').html(data.output);
						}
					}
				});
			}

		});

// Other
		var total_selection = 0;

		var ss_id = 0;
		var sfname = 0;
		var slname = 0;
		var smname = 0;
		var sgender = 0;
		var scontact = 0;
		var sdbirth = 0;
		var saddress = 0;
		var scivilstat = 0;
		var sgfname = 0;
		var sffname = 0;
		var sfoccu = 0;
		var smfname = 0;
		var smoccu = 0;
		var spschname = 0;
		var scsyrlvl = 0;
		var sccourse = 0;
		var s_scholarship_type = 0;



		var column_data = [];

		$(document).on('change', '.set_column_data', function(){

		var column_name = $(this).val();

		var column_number = $(this).data('column_number');

		if(column_name in column_data)
		{

			alert('You have already define '+column_name+ ' column');

			$(this).val('');

			return false;	
	
		}

		if(column_name != '' || column_name in !column_data)
		{
			column_data[column_name] = column_number;
		}
		else
		{

			for(const [key, value] of entries)
			{
				if(value == column_number)
				{
					delete column_data[key];
				}
			}
		}

		total_selection = Object.keys(column_data).length;

		if(total_selection >= 3)
		{
		$('#import').attr('disabled', false);

		ss_id = column_data.ss_id;
		slname = column_data.slname;
		sfname = column_data.sfname;
		smname = column_data.smname;
		sgender = column_data.sgender;
		scontact = column_data.scontact;
		sdbirth = column_data.sdbirth;
		saddress = column_data.saddress;
		scivilstat = column_data.scivilstat;
		sgfname = column_data.sgfname;
		sffname = column_data.sffname;
		sfoccu = column_data.sfoccu;
		smfname = column_data.smfname;
		smoccu = column_data.smoccu;
		spschname = column_data.spschname;
		scsyrlvl = column_data.scsyrlvl;
		sccourse = column_data.sccourse;
		s_scholarship_type = column_data.s_scholarship_type;

		}
		else
		{
			$('#import').attr('disabled', 'disabled');
		}

		});
		

// Import
		$(document).on('click', '#import', function(event){

			event.preventDefault();

			$.ajax({
			url:"csv_action.php",
			method:"POST",
			data:{ss_id:ss_id, slname:slname, sfname:sfname,
				smname:smname, sgender:sgender, scontact:scontact, 
				sdbirth:sdbirth, saddress:saddress, scivilstat:scivilstat, 
				sgfname:sgfname, sffname:sffname, sfoccu:sfoccu, smfname:smfname, 
				smoccu:smoccu, spschname:spschname, scsyrlvl:scsyrlvl,
				sccourse:sccourse, s_scholarship_type:s_scholarship_type,
				action:'import'},
			beforeSend:function(){
				$('#import').attr('disabled', 'disabled');
				$('#import').text('Importing...');
			},
			success:function(data)
			{
				$('#import_form')[0].reset();

				// if(data.error !== '')
				// {
				// 	$('#message').html(data.error);
				// 	$('#csvIMPModal').modal('hide');
				// 	$('#import_form')[0].reset();
				// }
				if(data.success != '')
				{
					$('#csvIMPModal').modal('hide');
					$('#import_form')[0].reset();
					$('#message').html(data.success);
					setTimeout(function() 
					{
						location.reload();  //Refresh page
					}, 3000);
				}	
			}
			})
			
		});	
// Export
		$('#export_csv').click(function(){
        var checkbox = $('.checkbox:checked');
		var currentDate = new Date();
		var day = currentDate.getDate()
		var month = currentDate.getMonth() + 1
		var year = currentDate.getFullYear()
		var hours = currentDate.getHours()
		var minutes = currentDate.getMinutes()
		var seconds = currentDate.getSeconds()
		var times ="";

		if(hours>12){
		times = "0" + hours%12 + ":" + minutes + ":" + seconds +" PM"
		}
		else{
		times = "0" + hours%12 + ":" + minutes + ":" + seconds +" AM"
		}

		var d = day + "-" + month + "-" + year + " at " + times;

        if(checkbox.length > 0)
        {
            var checkbox_value = [];
            $(checkbox).each(function(){
                checkbox_value.push($(this).val());
            });

			const DownloadCsv = (function() {
			const a = document.createElement("a");
			document.body.appendChild(a);
			a.style = "display: none";
			return function(data, fileName) {
				const blob = new Blob([data], {type: "octet/stream"}),
				url = window.URL.createObjectURL(blob);
				a.href = url;
				a.download = fileName;
				a.click();
				window.URL.revokeObjectURL(url);
			};
			}());
			
            $.ajax({
                url:"csv_action.php",
                method:"POST",
                data:{checkbox_value:checkbox_value, action:'exportsl_csv'},
				success: function(response) {
					DownloadCsv(response, 'Student List('+d+').csv')
				}
            });
        }
        else
        {
            alert("Please select at least one records");
        }
    });

// Edit 
	$(document).on('click', '.edit_button', function(){

			var s_id = $(this).data('id');

				$('#student_form')[0].reset();

				$('#student_form').parsley().reset();

				$('#form_message').html('');

				$.ajax({

					url:"csv_action.php",

					method:"POST",

					data:{s_id:s_id, action:'student_fetch_single'},

					dataType:'JSON',

					success:function(data)
					{
							$('#ss_id').val(data.ss_id);
							// Personal Details
							$('#sfname').val(data.sfname);
							$('#smname').val(data.smname);
							$('#slname').val(data.slname);
							$('#snext').val(data.snext);
							$('#sdbirth').val(data.sdbirth);
							$('#sgender').val(data.sgender);
							$('#scivilstat').val(data.scivilstat);
							$('#saddress').val(data.saddress);
							$('#scontact').val(data.scontact);
							$('#spschname').val(data.spschname);
							$('#sccourse').val(data.sccourse);
							$('#scsyrlvl').val(data.scsyrlvl);
							// Family Details
							// Guardian Details
							$('#sgfname').val(data.sgfname);
							// Father Details
							$('#sffname').val(data.sffname);
							$('#sfoccu').val(data.sfoccu);
							// Mother Details
							$('#smfname').val(data.smfname);
							$('#smoccu').val(data.smoccu);
							// Scholarship Details
							$('#s_scholarship_type').val(data.s_scholarship_type);
							$('#s_account_status').val(data.s_account_status);

							$('#studentModal').modal('show');

							$('#studentModal_title').text('Edit Student Info');

							$('#student_hidden_id').val(s_id);

							// $('#ss_id').attr('disabled', true);

							$('#student_action').val('edit_student');

							$('#student_submit_button').val('Edit');

					}

				})
		});

// Change Status
	$(document).on('click', '.status_button', function(){
		var id = $(this).data('id');
    	var status = $(this).data('status');
		var next_status = 'Active';
		if(status == 'Active')
		{
			next_status = 'Inactive';
		}
		if(status == 'Inactive'){
			next_status = 'Active';
		}
		if(confirm("Are you sure you want to "+next_status+" it?"))
    	{

      		$.ajax({

        		url:"csv_action.php",

        		method:"POST",

        		data:{id:id, action:'change_status', status:status, next_status:next_status},

        		success:function(data)
        		{

          			$('#message').html(data);

          			dataTable.ajax.reload();

					setTimeout(function() 
                    {
                      location.reload();  //Refresh page
                    }, 5000);

        		}

      		})

    	}
	});
// Delete
	$(document).on('click', '.delete_button', function(){

	var id = $(this).data('id');

	if(confirm("Are you sure you want to remove it?"))
	{

		$.ajax({

			url:"csv_action.php",

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
        var s_id = $(this).data('id');
	// Student View
			$.ajax({

				url:"csv_action.php",

				method:"POST",

				data:{s_id:s_id, action:'student_fetch_single'},

				dataType:'JSON',

				success:function(data)
				{
					var html = '<div class="table-responsive">';
					html += '<table class="table">';
				// Student ID Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Student ID Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Student ID No.</th><td width="60%">'+data.ss_id+'</td></tr>';
				// Personal Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Personal Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.sfname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.smname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.slname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.snext+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date of Birth</th><td width="60%">'+data.sdbirth+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Civil Status</th><td width="60%">'+data.scivilstat+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.saddress+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.scontact+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Gender</th><td width="60%">'+data.sgender+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Previous School Attended</th><td width="60%">'+data.spschname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Current Course</th><td width="60%">'+data.sccourse+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Current Year Level</th><td width="60%">'+data.scsyrlvl+'</td></tr>';
				// Family Details
					// Guardian Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Family Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-left" style="font-size:18px">Guardian Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.sgfname+'</td></tr>';
					// Father Details
					html += '<tr><th width="40%" class="text-left" style="font-size:18px">Father Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.sffname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.sfoccu+'</td></tr>';
					// Mother Details
					html += '<tr><th width="40%" class="text-left" style="font-size:18px">Mother Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.smfname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.smoccu+'</td></tr>';
				// Scholarship Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Scholarship Type</th><td width="60%">'+data.s_scholarship_type+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Account Status</th><td width="60%">'+data.s_account_status+'</td></tr>';
					html += '</table></div>';

					$('#viewstudentModal').modal('show');

					$('#acad_details').html(html);

				}

			})
		

    	});

// Select All
   $('#select_all').on('click', function(){;
	  $(".checkbox").prop('checked', $(this).prop("checked"));
   });
// Active All
	$('#active_all').click(function(){
        var checkbox = $('.checkbox:checked');
		var active_status = 'Active';
        if(checkbox.length > 0)
        {
            var checkbox_value = [];
            $(checkbox).each(function(){
                checkbox_value.push($(this).val());
            });

            $.ajax({
                url:"csv_action.php",
                method:"POST",
                data:{checkbox_value:checkbox_value, active_status:active_status, action:'active_all'},
                success:function(data)
                {

					$("#select_all").prop('checked', false); 
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
// Inactive All
	$('#inactive_all').click(function(){
        var checkbox = $('.checkbox:checked');
		var inactive_status = 'Inactive';
        if(checkbox.length > 0)
        {
            var checkbox_value = [];
            $(checkbox).each(function(){
                checkbox_value.push($(this).val());
            });

            $.ajax({
                url:"csv_action.php",
                method:"POST",
                data:{checkbox_value:checkbox_value, inactive_status:inactive_status, action:'inactive_all'},
                success:function(data)
                {
					$("#select_all").prop('checked', false); 
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
                url:"csv_action.php",
                method:"POST",
                data:{checkbox_value:checkbox_value, action:'delete_all'},
                success:function(data)
                {
					$("#select_all").prop('checked', false); 
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