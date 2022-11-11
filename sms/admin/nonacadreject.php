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
<h1 class="h3 mb-4 text-gray-800">Non-Academic Rejected Grantees Management</h1>

<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col">
                <h6 class="m-0 font-weight-bold text-primary">Applicant List</h6>
            </div>
            <div class="col" align="right">
                <button type="button" name="add_nonacad" id="add_nonacad" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></button>
                <button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-times"></i></button>
                <button type="button" name="approve_all" id="approve_all" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-thumbs-up"></i></button>
                <button type="button" name="reject_all" id="reject_all" class="btn btn-warning btn-circle btn-sm"><i class="fas fa-thumbs-down"></i></button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="nonacad_table" width="100%" cellspacing="0">
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
<div id="nonacadModal" class="modal fade">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form method="post" id="nonacad_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">Add Non-Academic Scholar</h4>
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
                                <label for="snfname">First Name<span class="text-danger">*</span></label>
                                <input type="text" name="snfname" id="snfname" class="form-control" required/>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Middle Name<span class="text-danger">*</span></label>
                                <input type="text" name="snmname" id="snmname" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_snmname" class="text-danger"></span>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Last Name<span class="text-danger">*</span></label>
                                <input type="text" name="snlname" id="snlname" class="form-control" required/>
                                <span id="error_snlname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Select Suffix<span class="text-danger">*</span></label>
                                <select name="snnext" id="snnext" class="form-control" required>
                                <option value="">-Select-</option>
                                <option value="N/A">N/A</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                </select>
                                <span id="error_snnext" class="text-danger"></span>
                            </div>
                            <div class="col-xs-10 col-sm-12 col-md-4">
                                <label>Date of Birth<span class="text-danger">*</span></label>
                                <input type="date" name="sndbirth" id="sndbirth" autocomplete="off" class="form-control" required>
                                <span id="error_sndbirth" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Select Gender<span class="text-danger">*</span></label>
                                <select name="sngender" id="sngender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                </select>
                                <span id="error_sngender" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Citizenship<span class="text-danger">*</span></label>
                                <input type="text" name="snctship" id="snctship" class="form-control" required/>
                                <span id="error_snctship" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label>Address<span class="text-danger">*</span></label>
                                <textarea type="text" name="snaddress" id="snaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                <span id="error_snaddress" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-5">
                                <label>Email Address<span class="text-danger">*</span></label>
                                <input type="text" name="snpemail" id="snpemail" class="form-control" required/>
                                <span id="error_snpemail" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
                                <label>Contact Number<span class="text-danger">*</span></label>
                                <input type="text" name="sncontact" id="sncontact" class="form-control" required/>
                                <span id="error_sncontact" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-5">
                                <label>Course<span class="text-danger">*</span></label>
                                <input type="text" name="sncourse" id="sncourse" class="form-control" required/>
                                <span id="error_sncourse" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-5 offset-md-2">
                                <label>Grade/Year Level<span class="text-danger">*</span></label>
                                <input type="text" name="snyrlvl" id="snyrlvl" class="form-control" required/>
                                <span id="error_snyrlvl" class="text-danger"></span>
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
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>First Name<span class="text-danger">*</span></label>
                                <input type="text" name="sngfname" id="sngfname" class="form-control" required/>
                                <span id="error_sngfname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Middle Name<span class="text-danger">*</span></label>
                                <input type="text" name="sngmname" id="sngmname" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_sngmname" class="text-danger"></span>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Last Name<span class="text-danger">*</span></label>
                                <input type="text" name="snglname" id="snglname" class="form-control" required/>
                                <span id="error_snglname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Select Suffix<span class="text-danger">*</span></label>
                                <select name="sngnext" id="sngnext" class="form-control" required>
                                <option value="">-Select-</option>
                                <option value="N/A">N/A</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                </select>
                                <span id="error_sngnext" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label>Address<span class="text-danger">*</span></label>
                                <textarea type="text" name="sngaddress" id="sngaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                <span id="error_sngaddress" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Contact Number<span class="text-danger">*</span></label>
                                <input type="text" name="sngcontact" id="sngcontact" class="form-control" required/>
                                <span id="error_sngcontact" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Occupation<span class="text-danger">*</span></label>
                                <input type="text" name="sngoccu" id="sngoccu" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_sngoccu" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Company<span class="text-danger">*</span></label>
                                <input type="text" name="sngcompany" id="sngcompany" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_sngcompany" class="text-danger"></span>
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <h4 class="sub-title" style="font-weight: bold; font-size: 16px;">Father Details</h4>
                            <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>First Name<span class="text-danger">*</span></label>
                                <input type="text" name="snffname" id="snffname" class="form-control" required/>
                                <span id="error_snffname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Middle Name<span class="text-danger">*</span></label>
                                <input type="text" name="snfmname" id="snfmname" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_snfmname" class="text-danger"></span>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Last Name<span class="text-danger">*</span></label>
                                <input type="text" name="snflname" id="snflname" class="form-control" required/>
                                <span id="error_snflname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Select Suffix<span class="text-danger">*</span></label>
                                <select name="snfnext" id="snfnext" class="form-control" required>
                                <option value="">-Select-</option>
                                <option value="N/A">N/A</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                </select>
                                <span id="error_snfnext" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label>Address<span class="text-danger">*</span></label>
                                <textarea type="text" name="snfaddress" id="snfaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                <span id="error_snfaddress" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Contact Number<span class="text-danger">*</span></label>
                                <input type="text" name="snfcontact" id="snfcontact" class="form-control" required/>
                                <span id="error_snfcontact" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Occupation<span class="text-danger">*</span></label>
                                <input type="text" name="snfoccu" id="snfoccu" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_snfoccu" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Company<span class="text-danger">*</span></label>
                                <input type="text" name="snfcompany" id="snfcompany" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_snfcompany" class="text-danger"></span>
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <h4 class="sub-title" style="font-weight: bold; font-size: 16px;">Mother Details</h4>
                            <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>First Name<span class="text-danger">*</span></label>
                                <input type="text" name="snmfname" id="snmfname" class="form-control" required/>
                                <span id="error_snmfname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Middle Name<span class="text-danger">*</span></label>
                                <input type="text" name="snmmname" id="snmmname" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_snmmname" class="text-danger"></span>
                                </div>
                                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Last Name<span class="text-danger">*</span></label>
                                <input type="text" name="snmlname" id="snmlname" class="form-control" required/>
                                <span id="error_snmlname" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <label>Select Suffix<span class="text-danger">*</span></label>
                                <select name="snmnext" id="snmnext" class="form-control" required>
                                <option value="">-Select-</option>
                                <option value="N/A">N/A</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                </select>
                                <span id="error_snmnext" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label>Address<span class="text-danger">*</span></label>
                                <textarea type="text" name="snmaddress" id="snmaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                <span id="error_snmaddress" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Contact Number<span class="text-danger">*</span></label>
                                <input type="text" name="snmcontact" id="snmcontact" class="form-control" required/>
                                <span id="error_snmcontact" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Occupation<span class="text-danger">*</span></label>
                                <input type="text" name="snmoccu" id="snmoccu" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_snmoccu" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label>Company<span class="text-danger">*</span></label>
                                <input type="text" name="snmcompany" id="snmcompany" class="form-control" placeholder="Put N/A if none" required/>
                                <span id="error_snmcompany" class="text-danger"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                                <label>Parents Combine Yearly Income<span class="text-danger">*</span></label>
                                <input type="text" name="snspcyincome" id="snspcyincome" class="form-control" required/>
                                <span id="error_snspcyincome" class="text-danger"></span>
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
                                    <span id="error_snrappnas" class="text-danger"></span>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label>Basic Office Skills<span class="text-danger">*</span></label>
                                    <textarea type="text" name="snbos" id="snbos" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                    <span id="error_snbos" class="text-danger"></span>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label>Special Skills<span class="text-danger">*</span></label>
                                    <textarea type="text" name="snsskills" id="snsskills" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                    <span id="error_snsskills" class="text-danger"></span>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label>Type of Work Interested In<span class="text-danger">*</span></label>
                                    <textarea type="text" name="sntwinterest" id="sntwinterest" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                    <span id="error_sntwinterest" class="text-danger"></span>
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
                                    <textarea type="text" name="snpschatt" id="snpschatt" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                    <span id="error_snpschatt" class="text-danger"></span>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label>Year/Grade Level<span class="text-danger">*</span></label>
                                    <input type="text" name="snpyrlvl" id="snpyrlvl" class="form-control" required/>
                                    <span id="error_snpyrlvl" class="text-danger"></span>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <label>School Address<span class="text-danger">*</span></label>
                                    <textarea type="text" name="snpschadd" id="snpschadd" class="form-control" required data-parsley-trigger="keyup"></textarea>
                                    <span id="error_snpschadd" class="text-danger"></span>
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
                                        <input type="date" name="snasprc" id="snasprc" autocomplete="off" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Date Recv. Good Moral<span class="text-danger">*</span></label>
                                        <input type="date" name="snapgm" id="snapgm" autocomplete="off" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Date Recv. 2x2 ID Picture<span class="text-danger">*</span></label>
                                        <input type="date" name="sntbytpic" id="sntbytpic" autocomplete="off" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Select Report Card Status<span class="text-danger">*</span></label>
                                        <select name="snasprcstat" id="snasprcstat" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <option value="Received">Received</option>
                                        <option value="Not-Received">Not-Received</option>
                                        </select>
                                        <span id="error_snasprcstat" class="text-danger"></span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Select Good Moral Status<span class="text-danger">*</span></label>
                                        <select name="snapgmstat" id="snapgmstat" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <option value="Received">Received</option>
                                        <option value="Not-Received">Not-Received</option>
                                        </select>
                                        <span id="error_snapgmstat" class="text-danger"></span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Select 2x2 ID Pic. Status<span class="text-danger">*</span></label>
                                        <select name="sntbytpicstat" id="sntbytpicstat" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <option value="Received">Received</option>
                                        <option value="Not-Received">Not-Received</option>
                                        </select>
                                        <span id="error_sntbytpicstat" class="text-danger"></span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Date Recv. Brgy. Indigency<span class="text-danger">*</span></label>
                                        <input type="date" name="snpbrgyin" id="snpbrgyin" autocomplete="off" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                                        <label>Date Recv. Enrollment Form<span class="text-danger">*</span></label>
                                        <input type="date" name="snpscef" id="snpscef" autocomplete="off" class="form-control" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Select Brgy. Indigency Status<span class="text-danger">*</span></label>
                                        <select name="snpbrgyinstat" id="snpbrgyinstat" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <option value="Received">Received</option>
                                        <option value="Not-Received">Not-Received</option>
                                        </select>
                                        <span id="error_snpbrgyinstat" class="text-danger"></span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                                        <label>Select ENRL Form Status<span class="text-danger">*</span></label>
                                        <select name="snpscefstat" id="snpscefstat" class="form-control" required>
                                        <option value="">-Select-</option>
                                        <option value="Received">Received</option>
                                        <option value="Not-Received">Not-Received</option>
                                        </select>
                                        <span id="error_snpscefstat" class="text-danger"></span>
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
                                <input type="text" name="snaemail" id="snaemail" class="form-control" required/>
                                <span id="error_snaemail" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                <label>Password<span class="text-danger">*</span></label>
                                <input type="password" name="snapass" id="snapass" class="form-control" required/>
                                <span id="error_snapass" class="text-danger"></span>
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
                                    <select name="sngrantstat" id="sngrantstat" class="form-control" required>
                                    <option value="">-Select-</option>
                                    <option value="New">New</option>
                                    <option value="Old">Old</option>
                                    </select>
                                    <span id="error_sngrantstat" class="text-danger"></span>
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
<!-- Script -->
<script>
//  Validation
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();

