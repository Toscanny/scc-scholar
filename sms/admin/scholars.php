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

	// $object->query = "
    // SELECT DISTINCT s_scholarship_type FROM tbl_student 
	// ORDER BY s_scholarship_type ASC
    // ";

	// $result = $object->get_result();

	include('header.php');

	?>
<!-- Table -->
		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Scholars Management</h1>

		<!-- DataTales Example -->
		<span id="message"></span>
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<div class="row">
					<div class="col">
						<h6 class="m-0 font-weight-bold text-primary">Scholars List</h6>
					</div>
					<div class="col" align="center">
						<div class="dropdown">
						<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success btn-circle btn-sm"><i class="fas fa-file-excel"></i></button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
								<button class="dropdown-item" type="button" name="add_csv" id="add_csv">Import CSV</button>
								<button class="dropdown-item" type="button" name="export_csv" id="export_csv">Export CSV</button>
							</div>
							<!-- <button type="button" name="add_pdf" id="add_pdf" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-file-pdf"></i></button> -->
							<button type="button" name="bulk_email" id="bulk_email" class="btn btn-info btn-circle btn-sm"><i class="fas fa-envelope"></i></button>
							<button type="button" name="bulk_sms" id="bulk_sms" class="btn btn-info btn-circle btn-sm"><i class="fas fa-sms"></i></button>
						</div>
					</div>
					<div class="col" align="right">
						<div class="dropdown">
						<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
							<button class="dropdown-item" type="button" name="add_acad" id="add_acad">Academic</button>
							<button class="dropdown-item" type="button" name="add_nonacad" id="add_nonacad">Non-Academic</button>
							<button class="dropdown-item" type="button" name="add_unifast" id="add_unifast">UNIFAST</button>
							<button class="dropdown-item" type="button" name="add_ched" id="add_ched">CHED</button>
						</div>
						<button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-times"></i></button>
						<button type="button" name="approve_all" id="approve_all" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-thumbs-up"></i></button>
						<button type="button" name="reject_all" id="reject_all" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-thumbs-down"></i></button>
						<button type="button" name="renewal_all" id="renewal_all" class="btn btn-secondary btn-circle btn-sm"><i class="fas fa-undo"></i></button>
						</div>
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
								<th>Current Course</th>
								<th>Current Year Level</th>
								<th>Contact No.</th>
								<th>Email</th>
								<th>Status</th>
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
<!-- Add Acad Modal -->
	<div id="acadModal" class="modal fade">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<form method="post" id="acad_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="acadmodal_title">Add Academic Scholar</h4>
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
									<input type="text" name="ss_id" id="ss_id" class="form-control" required />
									<span id="error_ss_id" class="text-danger"></span>
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
								<div class="col-xs-10 col-sm-12 col-md-4">
									<label>Date of Birth<span class="text-danger">*</span></label>
									<input type="date" name="sdbirth" id="sdbirth" autocomplete="off" class="form-control" required />
									<span id="error_sdbirth" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Select Gender<span class="text-danger">*</span></label>
									<select name="sgender" id="sgender" class="form-control" required>
									<option value="">Select Gender</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
									</select>
									<span id="error_sgender" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Citizenship<span class="text-danger">*</span></label>
									<input type="text" name="sctship" id="sctship" class="form-control" required/>
									<span id="error_sctship" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<label>Address<span class="text-danger">*</span></label>
									<textarea type="text" name="saddress" id="saddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
									<span id="error_saddress" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-5">
									<label>Email Address<span class="text-danger">*</span></label>
									<input type="text" name="semail" id="semail" class="form-control" required/>
									<span id="error_semail" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
									<label>Contact Number<span class="text-danger">*</span></label>
									<input type="text" name="scontact" id="scontact" class="form-control" required/>
									<span id="error_scontact" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-5">
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
								<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
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
								<div class="col-xs-12 col-sm-12 col-md-12">
									<label>Address<span class="text-danger">*</span></label>
									<textarea type="text" name="sgaddress" id="sgaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
									<span id="error_sgaddress" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Contact Number<span class="text-danger">*</span></label>
									<input type="text" name="sgcontact" id="sgcontact" class="form-control" required/>
									<span id="error_sgcontact" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Occupation<span class="text-danger">*</span></label>
									<input type="text" name="sgoccu" id="sgoccu" class="form-control" placeholder="Put N/A if none" required/>
									<span id="error_sgoccu" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Company<span class="text-danger">*</span></label>
									<input type="text" name="sgcompany" id="sgcompany" class="form-control" placeholder="Put N/A if none" required/>
									<span id="error_sgcompany" class="text-danger"></span>
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
									<label>Address<span class="text-danger">*</span></label>
									<textarea type="text" name="sfaddress" id="sfaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
									<span id="error_sfaddress" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Contact Number<span class="text-danger">*</span></label>
									<input type="text" name="sfcontact" id="sfcontact" class="form-control" required/>
									<span id="error_sfcontact" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Occupation<span class="text-danger">*</span></label>
									<input type="text" name="sfoccu" id="sfoccu" class="form-control" placeholder="Put N/A if none" required/>
									<span id="error_sfoccu" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Company<span class="text-danger">*</span></label>
									<input type="text" name="sfcompany" id="sfcompany" class="form-control" placeholder="Put N/A if none" required/>
									<span id="error_sfcompany" class="text-danger"></span>
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
									<label>Address<span class="text-danger">*</span></label>
									<textarea type="text" name="smaddress" id="smaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
									<span id="error_smaddress" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Contact Number<span class="text-danger">*</span></label>
									<input type="text" name="smcontact" id="smcontact" class="form-control" required/>
									<span id="error_smcontact" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Occupation<span class="text-danger">*</span></label>
									<input type="text" name="smoccu" id="smoccu" class="form-control" placeholder="Put N/A if none" required/>
									<span id="error_smoccu" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4">
									<label>Company<span class="text-danger">*</span></label>
									<input type="text" name="smcompany" id="smcompany" class="form-control" placeholder="Put N/A if none" required/>
									<span id="error_smcompany" class="text-danger"></span>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
									<label>Parents Combine Yearly Income<span class="text-danger">*</span></label>
									<input type="text" name="spcyincome" id="spcyincome" class="form-control" required/>
									<span id="error_spcyincome" class="text-danger"></span>
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
								<input type="text" name="spsgwa" id="spsgwa" class="form-control" required/>
								<span id="error_spsgwa" class="text-danger"></span>
								</div>
								<div class="form-group">
								<label>Award Received<span class="text-danger">*</span></label>
								<textarea name="spsraward" id="spsraward" class="form-control" required></textarea>
								<span id="error_spsraward" class="text-danger" required></span>
								</div>
								<div class="form-group">
								<label>Date Received<span class="text-danger">*</span></label>
									<input type="date" name="spsdawardrceive" id="spsdawardrceive" class="form-control" autocomplete="off" required>
									<span id="error_spsdawardrceive" class="text-danger"></span>
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
											<input type="date" name="sdsprc" id="sdsprc" autocomplete="off" class="form-control" />
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label>Date Receive Good Moral<span class="text-danger">*</span></label>
											<input type="date" name="sdspgm" id="sdspgm" autocomplete="off" class="form-control" />
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label>Date Receive Cert. of Recog.<span class="text-danger">*</span></label>
											<input type="date" name="sdspcr" id="sdspcr" autocomplete="off" class="form-control" />
										</div>
									</div>
									<div class="row g-3">
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label>Select Report Card Status<span class="text-danger">*</span></label>
											<select name="sdsprcstat" id="sdsprcstat" class="form-control" required>
											<option value="">-Select-</option>
											<option value="Received">Received</option>
											<option value="Not-Received">Not-Received</option>
											</select>
											<span id="error_sdsprcstat" class="text-danger"></span>
										</div>
											<div class="col-xs-12 col-sm-12 col-md-4">
											<label>Select Good Moral Status<span class="text-danger">*</span></label>
											<select name="sdspgmstat" id="sdspgmstat" class="form-control" required>
											<option value="">-Select-</option>
											<option value="Received">Received</option>
											<option value="Not-Received">Not-Received</option>
											</select>
											<span id="error_sdspgmstat" class="text-danger"></span>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label>Select Cert. of Recog. Status<span class="text-danger">*</span></label>
											<select name="sdspcrstat" id="sdspcrstat" class="form-control" required>
											<option value="">-Select-</option>
											<option value="Received">Received</option>
											<option value="Not-Received">Not-Received</option>
											</select>
											<span id="error_sdspcrstat" class="text-danger"></span>
										</div>
									</div>
								</div> 
							</div>
							</div>
						</div>
						<div class="form-group">
							<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">Scholars Note</div>
								<div class="card-body">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<label>Note:</label>
										<textarea type="text" name="s_scholarship_note" id="s_scholarship_note" placeholder="Put N/A if None" class="form-control" required data-parsley-trigger="keyup"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">Scholarship Details</div>
								<div class="card-body">
									<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
										<label>Scholarship Status<span class="text-danger">*</span></label>
										<select name="s_scholar_stat" id="s_scholar_stat" class="form-control" required>
										<option value="">-Select-</option>
										<option value="Pending">Pending</option>
										<option value="Approved">Approved</option>
										<option value="Rejected">Rejected</option>
										<option value="Renewal">Renewal</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="acad_hidden_id" id="acad_hidden_id" />
						<input type="hidden" name="action" id="acad_action" value="add_acad" />
						<input type="submit" name="submit" id="acad_submit_button" class="btn btn-success" value="Add" />
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<!-- Add Non-Acad Modal -->
	<div id="nonacadModal" class="modal fade">
			<div class="modal-dialog modal-lg modal-dialog-scrollable">
				<form method="post" id="nonacad_form">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="nonacadmodal-title" id="nonacadmodal-title">Add Non-Academic Scholar</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<span id="nonacadform_message"></span>
							<div class="form-group">
								<div class="card">
									<div class="card-header" style="font-weight: bold; font-size: 18px;">Student ID Details</div>
									<div class="card-body">
										<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
											<label>Student ID NO.<span class="text-danger">*</span></label>
											<input type="text" name="sns_id" id="sns_id" class="form-control" required/>
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
													<input type="text" name="snfname" id="snfname" class="form-control" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-3">
													<label>Middle Name<span class="text-danger">*</span></label>
													<input type="text" name="snmname" id="snmname" class="form-control" placeholder="Put N/A if none" required/>
													</div>
													<div class="col-xs-12 col-sm-12 col-md-3">
													<label>Last Name<span class="text-danger">*</span></label>
													<input type="text" name="snlname" id="snlname" class="form-control" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-3">
													<label>Select Suffix<span class="text-danger">*</span></label>
													<select name="snnext" id="snnext" class="form-control" required>
													<option value="">-Select-</option>
													<option value="N/A">N/A</option>
													<option value="Jr.">Jr.</option>
													<option value="Sr.">Sr.</option>
													</select>
												</div>
												<div class="col-xs-10 col-sm-12 col-md-4">
													<label>Date of Birth<span class="text-danger">*</span></label>
													<input type="date" name="sndbirth" id="sndbirth" autocomplete="off" class="form-control" required>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Select Gender<span class="text-danger">*</span></label>
													<select name="sngender" id="sngender" class="form-control" required>
													<option value="">Select Gender</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
													</select>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Citizenship<span class="text-danger">*</span></label>
													<input type="text" name="snctship" id="snctship" class="form-control" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Address<span class="text-danger">*</span></label>
													<textarea type="text" name="snaddress" id="snaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-5">
													<label>Email Address<span class="text-danger">*</span></label>
													<input type="text" name="snemail" id="snemail" class="form-control" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
													<label>Contact Number<span class="text-danger">*</span></label>
													<input type="text" name="sncontact" id="sncontact" class="form-control" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-5">
													<label>Student Course<span class="text-danger">*</span></label>
													<select name="snccourse" id="snccourse" class="form-control" required>
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
												<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
													<label>Student Year Level<span class="text-danger">*</span></label>
													<select name="sncsyrlvl" id="sncsyrlvl" class="form-control" required>
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
											<h4 class="sub-title" style="font-weight: bold; font-size: 16px;">Guardian Details</h4>
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Full Name<span class="text-danger">*</span></label>
													<input type="text" name="sngfname" id="sngfname" class="form-control" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Address<span class="text-danger">*</span></label>
													<textarea type="text" name="sngaddress" id="sngaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Contact Number<span class="text-danger">*</span></label>
													<input type="text" name="sngcontact" id="sngcontact" class="form-control" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Occupation<span class="text-danger">*</span></label>
													<input type="text" name="sngoccu" id="sngoccu" class="form-control" placeholder="Put N/A if none" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Company<span class="text-danger">*</span></label>
													<input type="text" name="sngcompany" id="sngcompany" class="form-control" placeholder="Put N/A if none" required/>
												</div>
											</div>
										</div>
										<div class="form-group">
											<h4 class="sub-title" style="font-weight: bold; font-size: 16px;">Father Details</h4>
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Full Name<span class="text-danger">*</span></label>
													<input type="text" name="snffname" id="snffname" class="form-control" required/>
													<span id="error_sffname" class="text-danger"></span>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Address<span class="text-danger">*</span></label>
													<textarea type="text" name="snfaddress" id="snfaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Contact Number<span class="text-danger">*</span></label>
													<input type="text" name="snfcontact" id="snfcontact" class="form-control" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Occupation<span class="text-danger">*</span></label>
													<input type="text" name="snfoccu" id="snfoccu" class="form-control" placeholder="Put N/A if none" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Company<span class="text-danger">*</span></label>
													<input type="text" name="snfcompany" id="snfcompany" class="form-control" placeholder="Put N/A if none" required/>
												</div>
											</div>
										</div>
										<div class="form-group">
											<h4 class="sub-title" style="font-weight: bold; font-size: 16px;">Mother Details</h4>
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Full Name<span class="text-danger">*</span></label>
													<input type="text" name="snmfname" id="snmfname" class="form-control" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Address<span class="text-danger">*</span></label>
													<textarea type="text" name="snmaddress" id="snmaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Contact Number<span class="text-danger">*</span></label>
													<input type="text" name="snmcontact" id="snmcontact" class="form-control" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Occupation<span class="text-danger">*</span></label>
													<input type="text" name="snmoccu" id="snmoccu" class="form-control" placeholder="Put N/A if none" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Company<span class="text-danger">*</span></label>
													<input type="text" name="snmcompany" id="snmcompany" class="form-control" placeholder="Put N/A if none" required/>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
													<label>Parents Combine Yearly Income<span class="text-danger">*</span></label>
													<input type="text" name="snpcyincome" id="snpcyincome" class="form-control" required/>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="card">
								<div class="card-header" style="font-weight: bold; font-size: 18px;">Application Details</div>
									<div class="card-body">
										<div class="form-group">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Reasons/Special Circumstances for Applying NAS<span class="text-danger">*</span></label>
													<textarea type="text" name="snrappnas" id="snrappnas" class="form-control" required data-parsley-trigger="keyup"></textarea>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Basic Office Skills<span class="text-danger">*</span></label>
													<textarea type="text" name="snbos" id="snbos" class="form-control" required data-parsley-trigger="keyup"></textarea>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Special Skills<span class="text-danger">*</span></label>
													<textarea type="text" name="snsskills" id="snsskills" class="form-control" required data-parsley-trigger="keyup"></textarea>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Type of Work Interested In<span class="text-danger">*</span></label>
													<textarea type="text" name="sntwinterest" id="sntwinterest" class="form-control" required data-parsley-trigger="keyup"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="card">
								<div class="card-header" style="font-weight: bold; font-size: 18px;">Education Details</div>
									<div class="card-body">
										<div class="form-group">
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Previous School Attended<span class="text-danger">*</span></label>
													<textarea type="text" name="snpschname" id="snpschname" class="form-control" required data-parsley-trigger="keyup"></textarea>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>School Address<span class="text-danger">*</span></label>
													<textarea type="text" name="snpsaddress" id="snpsaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-12">
													<label>Year/Grade Level<span class="text-danger">*</span></label>
													<input type="text" name="snpsyrlvl" id="snpsyrlvl" class="form-control" required/>
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
													<label>Date Recv. Report Card<span class="text-danger">*</span></label>
													<input type="date" name="sndsprc" id="sndsprc" autocomplete="off" class="form-control" />
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Date Recv. Good Moral<span class="text-danger">*</span></label>
													<input type="date" name="sndspgm" id="sndspgm" autocomplete="off" class="form-control" />
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Date Recv. 2x2 ID Picture<span class="text-danger">*</span></label>
													<input type="date" name="sndstbytpic" id="sndstbytpic" autocomplete="off" class="form-control" />
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Select Report Card Status<span class="text-danger">*</span></label>
													<select name="sndsprcstat" id="sndsprcstat" class="form-control" required>
													<option value="">-Select-</option>
													<option value="Received">Received</option>
													<option value="Not-Received">Not-Received</option>
													</select>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Select Good Moral Status<span class="text-danger">*</span></label>
													<select name="sndspgmstat" id="sndspgmstat" class="form-control" required>
													<option value="">-Select-</option>
													<option value="Received">Received</option>
													<option value="Not-Received">Not-Received</option>
													</select>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Select 2x2 ID Pic. Status<span class="text-danger">*</span></label>
													<select name="sndstbytpicstat" id="sndstbytpicstat" class="form-control" required>
													<option value="">-Select-</option>
													<option value="Received">Received</option>
													<option value="Not-Received">Not-Received</option>
													</select>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Date Recv. Brgy. Indigency<span class="text-danger">*</span></label>
													<input type="date" name="sndsbrgyin" id="sndsbrgyin" autocomplete="off" class="form-control" />
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
													<label>Date Recv. Enrollment Form<span class="text-danger">*</span></label>
													<input type="date" name="sndscef" id="sndscef" autocomplete="off" class="form-control" />
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4">
													<label>Select Brgy. Indigency Status<span class="text-danger">*</span></label>
													<select name="sndsbrgyinstat" id="sndsbrgyinstat" class="form-control" required>
													<option value="">-Select-</option>
													<option value="Received">Received</option>
													<option value="Not-Received">Not-Received</option>
													</select>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
													<label>Select ENRL Form Status<span class="text-danger">*</span></label>
													<select name="sndscefstat" id="sndscefstat" class="form-control" required>
													<option value="">-Select-</option>
													<option value="Received">Received</option>
													<option value="Not-Received">Not-Received</option>
													</select>
												</div>
											</div>
										</div> 
									</div>
								</div>
							</div>
							<div class="form-group">
							<div class="card">
								<div class="card-header" style="font-weight: bold; font-size: 18px;">Scholars Note</div>
									<div class="card-body">
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>Note:</label>
											<textarea type="text" name="sn_scholarship_note" id="sn_scholarship_note" placeholder="Put N/A if None" class="form-control" required data-parsley-trigger="keyup"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="card">
								<div class="card-header" style="font-weight: bold; font-size: 18px;">Scholarship Details</div>
									<div class="card-body">
										<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
											<label>Scholarship Status<span class="text-danger">*</span></label>
											<select name="sn_scholar_stat" id="sn_scholar_stat" class="form-control" required>
											<option value="">-Select-</option>
											<option value="Pending">Pending</option>
											<option value="Approved">Approved</option>
											<option value="Rejected">Rejected</option>
											<option value="Renewal">Renewal</option>
											</select>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="nonacad_hidden_id" id="nonacad_hidden_id" />
						<input type="hidden" name="action" id="nonacad_action" value="add_nonacad" />
						<input type="submit" name="submit" id="nonacad_submit_button" class="btn btn-success" value="Add" />
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
					</div>
				</form>
			</div>
		</div>
