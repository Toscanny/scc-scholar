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
	<h1 class="h3 mb-4 text-gray-800">Academic Rejected Grantees Management</h1>

	<!-- DataTales Example -->
	<span id="message"></span>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col">
					<h6 class="m-0 font-weight-bold text-primary">Applicant List</h6>
				</div>
				<div class="col" align="center">
					<button type="button" name="add_csv" id="add_csv" class="btn btn-success btn-circle btn-sm"><i class="fas fa-file-excel"></i></button>
					<button type="button" name="add_pdf" id="add_pdf" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-file-pdf"></i></button>
				</div> 
				<div class="col" align="right">
					<button type="button" name="add_acad" id="add_acad" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></button>
					<button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-times"></i></button>
					<button type="button" name="approve_all" id="approve_all" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-thumbs-up"></i></button>
					<button type="button" name="reject_all" id="reject_all" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-thumbs-down"></i></button>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="acad_table" width="100%" cellspacing="0">
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
<div id="acadModal" class="modal fade">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<form method="post" id="acad_form">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal_title">Add Academic Scholar</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<span id="form_message"></span>
					<div class="form-group">
					<div class="card">
					<div class="card-header" style="font-weight: bold; font-size: 18px;">Personal Details</div>
					<div class="card-body">
					<div class="form-group">
							<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>First Name<span class="text-danger">*</span></label>
								<input type="text" name="safname" id="safname" class="form-control" required/>
								<span id="error_safname" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Middle Name<span class="text-danger">*</span></label>
								<input type="text" name="samname" id="samname" class="form-control" placeholder="Put N/A if none" required/>
								<span id="error_samname" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Last Name<span class="text-danger">*</span></label>
								<input type="text" name="salname" id="salname" class="form-control" required/>
								<span id="error_salname" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Select Suffix<span class="text-danger">*</span></label>
								<select name="sanext" id="sanext" class="form-control" required>
								<option value="">-Select-</option>
								<option value="N/A">N/A</option>
								<option value="Jr.">Jr.</option>
								<option value="Sr.">Sr.</option>
								</select>
								<span id="error_sanext" class="text-danger"></span>
							</div>
							<div class="col-xs-10 col-sm-12 col-md-4">
								<label>Date of Birth<span class="text-danger">*</span></label>
								<input type="date" name="sadbirth" id="sadbirth" autocomplete="off" class="form-control" required />
								<span id="error_sadbirth" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<label>Select Gender<span class="text-danger">*</span></label>
								<select name="sagender" id="sagender" class="form-control" required>
								<option value="">Select Gender</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								</select>
								<span id="error_sagender" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<label>Citizenship<span class="text-danger">*</span></label>
								<input type="text" name="sactship" id="sactship" class="form-control" required/>
								<span id="error_sactship" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<label>Address<span class="text-danger">*</span></label>
								<textarea type="text" name="saaddress" id="saaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
								<span id="error_saaddress" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-5">
								<label>Email Address<span class="text-danger">*</span></label>
								<input type="text" name="sapemail" id="sapemail" class="form-control" required/>
								<span id="error_sapemail" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
								<label>Contact Number<span class="text-danger">*</span></label>
								<input type="text" name="sacontact" id="sacontact" class="form-control" required/>
								<span id="error_sacontact" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-5">
								<label>Course<span class="text-danger">*</span></label>
								<input type="text" name="sacourse" id="sacourse" class="form-control" required/>
								<span id="error_sacourse" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
								<label>Grade/Year Level<span class="text-danger">*</span></label>
								<input type="text" name="sagyl" id="sagyl" class="form-control" required/>
								<span id="error_sagyl" class="text-danger"></span>
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
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>First Name<span class="text-danger">*</span></label>
								<input type="text" name="sagfname" id="sagfname" class="form-control" required/>
								<span id="error_sagfname" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Middle Name<span class="text-danger">*</span></label>
								<input type="text" name="sagmname" id="sagmname" class="form-control" placeholder="Put N/A if none" required/>
								<span id="error_sagmname" class="text-danger"></span>
								</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Last Name<span class="text-danger">*</span></label>
								<input type="text" name="saglname" id="saglname" class="form-control" required/>
								<span id="error_saglname" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Select Suffix<span class="text-danger">*</span></label>
								<select name="sagnext" id="sagnext" class="form-control" required>
								<option value="">-Select-</option>
								<option value="N/A">N/A</option>
								<option value="Jr.">Jr.</option>
								<option value="Sr.">Sr.</option>
								</select>
								<span id="error_sagnext" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<label>Address<span class="text-danger">*</span></label>
								<textarea type="text" name="sagaddress" id="sagaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
								<span id="error_sagaddress" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<label>Contact Number<span class="text-danger">*</span></label>
								<input type="text" name="sagcontact" id="sagcontact" class="form-control" required/>
								<span id="error_sagcontact" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<label>Occupation<span class="text-danger">*</span></label>
								<input type="text" name="sagoccu" id="sagoccu" class="form-control" placeholder="Put N/A if none" required/>
								<span id="error_sagoccu" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<label>Company<span class="text-danger">*</span></label>
								<input type="text" name="sagcompany" id="sagcompany" class="form-control" placeholder="Put N/A if none" required/>
								<span id="error_sagcompany" class="text-danger"></span>
							</div>
							</div>
						</div>
						<div class="form-group">
						<h5 class="sub-title" style="font-weight: bold; font-size: 16px;">Father Details</h5>
							<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>First Name<span class="text-danger">*</span></label>
								<input type="text" name="saffname" id="saffname" class="form-control" required/>
								<span id="error_saffname" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Middle Name<span class="text-danger">*</span></label>
								<input type="text" name="safmname" id="safmname" class="form-control" placeholder="Put N/A if none" required/>
								<span id="error_safmname" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Last Name<span class="text-danger">*</span></label>
								<input type="text" name="saflname" id="saflname" class="form-control" required/>
								<span id="error_saflname" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Select Suffix<span class="text-danger">*</span></label>
								<select name="safnext" id="safnext" class="form-control" required>
								<option value="">-Select-</option>
								<option value="N/A">N/A</option>
								<option value="Jr.">Jr.</option>
								<option value="Sr.">Sr.</option>
								</select>
								<span id="error_safnext" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<label>Address<span class="text-danger">*</span></label>
								<textarea type="text" name="safaddress" id="safaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
								<span id="error_safaddress" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<label>Contact Number<span class="text-danger">*</span></label>
								<input type="text" name="safcontact" id="safcontact" class="form-control" required/>
								<span id="error_safcontact" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<label>Occupation<span class="text-danger">*</span></label>
								<input type="text" name="safoccu" id="safoccu" class="form-control" placeholder="Put N/A if none" required/>
								<span id="error_safoccu" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<label>Company<span class="text-danger">*</span></label>
								<input type="text" name="safcompany" id="safcompany" class="form-control" placeholder="Put N/A if none" required/>
								<span id="error_safcompany" class="text-danger"></span>
							</div>
						</div>
						</div>
						<div class="form-group">
						<h5 class="sub-title" style="font-weight: bold; font-size: 16px;">Mother Details</h5>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>First Name<span class="text-danger">*</span></label>
								<input type="text" name="samfname" id="samfname" class="form-control" required/>
								<span id="error_samfname" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Middle Name<span class="text-danger">*</span></label>
								<input type="text" name="sammname" id="sammname" class="form-control" placeholder="Put N/A if none" required/>
								<span id="error_sammname" class="text-danger"></span>
								</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Last Name<span class="text-danger">*</span></label>
								<input type="text" name="samlname" id="samlname" class="form-control" required/>
								<span id="error_samlname" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3">
								<label>Select Suffix<span class="text-danger">*</span></label>
								<select name="samnext" id="samnext" class="form-control" required>
								<option value="">-Select-</option>
								<option value="N/A">N/A</option>
								<option value="Jr.">Jr.</option>
								<option value="Sr.">Sr.</option>
								</select>
								<span id="error_samnext" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<label>Address<span class="text-danger">*</span></label>
								<textarea type="text" name="samaddress" id="samaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
								<span id="error_samaddress" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<label>Contact Number<span class="text-danger">*</span></label>
								<input type="text" name="samcontact" id="samcontact" class="form-control" required/>
								<span id="error_samcontact" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<label>Occupation<span class="text-danger">*</span></label>
								<input type="text" name="samoccu" id="samoccu" class="form-control" placeholder="Put N/A if none" required/>
								<span id="error_samoccu" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4">
								<label>Company<span class="text-danger">*</span></label>
								<input type="text" name="samcompany" id="samcompany" class="form-control" placeholder="Put N/A if none" required/>
								<span id="error_samcompany" class="text-danger"></span>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
								<label>Parents Combine Yearly Income<span class="text-danger">*</span></label>
								<input type="text" name="saspcyincome" id="saspcyincome" class="form-control" required/>
								<span id="error_saspcyincome" class="text-danger"></span>
							</div>
						</div>
						</div>
					</div>
					</div>
					</div>
					<div class="form-group">
						<div class="card">
						<div class="card-header" style="font-weight: bold; font-size: 18px;">Achievement Details</div>
							<div class="card-body">
							<div class="form-group">
							<label>Grade/GWA<span class="text-danger">*</span></label>
							<input type="text" name="sagwa" id="sagwa" class="form-control" required/>
							<span id="error_sagwa" class="text-danger"></span>
							</div>
							<div class="form-group">
							<label>Award Received<span class="text-danger">*</span></label>
							<textarea name="saraward" id="saraward" class="form-control" required></textarea>
							<span id="error_saraward" class="text-danger" required></span>
							</div>
							<div class="form-group">
							<label>Date Received<span class="text-danger">*</span></label>
								<input type="date" name="sadawardrceive" id="sadawardrceive" class="form-control" autocomplete="off" required>
								<span id="error_sadawardrceive" class="text-danger"></span>
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
										<label>Date Receive Report Card<span class="text-danger">*</span></label>
										<input type="date" name="sadsprc" id="sadsprc" autocomplete="off" class="form-control" />
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4">
										<label>Date Receive Good Moral<span class="text-danger">*</span></label>
										<input type="date" name="sadspgm" id="sadspgm" autocomplete="off" class="form-control" />
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4">
										<label>Date Receive Cert. of Recog.<span class="text-danger">*</span></label>
										<input type="date" name="sadspcr" id="sadspcr" autocomplete="off" class="form-control" />
									</div>
								</div>
								<div class="row g-3">
									<div class="col-xs-12 col-sm-12 col-md-4">
										<label>Select Report Card Status<span class="text-danger">*</span></label>
										<select name="sadsprcstat" id="sadsprcstat" class="form-control" required>
										<option value="">-Select-</option>
										<option value="Received">Received</option>
										<option value="Not-Received">Not-Received</option>
										</select>
										<span id="error_sadsprcstat" class="text-danger"></span>
									</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
										<label>Select Good Moral Status<span class="text-danger">*</span></label>
										<select name="sadspgmstat" id="sadspgmstat" class="form-control" required>
										<option value="">-Select-</option>
										<option value="Received">Received</option>
										<option value="Not-Received">Not-Received</option>
										</select>
										<span id="error_sadspgmstat" class="text-danger"></span>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-4">
										<label>Select Cert. of Recog. Status<span class="text-danger">*</span></label>
										<select name="sadspcrstat" id="sadspcrstat" class="form-control" required>
										<option value="">-Select-</option>
										<option value="Received">Received</option>
										<option value="Not-Received">Not-Received</option>
										</select>
										<span id="error_sadspcrstat" class="text-danger"></span>
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
								<input type="text" name="saaemail" id="saaemail" class="form-control" required/>
								<span id="error_saaemail" class="text-danger"></span>
								</div>
								<div class="form-group">
								<label>Password<span class="text-danger">*</span></label>
								<input type="password" name="sapass" id="sapass" class="form-control" required/>
								<span id="error_sapass" class="text-danger"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="card">
						<div class="card-header" style="font-weight: bold; font-size: 18px;">Scholarship Details</div>
							<div class="card-body">
								<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
									<label>Select Grant Status</label>
									<select name="sagrantstat" id="sagrantstat" class="form-control" required>
									<option value="">-Select-</option>
									<option value="New">New</option>
									<option value="Old">Old</option>
									</select>
									<span id="error_sagrantstat" class="text-danger"></span>
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
			<div class="modal-body" id="acad_details">
				
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
						<form method="post" id="upload_form" enctype="multipart/form-data">
							<div class="col-md-6">
								<input type="file" name="file" id="csv_file" />
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input type="hidden" name="action" id="action" value="Upload" />
					<input type="submit" name="upload_file" id="upload_file" class="btn btn-success" value="Upload" />
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div id="csvIMPModal" class="modal fade">
	<div class="modal-dialog modal-lg">
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
var dataTable = $('#acad_table').DataTable({
	"processing" : true,
	"serverSide" : true,
	"order" : [],
	"ajax" : {
		url:"acadreject_action.php",
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

// Add
$('#add_acad').click(function(){

	$('#acad_form')[0].reset();

	$('#acad_form').parsley().reset();

	$('#modal_title').text('Add Academic Scholar');

	$('#action').val('Add');

	$('#submit_button').val('Add');

	$('#acadModal').modal('show');

	$('#form_message').html('');

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
				url:"upload.php",
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

	var first_name = 0;

	var last_name = 0;

	var email = 0;

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

	if(column_name != '')
	{
	column_data[column_name] = column_number;
	}
	else
	{
	const entries = Object.entries(column_data);

	for(const [key, value] of entries)
	{
		if(value == column_number)
		{
		delete column_data[key];
		}
	}
	}

	total_selection = Object.keys(column_data).length;

	if(total_selection == 3)
	{
	$('#import').attr('disabled', false);

	first_name = column_data.first_name;

	last_name = column_data.last_name;

	email = column_data.email;
	}
	else
	{
	$('#import').attr('disabled', 'disabled');
	}

	});
// Import
$(document).on('click', '.import', function(event){
							
	event.preventDefault();	
	
	$('#import.php')[0].reset();

	$('#upload_form').parsley().reset();
		$.ajax({
		url:"acadreject_action.php",
		method:"POST",
		data:{safname:safname, salname:salname, sapemail:sapemail},
		beforeSend:function(){
			$('.import').attr('disabled', 'disabled');
			$('.import').text('Importing...');
		},
		success:function(data)
		{
			$('#csvUPModal').modal('hide');
			$('#message').html(data.success);
			dataTable.ajax.reload();
			setTimeout(function(){
				$('#message').html('');
			}, 5000);
		}
		})
	});	
// Submit
$('#acad_form').parsley();

$('#acad_form').on('submit', function(event){
	event.preventDefault();
	if($('#acad_form').parsley().isValid())
	{		
		$.ajax({
			url:"acadreject_action.php",
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
					$('#acadModal').modal('hide');
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

	var sacad_id = $(this).data('id');

	$('#acad_form')[0].reset();

	$('#acad_form').parsley().reset();

	$('#form_message').html('');

	$.ajax({

		  url:"acadreject_action.php",

		  method:"POST",

		  data:{sacad_id:sacad_id, action:'fetch_single'},

		  dataType:'JSON',

		  success:function(data)
		  {
			// Account Details
			$('#saaemail').val(data.saaemail);
			$('#sapass').val(data.sapass);
			// Personal Details
			$('#safname').val(data.safname);
			$('#samname').val(data.samname);
			$('#salname').val(data.salname);
			$('#sanext').val(data.sanext);
			$('#sadbirth').val(data.sadbirth);
			$('#sactship').val(data.sactship);
			$('#saaddress').val(data.saaddress);
			$('#sapemail').val(data.sapemail);
			$('#sacontact').val(data.sacontact);
			$('#sacourse').val(data.sacourse);
			$('#sagyl').val(data.sagyl);
			$('#sagender').val(data.sagender);
			// Family Details
			// Guardian Details
			$('#sagfname').val(data.sagfname);
			$('#sagmname').val(data.sagmname);
			$('#saglname').val(data.saglname);
			$('#sagnext').val(data.sagnext);
			$('#sagnext').val(data.sagnext);
			$('#sagaddress').val(data.sagaddress);
			$('#sagcontact').val(data.sagcontact);
			$('#sagoccu').val(data.sagoccu);
			$('#sagcompany').val(data.sagcompany);
			// Father Details
			$('#saffname').val(data.saffname);
			$('#safmname').val(data.safmname);
			$('#saflname').val(data.saflname);
			$('#safnext').val(data.safnext);
			$('#safaddress').val(data.safaddress);
			$('#safcontact').val(data.safcontact);
			$('#safoccu').val(data.safoccu);
			$('#safcompany').val(data.safcompany);
			// Mother Details
			$('#samfname').val(data.samfname);
			$('#sammname').val(data.sammname);
			$('#samlname').val(data.samlname);
			$('#samnext').val(data.samnext);
			$('#samaddress').val(data.samaddress);
			$('#samcontact').val(data.samcontact);
			$('#samoccu').val(data.samoccu);
			$('#samcompany').val(data.samcompany);
			$('#saspcyincome').val(data.saspcyincome);
			// Achievement Details
			$('#sagwa').val(data.sagwa);
			$('#saraward').val(data.saraward);
			$('#sadawardrceive').val(data.sadawardrceive);
			// Requirement Details
			$('#sadsprc').val(data.sadsprc);
			$('#sadsprcstat').val(data.sadsprcstat);
			$('#sadspgm').val(data.sadspgm);
			$('#sadspgmstat').val(data.sadspgmstat);
			$('#sadspcr').val(data.sadspcr);
			$('#sadspcrstat').val(data.sadspcrstat);
			// Scholarship Details
			$('#sagrantstat').val(data.sagrantstat);

			$('#modal_title').text('Edit Applicant Info');

			$('#action').val('Edit');

			$('#submit_button').val('Edit');

			$('#acadModal').modal('show');

			$('#hidden_id').val(sacad_id);

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

			url:"acadreject_action.php",

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
// Delete
$(document).on('click', '.delete_button', function(){

var id = $(this).data('id');

if(confirm("Are you sure you want to remove it?"))
{

	$.ajax({

		url:"acadreject_action.php",

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
	var sacad_id = $(this).data('id');

	$.ajax({

		url:"acadreject_action.php",

		method:"POST",

		data:{sacad_id:sacad_id, action:'fetch_single'},

		dataType:'JSON',

		success:function(data)
		{
			var html = '<div class="table-responsive">';
			html += '<table class="table">';
		// Account Details
			html += '<tr><th width="40%" class="text-right" style="font-size:20px">Account Details</th><td width="60%"></td></tr>';
			html += '<tr><th width="40%" class="text-right">Email Address</th><td width="60%">'+data.saaemail+'</td></tr>';
		// Personal Details
			html += '<tr><th width="40%" class="text-left" style="font-size:20px">Personal Details</th><td width="60%"></td></tr>';
			html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.safname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.samname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.salname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.sanext+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Date of Birth</th><td width="60%">'+data.sadbirth+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Citizenship</th><td width="60%">'+data.sactship+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.saaddress+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Email Address</th><td width="60%">'+data.sapemail+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.sacontact+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Gender</th><td width="60%">'+data.sagender+'</td></tr>';
		// Family Details
			// Guardian Details
			html += '<tr><th width="40%" class="text-left" style="font-size:20px">Family Details</th><td width="60%"></td></tr>';
			html += '<tr><th width="40%" class="text-left" style="font-size:18px">Guardian Details</th><td width="60%"></td></tr>';
			html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.sagfname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.sagmname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.saglname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.sagnext+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.sagaddress+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.sagcontact+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.sagoccu+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.sagcompany+'</td></tr>';
			// Father Details
			html += '<tr><th width="40%" class="text-left" style="font-size:18px">Father Details</th><td width="60%"></td></tr>';
			html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.saffname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.safmname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.saflname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.safnext+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.safaddress+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.safcontact+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.safoccu+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.safcompany+'</td></tr>';
			// Mother Details
			html += '<tr><th width="40%" class="text-left" style="font-size:18px">Mother Details</th><td width="60%"></td></tr>';
			html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.samfname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.sammname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.samlname+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.samnext+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.samaddress+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.samcontact+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.samoccu+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.samcompany+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Parents Combine Yearly Income</th><td width="60%">'+data.saspcyincome+'</td></tr>';
		// Achievement Details
			html += '<tr><th width="40%" class="text-left" style="font-size:20px">Achievement Details</th><td width="60%"></td></tr>';
			html += '<tr><th width="40%" class="text-right">Grade/GWA</th><td width="60%">'+data.sagwa+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Award Received</th><td width="60%">'+data.saraward+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Date Received</th><td width="60%">'+data.sadawardrceive+'</td></tr>';
		// Requirement Details
			html += '<tr><th width="40%" class="text-left" style="font-size:20px">Requirement Details</th><td width="60%"></td></tr>';
			html += '<tr><th width="40%" class="text-right">Date Receive Report Card</th><td width="60%">'+data.sadsprc+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Report Card Status</th><td width="60%">'+data.sadsprcstat+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Date Receive Good Moral</th><td width="60%">'+data.sadspgm+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Good Moral Status</th><td width="60%">'+data.sadspgmstat+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Date Receive Certificate of Recognition</th><td width="60%">'+data.sadspcr+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Certificate of Recognition Status</th><td width="60%">'+data.sadspcrstat+'</td></tr>';
		// Scholarship Details
			html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Details</th><td width="60%"></td></tr>';
			html += '<tr><th width="40%" class="text-right">Scholarship Type</th><td width="60%">'+data.sacapstype+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Grant Status</th><td width="60%">'+data.sagrantstat+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Scholarship Status</th><td width="60%">'+data.sascholarstat+'</td></tr>';
			html += '<tr><th width="40%" class="text-right">Date Applied</th><td width="60%">'+data.sadapply+'</td></tr>';
			html += '</table></div>';

			$('#viewModal').modal('show');

			$('#acad_details').html(html);

		}

	})
});
// Select All
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
// Approve All
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
			url:"acadreject_action.php",
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
// Reject All
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
			url:"acadreject_action.php",
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
			url:"acadreject_action.php",
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