$(document).ready(function(){
// Table Function
    var dataTable = $('#nonacad_table').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            url:"nonacadreject_action.php",
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

    // $('#sndbirth').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });
    // $('#snasprc').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });
    // $('#snapgm').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });
    // $('#sntbytpic').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });
    // $('#snpbrgyin').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });
    // $('#snpscef').datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true
    // });

// Add
$('#add_nonacad').click(function(){

    $('#nonacad_form')[0].reset();

    $('#nonacad_form').parsley().reset();

    $('#modal_title').text('Add Non-Academic Scholar');

    $('#action').val('Add');

    $('#submit_button').val('Add');

    $('#nonacadModal').modal('show');

    $('#form_message').html('');

});
// Submit
$('#nonacad_form').parsley();

$('#nonacad_form').on('submit', function(event){
    event.preventDefault();
    if($('#nonacad_form').parsley().isValid())
    {		
        $.ajax({
            url:"nonacadreject_action.php",
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

// Edit
$(document).on('click', '.edit_button', function(){

    var snacad_id = $(this).data('id');

    $('#nonacad_form')[0].reset();

    $('#nonacad_form').parsley().reset();

    $('#form_message').html('');

    $.ajax({

        url:"nonacadreject_action.php",

        method:"POST",

        data:{snacad_id:snacad_id, action:'fetch_single'},

        dataType:'JSON',

        success:function(data)
        {
// Account Details
            $('#snaemail').val(data.snaemail);
            $('#snapass').val(data.snapass);
// Personal Details
            $('#snfname').val(data.snfname);
            $('#snmname').val(data.snmname);
            $('#snlname').val(data.snlname);
            $('#snnext').val(data.snnext);
            $('#sndbirth').val(data.sndbirth);
            $('#snctship').val(data.snctship);
            $('#snaddress').val(data.snaddress);
            $('#snpemail').val(data.snpemail);
            $('#sncontact').val(data.sncontact);
            $('#sncourse').val(data.sncourse);
            $('#snyrlvl').val(data.snyrlvl);
            $('#sngender').val(data.sngender);
// Family Details
    // Guardian Details
            $('#sngfname').val(data.sngfname);
            $('#sngmname').val(data.sngmname);
            $('#snglname').val(data.snglname);
            $('#sngnext').val(data.sngnext);
            $('#sngaddress').val(data.sngaddress);
            $('#sngcontact').val(data.sngcontact);
            $('#sngoccu').val(data.sngoccu);
            $('#sngcompany').val(data.sngcompany);
    // Father Details
            $('#snffname').val(data.snffname);
            $('#snfmname').val(data.snfmname);
            $('#snflname').val(data.snflname);
            $('#snfnext').val(data.snfnext);
            $('#snfaddress').val(data.snfaddress);
            $('#snfcontact').val(data.snfcontact);
            $('#snfoccu').val(data.snfoccu);
            $('#snfcompany').val(data.snfcompany);
    // Mother Details
            $('#snmfname').val(data.snmfname);
            $('#snmmname').val(data.snmmname);
            $('#snmlname').val(data.snmlname);
            $('#snmnext').val(data.snmnext);
            $('#snmaddress').val(data.snmaddress);
            $('#snmcontact').val(data.snmcontact);
            $('#snmoccu').val(data.snmoccu);
            $('#snmcompany').val(data.snmcompany);
            $('#snspcyincome').val(data.snspcyincome);
// Application Details
            $('#snrappnas').val(data.snrappnas);
            $('#snbos').val(data.snbos);
            $('#snsskills').val(data.snsskills);
            $('#sntwinterest').val(data.sntwinterest);
// Education Details
            $('#snpschatt').val(data.snpschatt);
            $('#snpschadd').val(data.snpschadd);
            $('#snpyrlvl').val(data.snpyrlvl);
// Requirement Details
            $('#snasprc').val(data.snasprc);
            $('#snasprcstat').val(data.snasprcstat);
            $('#snapgm').val(data.snapgm);
            $('#snapgmstat').val(data.snapgmstat);
            $('#sntbytpic').val(data.sntbytpic);
            $('#sntbytpicstat').val(data.sntbytpicstat);
            $('#snpbrgyin').val(data.snpbrgyin);
            $('#snpbrgyinstat').val(data.snpbrgyinstat);
            $('#snpscef').val(data.snpscef);
            $('#snpscefstat').val(data.snpscefstat);
// Scholarship Details
            $('#snacapstype').val(data.snacapstype);
            $('#sngrantstat').val(data.sngrantstat);
            $('#snascholarstat').val(data.snascholarstat);
            $('#snadapply').val(data.snadapply);

            $('#modal_title').text('Edit Applicant Info');

            $('#action').val('Edit');

            $('#submit_button').val('Edit');

            $('#nonacadModal').modal('show');

            $('#hidden_id').val(snacad_id);

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

            url:"nonacadreject_action.php",

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

        url:"nonacadreject_action.php",

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
    var snacad_id = $(this).data('id');

    $.ajax({

        url:"nonacadreject_action.php",

        method:"POST",

        data:{snacad_id:snacad_id, action:'fetch_single'},

        dataType:'JSON',

        success:function(data)
        {
            var html = '<div class="table-responsive">';
            html += '<table class="table">';
        // Account Details
            html += '<tr><th width="40%" class="text-right" style="font-size:20px">Account Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">Email Address</th><td width="60%">'+data.snaemail+'</td></tr>';
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
            html += '<tr><th width="40%" class="text-right">Email Address</th><td width="60%">'+data.snpemail+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.sncontact+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Course</th><td width="60%">'+data.sncourse+'</td></tr>'; 
            html += '<tr><th width="40%" class="text-right">Grade/Year Level</th><td width="60%">'+data.snyrlvl+'</td></tr>';
        // Family Details
            // Guardian Details
            html += '<tr><th width="40%" class="text-left" style="font-size:20px">Family Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-left" style="font-size:18px">Guardian Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.sngfname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.sngmname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.snglname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.sngnext+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.sngaddress+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.sngcontact+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.sngoccu+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.sngcompany+'</td></tr>';
            // Father Details
            html += '<tr><th width="40%" class="text-left" style="font-size:18px">Father Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.snffname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.snfmname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.snflname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.snfnext+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.snfaddress+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.snfcontact+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.snfoccu+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.snfcompany+'</td></tr>';
            // Mother Details
            html += '<tr><th width="40%" class="text-left" style="font-size:18px">Mother Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">First Name</th><td width="60%">'+data.snmfname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Middle Name</th><td width="60%">'+data.snmmname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Last Name</th><td width="60%">'+data.snmlname+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Suffix</th><td width="60%">'+data.snmnext+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Address</th><td width="60%">'+data.snmaddress+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Contact Number</th><td width="60%">'+data.snmcontact+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Occupation/Position</th><td width="60%">'+data.snmoccu+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Company</th><td width="60%">'+data.snmcompany+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Parents Combine Yearly Income</th><td width="60%">'+data.snspcyincome+'</td></tr>';
        // Achievement Details
            html += '<tr><th width="40%" class="text-left" style="font-size:20px">Application Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">Grade/GWA</th><td width="60%">'+data.snrappnas+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Award Received</th><td width="60%">'+data.snbos+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Received</th><td width="60%">'+data.snsskills+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Received</th><td width="60%">'+data.sntwinterest+'</td></tr>';
        // Education Details
            html += '<tr><th width="40%" class="text-left" style="font-size:20px">Education Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">Grade/GWA</th><td width="60%">'+data.snpschatt+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Award Received</th><td width="60%">'+data.snpschadd+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Received</th><td width="60%">'+data.snpyrlvl+'</td></tr>';
        // Requirement Details
            html += '<tr><th width="40%" class="text-left" style="font-size:20px">Requirement Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Receive Report Card</th><td width="60%">'+data.snasprc+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Report Card Status</th><td width="60%">'+data.snasprcstat+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Receive Good Moral</th><td width="60%">'+data.snapgm+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Good Moral Status</th><td width="60%">'+data.snapgmstat+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Receive Certificate of Recognition</th><td width="60%">'+data.sntbytpic+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Certificate of Recognition Status</th><td width="60%">'+data.sntbytpicstat+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Receive Good Moral</th><td width="60%">'+data.snpbrgyin+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Good Moral Status</th><td width="60%">'+data.snpbrgyinstat+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Receive Certificate of Recognition</th><td width="60%">'+data.snpscef+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Certificate of Recognition Status</th><td width="60%">'+data.snpscefstat+'</td></tr>';
        // Scholarship Details
            html += '<tr><th width="40%" class="text-left" style="font-size:20px">Scholarship Details</th><td width="60%"></td></tr>';
            html += '<tr><th width="40%" class="text-right">Scholarship Type</th><td width="60%">'+data.snacapstype+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Grant Status</th><td width="60%">'+data.sngrantstat+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Scholarship Status</th><td width="60%">'+data.snascholarstat+'</td></tr>';
            html += '<tr><th width="40%" class="text-right">Date Applied</th><td width="60%">'+data.snadapply+'</td></tr>';
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
            url:"nonacadreject_action.php",
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
            url:"nonacadreject_action.php",
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
            url:"nonacadreject_action.php",
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