<!-- Add UNIFAST Modal -->
	<div id="unifastModal" class="modal fade">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form method="post" id="unifast_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_title">Add Unifast Scholar</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <span id="unifastform_message"></span>
                        <div class="form-group">
                        <div class="card">
                        <div class="card-header" style="font-weight: bold; font-size: 18px;">Student ID Details</div>
                        <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                                    <label>Student ID NO.<span class="text-danger">*</span></label>
                                    <input type="text" name="sus_id" id="sus_id" class="form-control" required/>
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
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label>Given Name<span class="text-danger">*</span></label>
                                    <input type="text" name="susfname" id="susfname" class="form-control" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label>Middle Name<span class="text-danger">*</span></label>
                                    <input type="text" name="susmname" id="susmname" class="form-control" placeholder="Put N/A if none" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label>Select Suffix<span class="text-danger">*</label>
                                    <select name="susnext" id="susnext" class="form-control" required>
                                    <option value="">-Select-</option>
                                    <option value="N/A">N/A</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-5">
                                <label>Gender<span class="text-danger">*</label>
                                    <select name="susgender" id="susgender" class="form-control" required>
                                    <option value="">-Select-</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
                                    <label>Date of Birth<span class="text-danger">*</label>
                                    <input type="date" name="susdbirth" id="susdbirth" autocomplete="off" class="form-control" required>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-5">
                                    <label>Contact No.<span class="text-danger">*</span></label>
                                    <input type="text" name="suscontact" id="suscontact" class="form-control" required/>
                                </div>
								<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
                                	<label>Email Address<span class="text-danger">*</span></label>
                                    <input type="text" name="susemail" id="susemail" class="form-control" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label>Permanent Home Address<span class="text-danger">*</span></label>
                                    <textarea type="text" name="susaddress" id="susaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label>Previous School Attended<span class="text-danger">*</span></label>
                                    <textarea type="text" name="suspschname" id="suspschname" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-5">
                                	<label>Course/Program<span class="text-danger">*</span></label>
                                    <input type="text" name="suspscourse" id="suspscourse" class="form-control" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
                                	<label>Year Level<span class="text-danger">*</span></label>
                                    <input type="text" name="suspsyrlvl" id="suspsyrlvl" class="form-control" required/>
                                </div>
								<div class="col-xs-12 col-sm-12 col-md-5">
									<label>Student Current Course<span class="text-danger">*</span></label>
									<select name="susccourse" id="susccourse" class="form-control" required>
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
								<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
									<label>Student Current Year Level<span class="text-danger">*</span></label>
									<select name="suscsyrlvl" id="suscsyrlvl" class="form-control" required>
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
							<h4 class="sub-title" style="font-weight: bold; font-size: 16px;">Father Details</h4>
							<div class="row" >
								<div class="col-xs-12 col-sm-12 col-md-12">
									<label>Full Name<span class="text-danger">*</span></label>
									<input type="text" name="susffname" id="susffname" class="form-control" required/>
								</div>
							</div>
                        </div>
                        <div class="form-group">
                            <h4 class="sub-title" style="font-weight: bold; font-size: 16px;">Mother Details</h4>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label>Full Name<span class="text-danger">*</span></label>
                                    <input type="text" name="susmfname" id="susmfname" class="form-control" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>DSWD Household / 4ps No.<span class="text-danger">*</label>
                                    <input type="text" name="sus4psno" id="sus4psno" class="form-control" placeholder="Put N/A if none" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>Household Capital Income<span class="text-danger">*</label>
                                    <input type="text" name="suspcyincome" id="suspcyincome" class="form-control" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>Specify Disability / Attached PWD Id<span class="text-danger">*</label>
                                    <input type="text" name="suspwdid" id="suspwdid" class="form-control" placeholder="Put N/A if none" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                	<label>Date Filed<span class="text-danger">*</label>
                                    <input type="date" name="sussdfile" id="sussdfile" autocomplete="off" class="form-control" required>
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
                                            <input type="date" name="susdstbytpic" id="susdstbytpic" autocomplete="off" class="form-control" />
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <label>Date Recv. 2x2 ID Picture<span class="text-danger">*</span></label>
                                            <input type="date" name="susdspsa" id="susdspsa" autocomplete="off" class="form-control" />
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <label>Date Recv. Brgy. Indigency<span class="text-danger">*</span></label>
                                            <input type="date" name="susdsbrgyin" id="susdsbrgyin" autocomplete="off" class="form-control" />
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <label>Select Phoc. PSA Status<span class="text-danger">*</span></label>
                                            <select name="susdstbytpicstat" id="susdstbytpicstat" class="form-control" required>
                                            <option value="">-Select-</option>
                                            <option value="Received">Received</option>
                                            <option value="Not-Received">Not-Received</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <label>Select 2x2 ID Pic. Status<span class="text-danger">*</span></label>
                                            <select name="susdspsastat" id="susdspsastat" class="form-control" required>
                                            <option value="">-Select-</option>
                                            <option value="Received">Received</option>
                                            <option value="Not-Received">Not-Received</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <label>Select Brgy. Res. Status<span class="text-danger">*</span></label>
                                            <select name="susdsbrgyinstat" id="susdsbrgyinstat" class="form-control" required>
                                            <option value="">-Select-</option>
                                            <option value="Received">Received</option>
                                            <option value="Not-Received">Not-Received</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                        </div>
						<div class="form-group">
							<div class="card">
								<div class="card-header" style="font-weight: bold; font-size: 18px;">Scholars Note</div>
									<div class="card-body">
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>Note:</label>
											<textarea type="text" name="sus_scholarship_note" id="sus_scholarship_note" placeholder="Put N/A if None" class="form-control" required data-parsley-trigger="keyup"></textarea>
										</div>
									</div>
							</div>
						</div>
						<div class="form-group">
							<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">Scholarship Details</div>
								<div class="card-body">
									<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
										<label>Scholarship Status<span class="text-danger">*</span></label>
										<select name="sus_scholar_stat" id="sus_scholar_stat" class="form-control" required>
										<option value="">-Select-</option>
										<option value="Pending">Pending</option>
										<option value="Approved">Approved</option>
										<option value="Rejected">Rejected</option>
										<option value="Renewal">Renewal</option>
										</select>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="unifast_hidden_id" id="unifast_hidden_id" />
                        <input type="hidden" name="action" id="unifast_action" value="add_unifast" />
                        <input type="submit" name="submit" id="unifast_submit_button" class="btn btn-success" value="Add" />
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Add CHED Modal -->
	<div id="chedModal" class="modal fade">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form method="post" id="ched_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ched_modal_title">Add CHED Scholar</h4>
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
                                    <input type="text" name="scss_id" id="scss_id" class="form-control" required/>
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
                                    <label>First Name<span class="text-danger">*</span></label>
                                    <input type="text" name="scsfname" id="scsfname" class="form-control" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label>Middle Name<span class="text-danger">*</span></label>
                                    <input type="text" name="scsmname" id="scsmname" class="form-control" placeholder="Put N/A if none" required/>
                                    </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label>Last Name<span class="text-danger">*</span></label>
                                    <input type="text" name="scslname" id="scslname" class="form-control" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label>Select Suffix<span class="text-danger">*</span></label>
                                    <select name="scsnext" id="scsnext" class="form-control" required>
                                    <option value="">-Select-</option>
                                    <option value="N/A">N/A</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    </select>
                                </div>
                                <div class="col-xs-10 col-sm-12 col-md-4">
                                    <label>Date of Birth<span class="text-danger">*</span></label>
                                    <input type="date" name="scsdbirth" id="scsdbirth" class="form-control" required>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <label>Select Gender<span class="text-danger">*</span></label>
                                    <select name="scsgender" id="scsgender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <label>Civil Status<span class="text-danger">*</span></label>
                                    <select name="scscivilstat" id="scscivilstat" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label>Place of birth<span class="text-danger">*</span></label>
                                    <textarea type="text" name="scspbirth" id="scspbirth" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8">
                                    <label>Permanent Mailing Address<span class="text-danger">*</span></label>
                                    <textarea type="text" name="scsaddress" id="scsaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <label>Zip Code<span class="text-danger">*</span></label>
                                    <textarea type="text" name="scszcode" id="scszcode" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>School Name<span class="text-danger">*</span></label>
                                    <textarea type="text" name="scspschname" id="scspschname" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>School Address<span class="text-danger">*</span></label>
                                    <textarea type="text" name="scspsaddress" id="scspsaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>School Type<span class="text-danger">*</span></label>
                                    <select name="scspstype" id="scspstype" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="Private">Private</option>
                                    <option value="Public">Public</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label>Highest Grade/Year<span class="text-danger">*</span></label>
                                    <input type="text" name="scspsyrlvl" id="scspsyrlvl" class="form-control" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label>Citizenship<span class="text-danger">*</span></label>
                                    <input type="text" name="scsctship" id="scsctship" class="form-control" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                    <label>Mobile Number<span class="text-danger">*</span></label>
                                    <input type="text" name="scscontact" id="scscontact" class="form-control" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input type="text" name="scsemail" id="scsemail" class="form-control" required/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <label>Type of Disability(if applicable)<span class="text-danger">*</span></label>
                                    <input type="text" name="scsdisability" id="scsdisability" class="form-control" placeholder="Put N/A if none" required/>
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
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label>Full Name<span class="text-danger">*</span></label>
                                        <input type="text" name="scsffname" id="scsffname" class="form-control" required/>
                                        </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Status<span class="text-danger">*</label>
                                        <select name="scsflstatus" id="scsflstatus" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <option value="Living">Living</option>
                                        <option value="Deceased">Deceased</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Occupation<span class="text-danger">*</span></label>
                                        <input type="text" name="scsfoccu" id="scsfoccu" class="form-control" placeholder="Put N/A if none" required/>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Educational Attainment<span class="text-danger">*</span></label>
                                        <input type="text" name="scsfeduc" id="scsfeduc" class="form-control" placeholder="Put N/A if none" required/>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label>Address<span class="text-danger">*</span></label>
                                        <textarea type="text" name="scsfaddress" id="scsfaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h4 class="sub-title" style="font-weight: bold; font-size: 16px;">Mother Details</h4>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label>Full Name<span class="text-danger">*</span></label>
                                        <input type="text" name="scsmfname" id="scsmfname" class="form-control" required/>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Status<span class="text-danger">*</label>
                                        <select name="scsmlstatus" id="scsmlstatus" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <option value="Living">Living</option>
                                        <option value="Deceased">Deceased</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Occupation<span class="text-danger">*</span></label>
                                        <input type="text" name="scsmoccu" id="scsmoccu" class="form-control" placeholder="Put N/A if none" required/>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Educational Attainment<span class="text-danger">*</span></label>
                                        <input type="text" name="scsmeduc" id="scsmeduc" class="form-control" placeholder="Put N/A if none" required/>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label>Address<span class="text-danger">*</span></label>
                                        <textarea type="text" name="scsmaddress" id="scsmaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Total Parent Gross Income<span class="text-danger">*</span></label>
                                        <input type="text" name="scspcyincome" id="scspcyincome" class="form-control" required/>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                                        <label>No. of Siblings in the family<span class="text-danger">*</span></label>
                                        <input type="text" name="scsnsibling" id="scsnsibling" class="form-control" placeholder="Put N/A if none" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="card">
                            <div class="card-header" style="font-weight: bold; font-size: 18px;">Education Details</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label>School intended to enroll in <span class="text-danger">*</span></label>
                                            <textarea type="text" name="scscsintend" id="scscsintend" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label>School Address <span class="text-danger">*</span></label>
                                            <textarea type="text" name="scscsadd" id="scscsadd" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-5">
                                        	<label>Type of School<span class="text-danger">*</span></label>
                                            <select name="scscschooltype" id="scscschooltype" class="form-control" required>
                                            <option value="">Select Type</option>
                                            <option value="Private">Private</option>
                                            <option value="Public">Public</option>
                                            </select>
                                        </div>
										<div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
											<label>Current Course<span class="text-danger">*</span></label>
											<select name="scsccourse" id="scsccourse" class="form-control" required>
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
										<div class="col-xs-12 col-sm-12 col-md-5">
											<label>Current Year Level<span class="text-danger">*</span></label>
											<select name="scscsyrlvl" id="scscsyrlvl" class="form-control" required>
											<option value="">-Select-</option>
											<option value="1st Year">1st Year</option>
											<option value="2nd Year">2nd Year</option>
											<option value="3rd Year">3rd Year</option>
											<option value="4th Year">4th Year</option>
											</select>
										</div>
                                        <div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
                                        	<label>Course Priority/Not Priority<span class="text-danger">*</span></label>
                                            <select name="scsccourseprio" id="scsccourseprio" class="form-control" required>
                                            <option value="">Select </option>
                                            <option value="Priority">Piority</option>
                                            <option value="Not Priority">Not Priority</option>
                                            </select>
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
                                            <label>Date Recv. Report Card<span class="text-danger">*</span></label>
                                            <input type="date" name="scsdsprc" id="scsdsprc" autocomplete="off" class="form-control" />
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <label>Date Recv. Good Moral<span class="text-danger">*</span></label>
                                            <input type="date" name="scsdspgm" id="scsdspgm" autocomplete="off" class="form-control" />
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <label>Date Recv. Brgy. Indigency<span class="text-danger">*</span></label>
                                            <input type="date" name="scsdsbrgyin" id="scsdsbrgyin" autocomplete="off" class="form-control" />
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <label>Select Report Card Status<span class="text-danger">*</span></label>
                                            <select name="scsdsprcstat" id="scsdsprcstat" class="form-control" required>
                                            <option value="">-Select-</option>
                                            <option value="Received">Received</option>
                                            <option value="Not-Received">Not-Received</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <label>Select Good Moral Status<span class="text-danger">*</span></label>
                                            <select name="scsdspgmstat" id="scsdspgmstat" class="form-control" required>
                                            <option value="">-Select-</option>
                                            <option value="Received">Received</option>
                                            <option value="Not-Received">Not-Received</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <label>Select Brgy. Indigency Status<span class="text-danger">*</span></label>
                                            <select name="scsdsbrgyinstat" id="scsdsbrgyinstat" class="form-control" required>
                                            <option value="">-Select-</option>
                                            <option value="Received">Received</option>
                                            <option value="Not-Received">Not-Received</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            </div>
                        </div>
						<div class="form-group">
							<div class="card">
								<div class="card-header" style="font-weight: bold; font-size: 18px;">Scholars Note</div>
									<div class="card-body">
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>Note:</label>
											<textarea type="text" name="scs_scholarship_note" id="scs_scholarship_note" placeholder="Put N/A if None" class="form-control" required data-parsley-trigger="keyup"></textarea>
										</div>
									</div>
							</div>
						</div>
						<div class="form-group">
							<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">Scholarship Details</div>
								<div class="card-body">
									<div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
										<label>Scholarship Status<span class="text-danger">*</span></label>
										<select name="scs_scholar_stat" id="scs_scholar_stat" class="form-control" required>
										<option value="">-Select-</option>
										<option value="Pending">Pending</option>
										<option value="Approved">Approved</option>
										<option value="Rejected">Rejected</option>
										<option value="Renewal">Renewal</option>
										</select>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="ched_hidden_id" id="ched_hidden_id" />
                        <input type="hidden" name="action" id="ched_action" value="add_ched" />
                        <input type="submit" name="submit" id="ched_submit_button" class="btn btn-success" value="Add" />
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Send Email Modal -->
	<div id="emailModal" class="modal fade">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<form method="post" id="email_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal_title" style="font-weight: bold; font-size: 20px;">Send Email</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">Message</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>Send to:<span class="text-danger">*</span></label>
											<input type="text" name="semail" id="semail" class="form-control" autocomplete="off" required/>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>Subject:<span class="text-danger">*</span></label>
											<input type="text" name="emailsubject" id="emailsubject" class="form-control" autocomplete="off" required/>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>Message:<span class="text-danger">*</span></label>
											<textarea type="text" name="emailmessage" id="emailmessage" rows="3" autocomplete="off" class="form-control" required data-parsley-trigger="keyup"></textarea>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="email_send" id="email_send" class="btn btn-success">Send</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<!-- Send SMS Modal -->
	<div id="smsModal" class="modal fade">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<form method="post" id="sms_form">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal_title" style="font-weight: bold; font-size: 20px;">Send Email</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="card">
							<div class="card-header" style="font-weight: bold; font-size: 18px;">Message</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>Send to:<span class="text-danger">*</span></label>
											<input type="text" name="scontact" id="scontact" class="form-control" autocomplete="off" required/>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12">
											<label>Message:<span class="text-danger">*</span></label>
											<textarea type="text" name="smsmessage" id="smsmessage" rows="3" autocomplete="off" class="form-control" required data-parsley-trigger="keyup"></textarea>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="sms_send" id="sms_send" class="btn btn-success">Send</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<!-- View Acad Modal -->
	<div id="viewacadModal" class="modal fade">
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
<!-- View Non-Acad Modal -->
	<div id="viewnonacadModal" class="modal fade">
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
<!-- View UNIFAST Modal -->
	<div id="viewunifastModal" class="modal fade">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">View Student Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="unifast_details">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- View CHED Modal -->
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
	<!-- <div id="csvUPModal" class="modal fade">
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
	</div> -->
	<!-- <div id="csvIMPModal" class="modal fade">
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
	</div> -->
		<div id="csvUPModal" class="modal fade">
			<!-- <form method="post" id="import_form"> -->
			<div class="modal-dialog modal-xl modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="modal_title" style="font-weight: bold; font-size: 20px;">Import CSV File</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
						<!-- <div id="import_message"></div> -->
							<div class="card">
								<div class="card-header">
									<h5 class="card-title" style="font-weight: bold; font-size: 16px;">Select CSV File</h5>
								</div>
								<div class="card-body">
									<span id="upload_message"></span>
									<form id="sample_form" method="POST" enctype="multipart/form-data" class="form-horizontal">
										<div class="form-group">
											<input type="file" name="file" id="file" />
										</div>
										<!-- <div class="form-group" align="center">
											<input type="hidden" name="hidden_field" value="1" />
											<input type="submit" name="import" id="import" class="btn btn-info" value="Import" />
										</div> -->
									</form>
									<div class="form-group" id="process" style="display:none;">
										<div class="progress">
											<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
												<span id="process_data">0</span> - <span id="total_data">0</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="hidden_field" value="1" />
  							<input type="submit" name="import" id="import" class="btn btn-success" value="Import" />
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			<!-- </form> -->
		</div>
	<!-- <div id="csvUPModal" class="modal fade">
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Import CSV File Data</h3>
				</div>
				<div class="panel-body">
					<span id="message"></span>
					<form id="sample_form" method="POST" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">Select CSV File</label>
							<input type="file" name="file" id="file" />
						</div>
						<div class="form-group" align="center">
							<input type="hidden" name="hidden_field" value="1" />
							<input type="submit" name="import" id="import" class="btn btn-info" value="Import" />
						</div>
					</form>
					<div class="form-group" id="process" style="display:none;">
						<div class="progress">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								<span id="process_data">0</span> - <span id="total_data">0</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	
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
			url:"scholars_action.php",
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

// Multi Search Filter
	// load_data();
	
	// function load_data(query='')
	// {
	// 	$.ajax({
	// 		url:"scholars_action.php",
	// 		method:"POST",
	// 		data:{query:query},
	// 		success:function(data)
	// 		{
	// 			$('tbody').html(data);
	// 		}
	// 	})
	// }

	// $('#multi_search_filter').change(function(){
	// 	$('#hidden_s_scholarship_type').val($('#multi_search_filter').val());
	// 	var query = $('#hidden_s_scholarship_type').val();
	// 	load_data(query);
	// });

// add_acad
	$('#add_acad').click(function(){

		$('#acad_form')[0].reset();

		$('#acad_form').parsley().reset();

		$('#acadmodal_title').text('Add Academic Scholar');

		$('#action').val('add_acad');

		$('#acad_submit_button').val('Add');

		$('#acadModal').modal('show');

		$('#ss_id').attr('disabled', false);

		$('#form_message').html('');
		
	});

// add_nonacad
	$('#add_nonacad').click(function(){

	$('#nonacad_form')[0].reset();

	$('#nonacad_form').parsley().reset();

	$('#nonacadmodal-title').text('Add Non-Academic Scholar');

	$('#nonacad_action').attr('add_nonacad');

	$('#nonacad_submit_button').val('Add');

	$('#nonacadModal').modal('show');

	$('#sns_id').attr('disabled', false);

	$('#nonacadform_message').html('');

	});
// add_unifast
    $('#add_unifast').click(function(){

	$('#unifast_form')[0].reset();

	$('#unifast_form').parsley().reset();

	$('#modal_title').text('Add Unifast Scholar');

	$('#unifast_action').val('add_unifast');

	$('#unifast_submit_button').val('Add');

	$('#unifastModal').modal('show');

	$('#sus_id').attr('disabled', false);

	$('#form_message').html('');

	});

// add_ched
	$('#add_ched').click(function(){

	$('#ched_form')[0].reset();

	$('#ched_form').parsley().reset();

	$('#ched_modal_title').text('Add CHED Scholar');

	$('#ched_action').val('add_ched');

	$('#ched_submit_button').val('Add');

	$('#chedModal').modal('show');

	$('#scss_id').attr('disabled', false);

	$('#form_message').html('');

	});

// Submit_acad_form
	$('#acad_form').parsley();

	$('#acad_form').on('submit', function(event){
		event.preventDefault();
		if($('#acad_form').parsley().isValid())
		{		
			$.ajax({
				url:"scholars_action.php",
				method:"POST",
				data: new FormData(this),
				dataType:'json',
				contentType: false,
				cache: false,
				processData:false,
				beforeSend:function()
				{
					$('#acad_submit_button').attr('disabled', 'disabled');
					$('#acad_submit_button').val('wait...');
				},
				success:function(data)
				{
					$('#acad_submit_button').attr('disabled', false);
					if(data.error != '')
					{
						$('#form_message').html(data.error);
						$('#acad_submit_button').val('Add');
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

// Submit_nonacad_form
	$('#nonacad_form').parsley();

	$('#nonacad_form').on('submit', function(event){
		event.preventDefault();
		if($('#nonacad_form').parsley().isValid())
		{		
			$.ajax({
				url:"scholars_action.php",
				method:"POST",
				data: new FormData(this),
				dataType:'json',
				contentType: false,
				cache: false,
				processData:false,
				beforeSend:function()
				{
					$('#nonacad_submit_button').attr('disabled', 'disabled');
					$('#nonacad_submit_button').val('wait...');
				},
				success:function(data)
				{
					$('#nonacad_submit_button').attr('disabled', false);
					if(data.error != '')
					{
						$('#nonacadform_message').html(data.error);
						$('#nonacad_submit_button').val('Add');
					}
					else
					{
						$('#nonacadModal').modal('hide');
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
// Submit_unifast_form
	$('#unifast_form').parsley();

	$('#unifast_form').on('submit', function(event){
		event.preventDefault();
		if($('#unifast_form').parsley().isValid())
		{		
			$.ajax({
				url:"scholars_action.php",
				method:"POST",
				data: new FormData(this),
				dataType:'json',
				contentType: false,
				cache: false,
				processData:false,
				beforeSend:function()
				{
					$('#unifast_submit_button').attr('disabled', 'disabled');
					$('#unifast_submit_button').val('wait...');
				},
				success:function(data)
				{
					$('#unifast_submit_button').attr('disabled', false);
					if(data.error != '')
					{
						$('#unifastform_message').html(data.error);
						$('#unifast_submit_button').val('Add');
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
// Submit_ched_form
    $('#ched_form').parsley();

    $('#ched_form').on('submit', function(event){
        event.preventDefault();
        if($('#ched_form').parsley().isValid())
        {		
            $.ajax({
                url:"scholars_action.php",
                method:"POST",
                data: new FormData(this),
                dataType:'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend:function()
                {
                    $('#ched_submit_button').attr('disabled', 'disabled');
                    $('#ched_submit_button').val('wait...');
                },
                success:function(data)
                {
                    $('#ched_submit_button').attr('disabled', false);
                    if(data.error != '')
                    {
                        $('#form_message').html(data.error);
                        $('#ched_submit_button').val('Add');
                    }
                    else
                    {
                        $('#chedModal').modal('hide');
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
		// $('#add_csv').click(function(){
		
		// $('#upload_form')[0].reset();

		// $('#upload_form').parsley().reset();

		// $('#action').val('Upload');

		// $('#upload_file').val('Upload');

		// $('#csvUPModal').modal('show');

		// $('#upload_message').html('');

		// });
// Upload CSV
	$('#add_csv').click(function(){
		
		$('#sample_form')[0].reset();

		$('#sample_form').parsley().reset();

		$('#action').val('Upload');

		$('#import').val('Import');

		$('#csvUPModal').modal('show');

		$('#upload_message').html('');

		});
// Upload Form
		var clear_timer;

		$('#sample_form').on('submit', function(event){
			$('#message').html('');
			event.preventDefault();
			$.ajax({
				url:"upload.php",
				method:"POST",
				data: new FormData(this),
				dataType:"json",
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$('#import').attr('disabled','disabled');
					$('#import').val('Importing');
				},
				success:function(data)
				{
					if(data.success)
					{
						$('#total_data').text(data.total_line);

						start_import();

						clear_timer = setInterval(get_import_data, 2000);

						//$('#message').html('<div class="alert alert-success">CSV File Uploaded</div>');
					}
					if(data.error)
					{
						$('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
						$('#import').attr('disabled',false);
						$('#import').val('Import');
					}
				}
			})
		});

		function start_import()
		{
			$('#process').css('display', 'block');
			$.ajax({
				url:"import.php",
				success:function()
				{

				}
			})
		}

		function get_import_data()
		{
			$.ajax({
				url:"process.php",
				success:function(data)
				{
					var total_data = $('#total_data').text();
					var width = Math.round((data/total_data)*100);
					$('#process_data').text(data);
					$('.progress-bar').css('width', width + '%');
					if(width >= 100)
					{
						clearInterval(clear_timer);
						$('#process').css('display', 'none');
						$('#file').val('');
						$('#message').html('<div class="alert alert-success">Data Successfully Imported</div>');
						$('#import').attr('disabled',false);
						$('#import').val('Import');
					}
				}
			})
		}

// Upload Form
	$('#upload_form').parsley();
		
		$('#upload_form').on('submit', function(event){
		event.preventDefault();

			if($('#upload_form').parsley().isValid())
			{	
				$.ajax({
					url:"scholars_action.php",
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

		var	ss_id	    		=	0
		var	sfname	    		=	0
		var	smname	    		=	0
		var	slname	    		=	0
		var	snext	    		=	0
		var	sdbirth	    		=	0
		var	sgender	    		=	0
		var	saddress			=	0
		var	szcode	    		=	0
		var	scontact			=	0
		var	semail	    		=	0
		var	sctship	    		=	0
		var	scivilstat			=	0
		var	spbirth	    		=	0
		var	sdisability			=	0
		var	s4psno	    		=	0
		var	spwdid	    		=	0
		var	srappsship			=	0
		var	srappnas			=	0
		var	sbos	    		=	0
		var	ssskills			=	0
		var	stwinterest			=	0
		var	ssdfile	    		=	0
		var	sgfname	    		=	0
		var	sgmname	    		=	0
		var	sglname	    		=	0
		var	sgnext	    		=	0
		var	sglstatus			=	0
		var	sgeduc	    		=	0
		var	sgcontact			=	0
		var	sgaddress			=	0
		var	sgoccu	    		=	0
		var	sgcompany			=	0
		var	sffname	    		=	0
		var	sfmname	    		=	0
		var	sflname	    		=	0
		var	sfnext	    		=	0
		var	sflstatus			=	0
		var	sfeduc	    		=	0
		var	sfcontact			=	0
		var	sfaddress			=	0
		var	sfoccu	    		=	0
		var	sfcompany			=	0
		var	smfname	    		=	0
		var	smmname	    		=	0
		var	smlname	    		=	0
		var	smnext	    		=	0
		var	smlstatus			=	0
		var	smeduc	    		=	0
		var	smcontact			=	0
		var	smaddress			=	0
		var	smoccu	    		=	0
		var	smcompany			=	0
		var	snsibling			=	0
		var	spcyincome			=	0
		var	spschname			=	0
		var	spsaddress			=	0
		var	spstype	    		=	0
		var	spscourse			=	0
		var	spsyrlvl			=	0
		var	spsgwa	    		=	0
		var	spsraward			=	0
		var	spsdawardrceive		=	0
		var	scsintend			=	0
		var	scsadd	    		=	0
		var	scschooltype    	=	0
		var	sccourse	    	=	0
		var	sccourseprio		=	0
		var	scsyrlvl	    	=	0
		var	spass	        	=	0
		var	sdsprc	        	=	0
		var	sdsprcstat	    	=	0
		var	sdspgm	        	=	0
		var	sdspgmstat	    	=	0
		var	sdspcr	        	=	0
		var	sdspcrstat	    	=	0
		var	sdstbytpic	    	=	0
		var	sdstbytpicstat		=	0
		var	sdsbrgyin	    	=	0
		var	sdsbrgyinstat		=	0
		var	sdscef	        	=	0
		var	sdscefstat	    	=	0
		var	sdspsa	        	=	0
		var	sdspsastat	    	=	0
		var	sdsobr	        	=	0
		var	sdsobrstat	    	=	0
		var	s_scholarship_note	=	0
		var	s_added_on	    	=	0
		var	s_applied_on		=	0
		var	s_verification_code	=	0
		var	s_user_otp	    	=	0
		var	s_email_verify		=	0
		var	s_account_status	=	0
		var	s_grant_stat	    =	0
		var	s_scholar_stat	    =	0
		var	s_scholarship_type	=	0

		var column_data = [];

		$(document).on('change', '.set_column_data', function(){

		var column_name = $(this).val();

		var column_number = $(this).data('column_number');

			if(column_name in column_data)
		{

			alert('You have already define '+column_name+ ' column');

			$(this).val('');

			column_data[$(this).val(column_name)].reset();

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

		if(total_selection >= 96)
		{

		$('#import').attr('disabled', false);

		ss_id				=	column_data.ss_id;
		sfname				=	column_data.sfname;
		smname				=	column_data.smname;
		slname				=	column_data.slname;
		snext				=	column_data.snext;
		sdbirth				=	column_data.sdbirth;
		sgender				=	column_data.sgender;
		saddress			=	column_data.saddress;
		szcode				=	column_data.szcode;
		scontact			=	column_data.scontact;
		semail				=	column_data.semail;
		sctship				=	column_data.sctship;
		scivilstat			=	column_data.scivilstat;
		spbirth				=	column_data.spbirth;
		sdisability			=	column_data.sdisability;
		s4psno				=	column_data.s4psno;
		spwdid				=	column_data.spwdid;
		srappsship			=	column_data.srappsship;
		srappnas			=	column_data.srappnas;
		sbos				=	column_data.sbos;
		ssskills			=	column_data.ssskills;
		stwinterest			=	column_data.stwinterest;
		ssdfile				=	column_data.ssdfile;
		sgfname				=	column_data.sgfname;
		sgmname				=	column_data.sgmname;
		sglname				=	column_data.sglname;
		sgnext				=	column_data.sgnext;
		sglstatus			=	column_data.sglstatus;
		sgeduc				=	column_data.sgeduc;
		sgcontact			=	column_data.sgcontact;
		sgaddress			=	column_data.sgaddress;
		sgoccu				=	column_data.sgoccu;
		sgcompany			=	column_data.sgcompany;
		sffname				=	column_data.sffname;
		sfmname				=	column_data.sfmname;
		sflname				=	column_data.sflname;
		sfnext				=	column_data.sfnext;
		sflstatus			=	column_data.sflstatus;
		sfeduc				=	column_data.sfeduc;
		sfcontact			=	column_data.sfcontact;
		sfaddress			=	column_data.sfaddress;
		sfoccu				=	column_data.sfoccu;
		sfcompany			=	column_data.sfcompany;
		smfname				=	column_data.smfname;
		smmname				=	column_data.smmname;
		smlname				=	column_data.smlname;
		smnext				=	column_data.smnext;
		smlstatus			=	column_data.smlstatus;
		smeduc				=	column_data.smeduc;
		smcontact			=	column_data.smcontact;
		smaddress			=	column_data.smaddress;
		smoccu				=	column_data.smoccu;
		smcompany			=	column_data.smcompany;
		snsibling			=	column_data.snsibling;
		spcyincome			=	column_data.spcyincome;
		spschname			=	column_data.spschname;
		spsaddress			=	column_data.spsaddress;
		spstype				=	column_data.spstype;
		spscourse			=	column_data.spscourse;
		spsyrlvl			=	column_data.spsyrlvl;
		spsgwa				=	column_data.spsgwa;
		spsraward			=	column_data.spsraward;
		spsdawardrceive		=	column_data.spsdawardrceive;
		scsintend			=	column_data.scsintend;
		scsadd				=	column_data.scsadd;
		scschooltype		=	column_data.scschooltype;
		sccourse			=	column_data.sccourse;
		sccourseprio		=	column_data.sccourseprio;
		scsyrlvl			=	column_data.scsyrlvl;
		spass				=	column_data.spass;
		sdsprc				=	column_data.sdsprc;
		sdsprcstat			=	column_data.sdsprcstat;
		sdspgm				=	column_data.sdspgm;
		sdspgmstat			=	column_data.sdspgmstat;
		sdspcr				=	column_data.sdspcr;
		sdspcrstat			=	column_data.sdspcrstat;
		sdstbytpic			=	column_data.sdstbytpic;
		sdstbytpicstat		=	column_data.sdstbytpicstat;
		sdsbrgyin			=	column_data.sdsbrgyin;
		sdsbrgyinstat		=	column_data.sdsbrgyinstat;
		sdscef				=	column_data.sdscef;
		sdscefstat			=	column_data.sdscefstat;
		sdspsa				=	column_data.sdspsa;
		sdspsastat			=	column_data.sdspsastat;
		sdsobr				=	column_data.sdsobr;
		sdsobrstat			=	column_data.sdsobrstat;
		s_scholarship_note	=	column_data.s_scholarship_note;
		s_added_on			=	column_data.s_added_on;
		s_applied_on		=	column_data.s_applied_on;
		s_verification_code	=	column_data.s_verification_code;
		s_user_otp			=	column_data.s_user_otp;
		s_email_verify		=	column_data.s_email_verify;
		s_account_status	=	column_data.s_account_status;
		s_grant_stat		=	column_data.s_grant_stat;
		s_scholar_stat		=	column_data.s_scholar_stat;
		s_scholarship_type	=	column_data.s_scholarship_type;


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
			url:"scholars_action.php",
			method:"POST",
			data:
			{ss_id:ss_id, sfname:sfname, smname:smname, slname:slname, snext:snext, 
			sdbirth:sdbirth, sgender:sgender, saddress:saddress, szcode:szcode, scontact:scontact, 
			semail:semail, sctship:sctship, scivilstat:scivilstat, spbirth:spbirth, sdisability:sdisability, 
			s4psno:s4psno, spwdid:spwdid, srappsship:srappsship, srappnas:srappnas, sbos:sbos, ssskills:ssskills, 
			stwinterest:stwinterest, ssdfile:ssdfile, sgfname:sgfname, sgmname:sgmname, sglname:sglname, sgnext:sgnext, 
			sglstatus:sglstatus, sgeduc:sgeduc, sgcontact:sgcontact, sgaddress:sgaddress, sgoccu:sgoccu, sgcompany:sgcompany, 
			sffname:sffname, sfmname:sfmname, sflname:sflname, sfnext:sfnext, sflstatus:sflstatus, sfeduc:sfeduc, 
			sfcontact:sfcontact, sfaddress:sfaddress, sfoccu:sfoccu, sfcompany:sfcompany, smfname:smfname, 
			smmname:smmname, smlname:smlname, smnext:smnext, smlstatus:smlstatus, smeduc:smeduc, 
			smcontact:smcontact, smaddress:smaddress, smoccu:smoccu, smcompany:smcompany, snsibling:snsibling, 
			spcyincome:spcyincome, spschname:spschname, spsaddress:spsaddress, spstype:spstype, spscourse:spscourse, 
			spsyrlvl:spsyrlvl, spsgwa:spsgwa, spsraward:spsraward, spsdawardrceive:spsdawardrceive, scsintend:scsintend, 
			scsadd:scsadd, scschooltype:scschooltype, sccourse:sccourse, sccourseprio:sccourseprio, 
			scsyrlvl:scsyrlvl, spass:spass, sdsprc:sdsprc, sdsprcstat:sdsprcstat, sdspgm:sdspgm, 
			sdspgmstat:sdspgmstat, sdspcr:sdspcr, sdspcrstat:sdspcrstat, sdstbytpic:sdstbytpic, 
			sdstbytpicstat:sdstbytpicstat, sdsbrgyin:sdsbrgyin, sdsbrgyinstat:sdsbrgyinstat, sdscef:sdscef, 
			sdscefstat:sdscefstat, sdspsa:sdspsa, sdspsastat:sdspsastat, sdsobr:sdsobr, sdsobrstat:sdsobrstat, 
			s_scholarship_note:s_scholarship_note, s_added_on:s_added_on, s_applied_on:s_applied_on, 
			s_verification_code:s_verification_code, s_user_otp:s_user_otp, s_email_verify:s_email_verify, 
			s_account_status:s_account_status, s_grant_stat:s_grant_stat, s_scholar_stat:s_scholar_stat, 
			s_scholarship_type:s_scholarship_type, action:'import'},
			dataType:'JSON',
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
				// if(data.success != '')
				// {
					$('#message').html(data.success);
					$('#csvIMPModal').modal('hide');
					$('#import_form')[0].reset();
					// setTimeout(function() 
                    // {
                    //   location.reload();  //Refresh page
                    // }, 5000);
				// }	
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
                url:"scholars_action.php",
                method:"POST",
                data:{checkbox_value:checkbox_value, action:'export_csv'},
				success: function(response) {
					DownloadCsv(response, 'Scholar Master List('+d+').csv')
				}
            });
        }
        else
        {
            alert("Please select at least one records");
        }
    });
// Bulk Email
	$('#bulk_email').click(function(){

		$('#email_form')[0].reset();

		$('#email_form').parsley().reset();

		var checkbox = $('.checkbox:checked');
        if(checkbox.length > 0)
        {
            var checkbox_value = [];
            $(checkbox).each(function(){
                checkbox_value.push($(this).data("email"));
            });

			$("input[name='semail']").val(checkbox_value.join(", "));

			$('#emailModal').modal('show');

        }
        else
        {
            alert("Please select at least one records");
        }

	});
// Send Email
	$('#email_send').click(function(){

	$(this).attr('disabled', 'disabled');
	var id  = $(this).attr("id");
	var action = $(this).data("action");
	var email_data = [];
		$('.checkbox').each(function(){
			if($(this).prop("checked") == true)
			{
				email_data.push({
					email: $(this).data("email")
				});
			} 
		});
	var emailsubject = $('#emailsubject').val();
	var emailmessage = $('#emailmessage').val();

	$.ajax({
		url:"scholars_action.php",
		method:"POST",
		data:{email_data:email_data, emailmessage:emailmessage, emailsubject:emailsubject, action:'send_email'},
		dataType:'JSON',
		beforeSend:function(){
			$('#email_send').val('Sending...');
			$('#email_send').addClass('btn-danger');
		},
		success:function(data){
			if(data.error !== '')
			{
				$('#message').html(data.error);
			}
			if(data.success != '')
			{
				$('#emailModal').modal('hide');
				$('#message').html(data.success);

				setTimeout(function(){

					$('#message').html('');

				}, 3000);

				setTimeout(function(){

					location.reload();  //Refresh page

				}, 5000);
			}

		}
	})

	});

// Bulk SMS
	$('#bulk_sms').click(function(){

	$('#sms_form')[0].reset();

	$('#sms_form').parsley().reset();

	var checkbox = $('.checkbox:checked');
	if(checkbox.length > 0)
	{
		var checkbox_value = [];
		$(checkbox).each(function(){
			checkbox_value.push($(this).data("sms"));
		});

		$("input[name='scontact']").val(checkbox_value.join(", "));

		$('#smsModal').modal('show');

	}
	else
	{
		alert("Please select at least one records");
	}

	});

// Send SMS
		$('#sms_send').click(function(){

		$(this).attr('disabled', 'disabled');
		var id  = $(this).attr("id");
		var action = $(this).data("action");
		var sms_data = [];
			$('.checkbox').each(function(){
				if($(this).prop("checked") == true)
				{
					sms_data.push({
						sms: $(this).data("sms")
					});
				} 
			});
		var smsmessage = $('#smsmessage').val();

		$.ajax({
			url:"scholars_action.php",
			method:"POST",
			data:{sms_data:sms_data, smsmessage:smsmessage, action:'send_sms'},
			dataType:'JSON',
			beforeSend:function(){
				$('#sms_send').html('Sending...');
				$('#sms_send').addClass('btn-danger');
			},
			success:function(data){
				if(data.error !== '')
				{
					$('#message').html(data.error);
				}
				if(data.success != '')
				{
					$('#smsModal').modal('hide');
					$('#message').html(data.success);

					setTimeout(function(){

						$('#message').html('');

					}, 3000);

					setTimeout(function(){

						location.reload();  //Refresh page

					}, 5000);
				}

			}
		})

		});

// Edit 
	$(document).on('click', '.edit_button', function(){

			var s_id = $(this).data('id');
			var stype = $(this).data('stype');

		// Edit Acad 
			if(stype == 'Academic')
			{

				$('#acad_form')[0].reset();

				$('#acad_form').parsley().reset();

				$('#form_message').html('');

				$.ajax({

					url:"scholars_action.php",

					method:"POST",

					data:{s_id:s_id, stype:stype, action:'acad_fetch_single'},

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
							$('#sctship').val(data.sctship);
							$('#saddress').val(data.saddress);
							$('#semail').val(data.semail);
							$('#scontact').val(data.scontact);
							$('#sccourse').val(data.sccourse);
							$('#scsyrlvl').val(data.scsyrlvl);
							// Family Details
							// Guardian Details
							$('#sgfname').val(data.sgfname);
							$('#sgaddress').val(data.sgaddress);
							$('#sgcontact').val(data.sgcontact);
							$('#sgoccu').val(data.sgoccu);
							$('#sgcompany').val(data.sgcompany);
							// Father Details
							$('#sffname').val(data.sffname);
							$('#sfaddress').val(data.sfaddress);
							$('#sfcontact').val(data.sfcontact);
							$('#sfoccu').val(data.sfoccu);
							$('#sfcompany').val(data.sfcompany);
							// Mother Details
							$('#smfname').val(data.smfname);
							$('#smaddress').val(data.smaddress);
							$('#smcontact').val(data.smcontact);
							$('#smoccu').val(data.smoccu);
							$('#smcompany').val(data.smcompany);
							$('#spcyincome').val(data.spcyincome);
							// Achievement Details
							$('#spsgwa').val(data.spsgwa);
							$('#spsraward').val(data.spsraward);
							$('#spsdawardrceive').val(data.spsdawardrceive);
							// Requirement Details
							$('#sdsprc').val(data.sdsprc);
							$('#sdsprcstat').val(data.sdsprcstat);
							$('#sdspgm').val(data.sdspgm);
							$('#sdspgmstat').val(data.sdspgmstat);
							$('#sdspcr').val(data.sdspcr);
							$('#sdspcrstat').val(data.sdspcrstat);
							// Scholarship Note
							$('#s_scholarship_note').val(data.s_scholarship_note);
							// Scholarship Details
							$('#s_scholar_stat').val(data.s_scholar_stat);

							$('#acadModal').modal('show');

							$('#acadmodal_title').text('Edit Academic Scholar Info');

							$('#acad_hidden_id').val(s_id);

							$('#ss_id').attr('disabled', true);

							$('#acad_action').val('edit_acad');

							$('#acad_submit_button').val('Edit');

					}

				})
			}
		// Edit Non-acad 
			if(stype == 'Non-Academic')
			{

					$('#nonacad_form')[0].reset();

					$('#nonacad_form').parsley().reset();

					$('#form_message').html('');

				$.ajax({

					url:"scholars_action.php",

					method:"POST",

					data:{s_id:s_id, stype:stype, action:'nonacad_fetch_single'},

					dataType:'JSON',

					success:function(data)
					{
							$('#sns_id').val(data.sns_id);
				// Personal Details
							$('#snfname').val(data.snfname);
							$('#snmname').val(data.snmname);
							$('#snlname').val(data.snlname);
							$('#snnext').val(data.snnext);
							$('#sndbirth').val(data.sndbirth);
							$('#sngender').val(data.sngender);
							$('#snctship').val(data.snctship);
							$('#snaddress').val(data.snaddress);
							$('#snemail').val(data.snemail);
							$('#sncontact').val(data.sncontact);
							$('#snccourse').val(data.snccourse);
							$('#sncsyrlvl').val(data.sncsyrlvl);
				// Family Details
						// Guardian Details
							$('#sngfname').val(data.sngfname);
							$('#sngaddress').val(data.sngaddress);
							$('#sngcontact').val(data.sngcontact);
							$('#sngoccu').val(data.sngoccu);
							$('#sngcompany').val(data.sngcompany);
						// Father Details
							$('#snffname').val(data.snffname);
							$('#snfaddress').val(data.snfaddress);
							$('#snfcontact').val(data.snfcontact);
							$('#snfoccu').val(data.snfoccu);
							$('#snfcompany').val(data.snfcompany);
						// Mother Details
							$('#snmfname').val(data.snmfname);
							$('#snmaddress').val(data.snmaddress);
							$('#snmcontact').val(data.snmcontact);
							$('#snmoccu').val(data.snmoccu);
							$('#snmcompany').val(data.snmcompany);
							$('#snpcyincome').val(data.snpcyincome);
				// Application Details
							$('#snrappnas').val(data.snrappnas);
							$('#snbos').val(data.snbos);
							$('#snsskills').val(data.snsskills);
							$('#sntwinterest').val(data.sntwinterest);
				// Education Details
							$('#snpschname').val(data.snpschname);
							$('#snpsaddress').val(data.snpsaddress);
							$('#snpsyrlvl').val(data.snpsyrlvl);
				// Requirement Details
							$('#sndsprc').val(data.sndsprc);
							$('#sndsprcstat').val(data.sndsprcstat);
							$('#sndspgm').val(data.sndspgm);
							$('#sndspgmstat').val(data.sndspgmstat);
							$('#sndstbytpic').val(data.sndstbytpic);
							$('#sndstbytpicstat').val(data.sndstbytpicstat);
							$('#sndsbrgyin').val(data.sndsbrgyin);
							$('#sndsbrgyinstat').val(data.sndsbrgyinstat);
							$('#sndscef').val(data.sndscef);
							$('#sndscefstat').val(data.sndscefstat);
				// Scholarship Note
							$('#sn_scholarship_note').val(data.sn_scholarship_note);
				// Scholarship Details
							$('#sn_scholar_stat').val(data.sn_scholar_stat);

							$('#nonacadModal').modal('show');

							$('#nonacadmodal-title').text('Edit Non-Academic Scholar Info');

							$('#nonacad_hidden_id').val(s_id);

							$('#sns_id').attr('disabled', true);

							$('#nonacad_action').val('edit_nonacad');

							$('#nonacad_submit_button').val('Edit')


					}

				})
			}
		// Edit Unifast
			if(stype == 'UNIFAST')
			{
				$('#unifast_form')[0].reset();

				$('#unifast_form').parsley().reset();

				$('#form_message').html('');

				$.ajax({

					url:"scholars_action.php",

					method:"POST",

					data:{s_id:s_id, action:'unifast_fetch_single'},

					dataType:'JSON',

					success:function(data)
					{
						// Student ID Details
									$('#sus_id').val(data.sus_id);
						// Personal Details
									$('#susfname').val(data.susfname);
									$('#susmname').val(data.susmname);
									$('#suslname').val(data.suslname);
									$('#susnext').val(data.susnext);
									$('#susgender').val(data.susgender);
									$('#susdbirth').val(data.susdbirth);
									$('#suscontact').val(data.suscontact);
									$('#susaddress').val(data.susaddress);
									$('#suspschname').val(data.suspschname);
									$('#suspscourse').val(data.suspscourse);
									$('#suspsyrlvl').val(data.suspsyrlvl);
									$('#susccourse').val(data.susccourse);
									$('#suscsyrlvl').val(data.suscsyrlvl);
									$('#susemail').val(data.susemail);     
						// Family Details
							// Father Details
									$('#susffname').val(data.susffname);
							// Mother Details
									$('#susmfname').val(data.susmfname);
							// Other Details
									$('#sus4psno').val(data.sus4psno);
									$('#suspcyincome').val(data.suspcyincome);
									$('#suspwdid').val(data.suspwdid);
									$('#sussdfile').val(data.sussdfile);
						// Requirement Details
							$('#susdspsa').val(data.susdspsa);
							$('#susdspsastat').val(data.susdspsastat);
							$('#susdstbytpic').val(data.susdstbytpic);
							$('#susdstbytpicstat').val(data.susdstbytpicstat);
							$('#susdsbrgyin').val(data.susdsbrgyin);
							$('#susdsbrgyinstat').val(data.susdsbrgyinstat);
						// Scholarship Note
							$('#sus_scholarship_note').val(data.sus_scholarship_note);
						// Scholarship Details
							$('#sus_scholar_stat').val(data.sus_scholar_stat);
							
						$('#unifastModal').modal('show');
						
						$('#modal_title').text('Edit Unifast Scholar Info');

						$('#unifast_hidden_id').val(s_id);

						$('#sus_id').attr('disabled', true);

						$('#unifast_action').val('edit_unifast');

						$('#unifast_submit_button').val('Edit');

					}

				})
			
			}
		// Edit CHED
			if(stype == 'CHED')
			{

				$('#ched_form')[0].reset();

				$('#ched_form').parsley().reset();

				$('#form_message').html('');

				$.ajax({

					url:"scholars_action.php",

					method:"POST",

					data:{s_id:s_id, action:'ched_fetch_single'},

					dataType:'JSON',

					success:function(data)
					{
				// Student ID Details
						$('#scss_id').val(data.scss_id);
				// Personal Details
						$('#scsfname').val(data.scsfname);
						$('#scsmname').val(data.scsmname);
						$('#scslname').val(data.scslname);
						$('#scsnext').val(data.scsnext);
						$('#scsdbirth').val(data.scsdbirth);
						$('#scsgender').val(data.scsgender);
						$('#scscivilstat').val(data.scscivilstat);
						$('#scspbirth').val(data.scspbirth);
						$('#scsaddress').val(data.scsaddress);
						$('#scszcode').val(data.scszcode);
						$('#scspschname').val(data.scspschname);
						$('#scspsaddress').val(data.scspsaddress);
						$('#scspstype').val(data.scspstype);
						$('#scspsyrlvl').val(data.scspsyrlvl);
						$('#scsctship').val(data.scsctship);
						$('#scscontact').val(data.scscontact);
						$('#scsemail').val(data.scsemail);
						$('#scsdisability').val(data.scsdisability);
				// Family Details
					// Father Details
							$('#scsffname').val(data.scsffname);
							$('#scsflstatus').val(data.scsflstatus);
							$('#scsfaddress').val(data.scsfaddress);
							$('#scsfoccu').val(data.scsfoccu);
							$('#scsfeduc').val(data.scsfeduc);
					// Mother Details
							$('#scsmfname').val(data.scsmfname);
							$('#scsmlstatus').val(data.scsmlstatus);
							$('#scsmaddress').val(data.scsmaddress);
							$('#scsmoccu').val(data.scsmoccu);
							$('#scsmeduc').val(data.scsmeduc);
							$('#scspcyincome').val(data.scspcyincome);
							$('#scsnsibling').val(data.scsnsibling);
				// Education Details
						$('#scscsintend').val(data.scscsintend);
						$('#scscsadd').val(data.scscsadd);
						$('#scscschooltype').val(data.scscschooltype);
						$('#scsccourse').val(data.scsccourse);
						$('#scscsyrlvl').val(data.scscsyrlvl);
						$('#scsccourseprio').val(data.scsccourseprio);
				// Requirement Details
						$('#scsdsprc').val(data.scsdsprc);
						$('#scsdsprcstat').val(data.scsdsprcstat);
						$('#scsdspgm').val(data.scsdspgm);
						$('#scsdspgmstat').val(data.scsdspgmstat);
						$('#scsdsbrgyin').val(data.scsdsbrgyin);
						$('#scsdsbrgyinstat').val(data.scsdsbrgyinstat);
				// Scholarship Note
						$('#scs_scholarship_note').val(data.scs_scholarship_note);
				// Scholarship Details
						$('#scs_scholar_stat').val(data.scs_scholar_stat);

				$('#chedModal').modal('show');

				$('#ched_modal_title').text('Edit CHED Scholar Info');

				$('#ched_hidden_id').val(s_id);

				$('#scss_id').attr('disabled', true);

				$('#ched_action').val('edit_ched');

				$('#ched_submit_button').val('Edit');

					}

				})

			}


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

        		url:"scholars_action.php",

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

			url:"scholars_action.php",

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
		var stype = $(this).data('stype');
	// Academic View
		if(stype == 'Academic')
		{
			$.ajax({

				url:"scholars_action.php",

				method:"POST",

				data:{s_id:s_id, stype:stype, action:'acad_fetch_single'},

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
					html += '<tr><th width="40%" class="text-right">Citizenship</th><td width="60%">'+data.sctship+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.saddress+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Email Address</th><td width="60%">'+data.semail+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.scontact+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Gender</th><td width="60%">'+data.sgender+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Current Course</th><td width="60%">'+data.sccourse+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Current Year Level</th><td width="60%">'+data.scsyrlvl+'</td></tr>';
				// Family Details
					// Guardian Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Family Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-left" style="font-size:18px">Guardian Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.sgfname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.sgaddress+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.sgcontact+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.sgoccu+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.sgcompany+'</td></tr>';
					// Father Details
					html += '<tr><th width="40%" class="text-left" style="font-size:18px">Father Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.sffname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.sfaddress+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.sfcontact+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.sfoccu+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.sfcompany+'</td></tr>';
					// Mother Details
					html += '<tr><th width="40%" class="text-left" style="font-size:18px">Mother Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.smfname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.smaddress+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.smcontact+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.smoccu+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.smcompany+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Parents Combine Yearly Income</th><td width="60%">'+data.spcyincome+'</td></tr>';
				// Achievement Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Achievement Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Grade/GWA</th><td width="60%">'+data.spsgwa+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Award Received</th><td width="60%">'+data.spsraward+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Received</th><td width="60%">'+data.spsdawardrceive+'</td></tr>';
				// Requirement Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Requirement Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Receive Report Card</th><td width="60%">'+data.sdsprc+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Report Card Status</th><td width="60%">'+data.sdsprcstat+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Receive Good Moral</th><td width="60%">'+data.sdspgm+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Good Moral Status</th><td width="60%">'+data.sdspgmstat+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Receive Certificate of Recognition</th><td width="60%">'+data.sdspcr+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Certificate of Recognition Status</th><td width="60%">'+data.sdspcrstat+'</td></tr>';
				// Scholarship Note
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Note</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Note:</th><td width="60%">'+data.s_scholarship_note+'</td></tr>';
				// Scholarship Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Scholarship Type</th><td width="60%">'+data.s_scholarship_type+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Scholarship Status</th><td width="60%">'+data.s_scholar_stat+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Applied</th><td width="60%">'+data.s_applied_on+'</td></tr>';
					html += '</table></div>';

					$('#viewacadModal').modal('show');

					$('#acad_details').html(html);

				}

			})
		}
	// Non-Academic View
		if(stype == 'Non-Academic')
		{
			$.ajax({

			url:"scholars_action.php",

			method:"POST",

			data:{s_id:s_id, stype:stype, action:'nonacad_fetch_single'},

			dataType:'JSON',

			success:function(data)
			{
				var html = '<div class="table-responsive">';
				html += '<table class="table">';
			// Student ID Details
				html += '<tr><th width="40%" class="text-left" style="font-size:20px">Student ID Details</th><td width="60%"></td></tr>';
				html += '<tr><th width="40%" class="text-right">Student ID No.</th><td width="60%">'+data.sns_id+'</td></tr>';
			// Personal Details
				html += '<tr><th width="40%" class="text-left" style="font-size:20px">Personal Details</th><td width="60%"></td></tr>';
				html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.snfname+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.snmname+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.snlname+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.snnext+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Date of Birth</th><td width="60%">'+data.sndbirth+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Gender</th><td width="60%">'+data.sngender+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Citizenship</th><td width="60%">'+data.snctship+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.snaddress+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Email Address</th><td width="60%">'+data.snemail+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.sncontact+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Current Course</th><td width="60%">'+data.snccourse+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Current Year Level</th><td width="60%">'+data.sncsyrlvl+'</td></tr>';
			// Family Details
                // Guardian Details
                html += '<tr><th width="40%" class="text-left" style="font-size:20px">Family Details</th><td width="60%"></td></tr>';
                html += '<tr><th width="40%" class="text-left" style="font-size:18px">Guardian Details</th><td width="60%"></td></tr>';
                html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.sngfname+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.sngaddress+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.sngcontact+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.sngoccu+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.sngcompany+'</td></tr>';
                // Father Details
                html += '<tr><th width="40%" class="text-left" style="font-size:18px">Father Details</th><td width="60%"></td></tr>';
                html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.snffname+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.snfaddress+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.snfcontact+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.snfoccu+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.snfcompany+'</td></tr>';
                // Mother Details
                html += '<tr><th width="40%" class="text-left" style="font-size:18px">Mother Details</th><td width="60%"></td></tr>';
                html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.snmfname+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.snmaddress+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.snmcontact+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.snmoccu+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.snmcompany+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Parents Combine Yearly Income</th><td width="60%">'+data.snpcyincome+'</td></tr>';
            // Achievement Details
                html += '<tr><th width="40%" class="text-left" style="font-size:20px">Application Details</th><td width="60%"></td></tr>';
				html += '<tr><th width="40%" class="text-right">Reasons/Special Circumstances for Applying NAS</th><td width="60%">'+data.snrappnas+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Basic Office Skills</th><td width="60%">'+data.snbos+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Special Skills</th><td width="60%">'+data.snsskills+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Type of Work Interested In</th><td width="60%">'+data.sntwinterest+'</td></tr>';
            // Education Details
                html += '<tr><th width="40%" class="text-left" style="font-size:20px">Education Details</th><td width="60%"></td></tr>';
                html += '<tr><th width="40%" class="text-left" style="font-size:18px">Previous</th><td width="60%"></td></tr>';
				html += '<tr><th width="40%" class="text-right">School Attended</th><td width="60%">'+data.snpschname+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">School Address</th><td width="60%">'+data.snpsaddress+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Year/Grade Level</th><td width="60%">'+data.snpsyrlvl+'</td></tr>';
            // Requirement Details
                html += '<tr><th width="40%" class="text-left" style="font-size:20px">Requirement Details</th><td width="60%"></td></tr>';
                html += '<tr><th width="40%" class="text-right">Date Receive Report Card</th><td width="60%">'+data.sndsprc+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Report Card Status</th><td width="60%">'+data.sndsprcstat+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Date Receive Good Moral</th><td width="60%">'+data.sndspgm+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Good Moral Status</th><td width="60%">'+data.sndspgmstat+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Date Receive 2x2 ID Picture(1pc.)</th><td width="60%">'+data.sndstbytpic+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">2x2 ID Picture(1pc.) Status</th><td width="60%">'+data.sndstbytpicstat+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Date Receive Barangay Indigency</th><td width="60%">'+data.sndsbrgyin+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Barangay Indigency Status</th><td width="60%">'+data.sndsbrgyinstat+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Date Receive Student Copy Enrollment Form</th><td width="60%">'+data.sndscef+'</td></tr>';
                html += '<tr><th width="40%" class="text-right">Student Copy Enrollment Form Status</th><td width="60%">'+data.sndscefstat+'</td></tr>';
			// Scholarship Note
				html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Note</th><td width="60%"></td></tr>';
				html += '<tr><th width="40%" class="text-right">Note:</th><td width="60%">'+data.sn_scholarship_note+'</td></tr>';
            // Scholarship Details
                html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Details</th><td width="60%"></td></tr>';
				html += '<tr><th width="40%" class="text-right">Scholarship Type</th><td width="60%">'+data.sn_scholarship_type+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Scholarship Status</th><td width="60%">'+data.sn_scholar_stat+'</td></tr>';
				html += '<tr><th width="40%" class="text-right">Date Applied</th><td width="60%">'+data.sn_applied_on+'</td></tr>';
                html += '</table></div>';

				$('#viewnonacadModal').modal('show');

				$('#nonacad_details').html(html);

			}

			})
		}
	// Unifast View
		if(stype == 'UNIFAST')
		{
			$.ajax({

				url:"scholars_action.php",

				method:"POST",

				data:{s_id:s_id, stype:stype, action:'unifast_fetch_single'},

				dataType:'JSON',

				success:function(data)
				{
					var html = '<div class="table-responsive">';
					html += '<table class="table">';
				// Student ID Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Student ID Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Student ID No.</th><td width="60%">'+data.sus_id+'</td></tr>';
				// Personal Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Personal Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.susfname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.susmname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.suslname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.susnext+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Gender</th><td width="60%">'+data.susgender+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date of Birth</th><td width="60%">'+data.susdbirth+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.suscontact+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Permanent Home Address</th><td width="60%">'+data.susaddress+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Previous School Attended</th><td width="60%">'+data.suspschname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Email Address</th><td width="60%">'+data.susemail+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Previous Course/Program</th><td width="60%">'+data.suspscourse+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Previous Year Level</th><td width="60%">'+data.suspsyrlvl+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Current Course</th><td width="60%">'+data.susccourse+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Current Year Level</th><td width="60%">'+data.suscsyrlvl+'</td></tr>';
				// Family Details
					// Father Details
					html += '<tr><th width="40%" class="text-left" style="font-size:18px">Father Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Full Name</th><td width="60%">'+data.susffname+'</td></tr>';
					// Mother Details
					html += '<tr><th width="40%" class="text-left" style="font-size:18px">Mother Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Full Name</th><td width="60%">'+data.susmfname+'</td></tr>';
				// Achievement Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Other Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">DSWD Household / 4ps No.</th><td width="60%">'+data.sus4psno+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Household Capital Income</th><td width="60%">'+data.suspcyincome+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Specify Disability / Attached PWD Id</th><td width="60%">'+data.suspwdid+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Filed</th><td width="60%">'+data.sussdfile+'</td></tr>';
				// Requirement Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Requirement Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Receive Photocopy of PSA</th><td width="60%">'+data.susdspsa+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Photocopy of PSA Status</th><td width="60%">'+data.susdspsastat+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Receive 2x2 ID Picture</th><td width="60%">'+data.susdstbytpic+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">2x2 ID Picture Status</th><td width="60%">'+data.susdstbytpicstat+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Receive Brgy. Residency</th><td width="60%">'+data.susdsbrgyin+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Brgy. Residency Status</th><td width="60%">'+data.susdsbrgyinstat+'</td></tr>';
				// Scholarship Note
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Note</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Note:</th><td width="60%">'+data.sus_scholarship_note+'</td></tr>';
				// Scholarship Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Scholarship Type</th><td width="60%">'+data.sus_scholarship_type+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Scholarship Status</th><td width="60%">'+data.sus_scholar_stat+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Applied</th><td width="60%">'+data.sus_applied_on+'</td></tr>';
					html += '</table></div>';

					$('#viewunifastModal').modal('show');

					$('#unifast_details').html(html);

				}

				})
			}
	// CHED View
			if(stype == 'CHED')
			{
				$.ajax({

				url:"scholars_action.php",

				method:"POST",

				data:{s_id:s_id, stype:stype, action:'ched_fetch_single'},

				dataType:'JSON',

				success:function(data)
				{
					var html = '<div class="table-responsive">';
					html += '<table class="table">';
				// Student ID Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Student ID Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Student ID No.</th><td width="60%">'+data.scss_id+'</td></tr>';
				// Personal Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Personal Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.scsfname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.scsmname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.scslname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.scsnext+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date of Birth</th><td width="60%">'+data.scsdbirth+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Gender</th><td width="60%">'+data.scsgender+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Civil Status</th><td width="60%">'+data.scscivilstat+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Place of birth</th><td width="60%">'+data.scspbirth+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Permanent Mailing Address</th><td width="60%">'+data.scsaddress+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Zip Code</th><td width="60%">'+data.scszcode+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">School Name</th><td width="60%">'+data.scspschname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">School Address</th><td width="60%">'+data.scspsaddress+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">School Type</th><td width="60%">'+data.scspstype+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Highest Grade/Year</th><td width="60%">'+data.scspsyrlvl+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Citizenship</th><td width="60%">'+data.scsctship+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Mobile Number</th><td width="60%">'+data.scscontact+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Email</th><td width="60%">'+data.scsemail+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Type of Disability(if applicable)</th><td width="60%">'+data.scsdisability+'</td></tr>'; 
				// Family Details
					// Father Details
					html += '<tr><th width="40%" class="text-left" style="font-size:18px">Father Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Full Name</th><td width="60%">'+data.scsffname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Status</th><td width="60%">'+data.scsflstatus+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.scsfaddress+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Occupation</th><td width="60%">'+data.scsfoccu+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Educational Attainment</th><td width="60%">'+data.scsfeduc+'</td></tr>';

					// Mother Details
					html += '<tr><th width="40%" class="text-left" style="font-size:18px">Mother Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.scsmfname+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Status</th><td width="60%">'+data.scsmlstatus+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.scsmaddress+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Occupation</th><td width="60%">'+data.scsmoccu+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Educational Attainment</th><td width="60%">'+data.scsmeduc+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Total Parent Gross Income</th><td width="60%">'+data.scspcyincome+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">No. of Siblings in the family</th><td width="60%">'+data.scsnsibling+'</td></tr>';
				// Education Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Education Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">School intended to enroll in</th><td width="60%">'+data.scscsintend+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">School Address</th><td width="60%">'+data.scscsadd+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Type of School</th><td width="60%">'+data.scscschooltype+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Course</th><td width="60%">'+data.scsccourse+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Year Level</th><td width="60%">'+data.scscsyrlvl+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Course Priority/Not Priority</th><td width="60%">'+data.scsccourseprio+'</td></tr>';
				// Requirement Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Requirement Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Receive Report Card</th><td width="60%">'+data.scsdsprc+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Report Card Status</th><td width="60%">'+data.scsdsprcstat+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Receive Good Moral</th><td width="60%">'+data.scsdspgm+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Good Moral Status</th><td width="60%">'+data.scsdspgmstat+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Receive Brgy. Indigency</th><td width="60%">'+data.scsdsbrgyin+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Brgy. Indigency Status</th><td width="60%">'+data.scsdsbrgyinstat+'</td></tr>';
				// Scholarship Note
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Note</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Note:</th><td width="60%">'+data.scs_scholarship_note+'</td></tr>';
				// Scholarship Details
					html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Details</th><td width="60%"></td></tr>';
					html += '<tr><th width="40%" class="text-right">Scholarship Type</th><td width="60%">'+data.scs_scholarship_type+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Scholarship Status</th><td width="60%">'+data.scs_scholar_stat+'</td></tr>';
					html += '<tr><th width="40%" class="text-right">Date Applied</th><td width="60%">'+data.scs_applied_on+'</td></tr>';
					html += '</table></div>';

					$('#viewchedModal').modal('show');

					$('#ched_details').html(html);

				}

				})
			}
    	});

// Select All
	$('#select_all').on('click', function(){;
		$(".checkbox").prop('checked', $(this).prop("checked"));
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
                url:"scholars_action.php",
                method:"POST",
                data:{checkbox_value:checkbox_value, approve_status:approve_status, action:'approve_all'},
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
// Renewal All
	$('#renewal_all').click(function(){
        var checkbox = $('.checkbox:checked');
		var renewal_status = 'Renewal';
        if(checkbox.length > 0)
        {
            var checkbox_value = [];
            $(checkbox).each(function(){
                checkbox_value.push($(this).val());
            });

            $.ajax({
                url:"scholars_action.php",
                method:"POST",
                data:{checkbox_value:checkbox_value, renewal_status:renewal_status, action:'renewal_all'},
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
                url:"scholars_action.php",
                method:"POST",
                data:{checkbox_value:checkbox_value, reject_status:reject_status, action:'reject_all'},
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
                url:"scholars_action.php",
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