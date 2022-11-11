<?php

include('../class/dbcon.php');

$object = new sms;

if(!$object->is_login())
{
    header("location:".$object->base_url."");
}

if($_SESSION['type'] != 'Student')
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

    

<!-- Header -->
    <form method="post" id="student_register_form">
        <div class="row justify-content-center">
            <div class="col-md-10">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Student Details Management</h1> 
            <div class="form-group">
              <div class="row">
                  <div class="col-xs-12 col-sm-12">
                    <label class="sinfo-lbl">Scholarship Status:</label>
                    <input class="scholar-info" type="text" name="s_scholar_stat" id="s_scholar_stat"/> 
                  </div>
              </div>
            </div>
              <span id="message"></span>
              <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active_tab1" id="list_ss_id_details" style="border:1px solid #ccc">Student ID Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">Personal Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_family_details" style="border:1px solid #ccc">Family Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_education_details" style="border:1px solid #ccc">Education Details</a>
                </li>
              </ul>
<!-- Student ID Details -->
  <div class="tab-content" style="margin-top:16px;">
    <div class="tab-pane show active" id="ss_id_details">
      <div class="card">
          <div class="card-header" style="font-weight: bold; font-size: 16px;">Student ID Details</div>
          <div class="card-body">
              <div class="form-group">
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                          <label>Student ID NO.<span class="text-danger">*</span></label>
                          <input type="text" name="vss_id" id="vss_id" class="form-control" disabled required />
                          <span id="error_vss_id" class="text-danger"></span>
                      </div>
                  </div>
              </div>
              <div class="form-group text-center">
              <input type="button" name="btn_ss_id_details" id="btn_ss_id_details" class="btn btn-success" value="Next" />
              </div>
          </div>
      </div>
    </div>
<!-- Personal Details -->
    <div class="tab-pane" id="personal_details">
        <div class="card">
          <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Personal Details</div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-3">
                    <label>First Name<span class="text-danger">*</span></label>
                    <input type="text" name="sfname" id="sfname" class="form-control" />
                    <span id="error_sfname" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-3">
                    <label>Middle Name<span class="text-danger">*</span></label>
                    <input type="text" name="smname" id="smname" placeholder="Put N/A if None" class="form-control" />
                    <span id="error_smname" class="text-danger"></span>
                    </div>
							    <div class="col-xs-12 col-sm-12 col-md-3">
                    <label>Last Name<span class="text-danger">*</span></label>
                    <input type="text" name="slname" id="slname" class="form-control" />
                    <span id="error_slname" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-3">
                    <label>Select Suffix</label>
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
                      <input type="date" name="sdbirth" id="sdbirth" autocomplete="off" class="form-control" />
                    <span id="error_sdbirth" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                    <label>Select Gender<span class="text-danger">*</span></label>
                    <select name="sgender" id="sgender" class="form-control" required>
                      <option value="">Select Gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    <span id="error_sgender" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <label>Address<span class="text-danger">*</span></label>
                    <textarea type="text" name="saddress" id="saddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                    <span id="error_saddress" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4">
                    <label>Zip Code<span class="text-danger">*</span></label>
                    <input type="text" name="szcode" id="szcode" class="form-control" />
                    <span id="error_szcode" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4">
                    <label>Contact Number<span class="text-danger">*</span></label>
                    <input type="text" name="scontact" id="scontact" class="form-control" />
                    <span id="error_scontact" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4">
                    <label>Citizenship<span class="text-danger">*</span></label>
                    <input type="text" name="sctship" id="sctship" class="form-control" />
                    <span id="error_sctship" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4">
                    <label>Select Civil Status<span class="text-danger">*</span></label>
                    <select name="scivilstat" id="scivilstat" class="form-control" required>
                      <option value="">Select Status</option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                    </select>
                    <span id="error_scivilstat" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                    <label>DSWD Household/4PS NO.<span class="text-danger">*</span></label>
                    <input type="text" name="s4psno" id="s4psno" placeholder="Put N/A if None" class="form-control" />
                    <span id="error_s4psno" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4">
                    <label>Type of Disability(if applicable)<span class="text-danger">*</span></label>
                    <input type="text" name="sdisability" id="sdisability" placeholder="Put N/A if None" class="form-control" />
                    <span id="error_sdisability" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                    <label>PWD ID<span class="text-danger">*</span></label>
                    <input type="text" name="spwdid" id="spwdid" placeholder="Put N/A if None" class="form-control" />
                    <span id="error_spwdid" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <label>Reasons/Circumtances Applying for Scholarship<span class="text-danger">*</span></label>
                    <textarea type="text" name="srappsship" id="srappsship" placeholder="Put N/A if None" class="form-control" required data-parsley-trigger="keyup"></textarea>
                    <span id="error_srappsship" class="text-danger"></span>
                  </div>
                </div>
              </div>
              <div class="form-group text-center">
                <button type="button" name="previous_btn_personal" id="previous_btn_personal" class="btn btn-primary btn-md">Previous</button>
                <button type="button" name="btn_personal_details" id="btn_personal_details" class="btn btn-success btn-md">Next</button>
              </div>
            </div>
        </div>
      </div>
<!-- Family Details -->
      <div class="tab-pane" id="family_details">
        <div class="card">
        <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Family Details</div>
          <div class="card-body">
            <div class="form-group">
                  <h4 class="sub-title">Guardian Details</h4>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>First Name<span class="text-danger">*</span></label>
                      <input type="text" name="sgfname" id="sgfname" class="form-control" />
                      <span id="error_sgfname" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>Middle Name<span class="text-danger">*</span></label>
                      <input type="text" name="sgmname" id="sgmname" placeholder="Put N/A if None" class="form-control" />
                      <span id="error_sgmname" class="text-danger"></span>
                      </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>Last Name<span class="text-danger">*</span></label>
                      <input type="text" name="sglname" id="sglname" class="form-control" />
                      <span id="error_sglname" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>Select Suffix</label>
                      <select name="sgnext" id="sgnext" class="form-control" required>
                      <option value="">-Select-</option>
                      <option value="N/A">N/A</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                      </select>
                      <span id="error_sgnext" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Select Life Status</label>
                      <select name="sglstatus" id="sglstatus" class="form-control" required>
                      <option value="">-Select-</option>
                      <option value="N/A">N/A</option>
                        <option value="Living">Living</option>
                        <option value="Deceased">Deceased</option>
                      </select>
                      <span id="error_sglstatus" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Educational Attainment<span class="text-danger">*</span></label>
                      <input type="text" name="sgeduc" id="sgeduc" class="form-control" />
                      <span id="error_sgeduc" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Contact Number<span class="text-danger">*</span></label>
                      <input type="text" name="sgcontact" id="sgcontact" class="form-control" />
                      <span id="error_sgcontact" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <label>Address<span class="text-danger">*</span></label>
                      <textarea type="text" name="sgaddress" id="sgaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                      <span id="error_sgaddress" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Occupation<span class="text-danger">*</span></label>
                      <input type="text" name="sgoccu" id="sgoccu" placeholder="Put N/A if None" class="form-control" />
                      <span id="error_sgoccu" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                      <label>Company<span class="text-danger">*</span></label>
                      <input type="text" name="sgcompany" id="sgcompany" placeholder="Put N/A if None" class="form-control" />
                      <span id="error_sgcompany" class="text-danger"></span>
                    </div>
                </div>
              </div>
              <div class="form-group">
                  <h4 class="sub-title">Father Details</h4>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>First Name<span class="text-danger">*</span></label>
                      <input type="text" name="sffname" id="sffname" class="form-control" />
                      <span id="error_sffname" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>Middle Name<span class="text-danger">*</span></label>
                      <input type="text" name="sfmname" id="sfmname" placeholder="Put N/A if None" class="form-control" />
                      <span id="error_sfmname" class="text-danger"></span>
                      </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>Last Name<span class="text-danger">*</span></label>
                      <input type="text" name="sflname" id="sflname" class="form-control" />
                      <span id="error_sflname" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>Select Suffix</label>
                      <select name="sfnext" id="sfnext" class="form-control" required>
                      <option value="">-Select-</option>
                      <option value="N/A">N/A</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                      </select>
                      <span id="error_sfnext" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Select Life Status</label>
                      <select name="sflstatus" id="sflstatus" class="form-control" required>
                      <option value="">-Select-</option>
                      <option value="N/A">N/A</option>
                        <option value="Living">Living</option>
                        <option value="Deceased">Deceased</option>
                      </select>
                      <span id="error_sflstatus" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Educational Attainment<span class="text-danger">*</span></label>
                      <input type="text" name="sfeduc" id="sfeduc" class="form-control" />
                      <span id="error_sfeduc" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Contact Number<span class="text-danger">*</span></label>
                      <input type="text" name="sfcontact" id="sfcontact" class="form-control" />
                      <span id="error_sfcontact" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <label>Address<span class="text-danger">*</span></label>
                      <textarea type="text" name="sfaddress" id="sfaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                      <span id="error_sfaddress" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Occupation<span class="text-danger">*</span></label>
                      <input type="text" name="sfoccu" id="sfoccu" placeholder="Put N/A if None" class="form-control" />
                      <span id="error_sfoccu" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                      <label>Company<span class="text-danger">*</span></label>
                      <input type="text" name="sfcompany" id="sfcompany" class="form-control" />
                      <span id="error_sfcompany" placeholder="Put N/A if None" class="text-danger"></span>
                    </div>
                </div>
              </div>
              <div class="form-group">
                  <h4 class="sub-title">Mother Details</h4>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>First Name<span class="text-danger">*</span></label>
                      <input type="text" name="smfname" id="smfname" class="form-control" />
                      <span id="error_smfname" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>Middle Name<span class="text-danger">*</span></label>
                      <input type="text" name="smmname" id="smmname" placeholder="Put N/A if None" class="form-control" />
                      <span id="error_smmname" class="text-danger"></span>
                      </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>Last Name<span class="text-danger">*</span></label>
                      <input type="text" name="smlname" id="smlname" class="form-control" />
                      <span id="error_smlname" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>Select Suffix</label>
                      <select name="smnext" id="smnext" class="form-control" required>
                      <option value="">-Select-</option>
                      <option value="N/A">N/A</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                      </select>
                      <span id="error_smnext" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Select Life Status</label>
                      <select name="smlstatus" id="smlstatus" class="form-control" required>
                      <option value="">-Select-</option>
                      <option value="N/A">N/A</option>
                        <option value="Living">Living</option>
                        <option value="Deceased">Deceased</option>
                      </select>
                      <span id="error_smlstatus" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Educational Attainment<span class="text-danger">*</span></label>
                      <input type="text" name="smeduc" id="smeduc" class="form-control" />
                      <span id="error_smeduc" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Contact Number<span class="text-danger">*</span></label>
                      <input type="text" name="smcontact" id="smcontact" class="form-control" />
                      <span id="error_smcontact" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <label>Address<span class="text-danger">*</span></label>
                      <textarea type="text" name="smaddress" id="smaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                      <span id="error_smaddress" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Occupation<span class="text-danger">*</span></label>
                      <input type="text" name="smoccu" id="smoccu" placeholder="Put N/A if None" class="form-control" />
                      <span id="error_smoccu" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                      <label>Company<span class="text-danger">*</span></label>
                      <input type="text" name="smcompany" id="smcompany" placeholder="Put N/A if None" class="form-control" />
                      <span id="error_smcompany" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>No. of Siblings in the family<span class="text-danger">*</span></label>
                      <input type="text" name="snsibling" id="snsibling" class="form-control" />
                      <span id="error_snsibling" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                      <label>Parents Combine Yearly Income<span class="text-danger">*</span></label>
                      <input type="text" name="spcyincome" id="spcyincome" class="form-control" />
                      <span id="error_spcyincome" class="text-danger"></span>
                    </div>
                </div>
              </div>
              <div class="form-group text-center">
                <button type="button" name="previous_btn_family_details" id="previous_btn_family_details" class="btn btn-primary btn-md">Previous</button>
                <button type="button" name="btn_family_details" id="btn_family_details" class="btn btn-success btn-md">Next</button>
              </div>
          </div>
        </div>
      </div>
<!-- Education Details -->
    <div class="tab-pane" id="education_details">
          <div class="card">
            <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Education Details</div>
              <div class="card-body">
                <div class="form-group">
                  <h4 class="sub-title">Previous</h4>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <label>School Attended<span class="text-danger">*</span></label>
                      <textarea type="text" name="spschname" id="spschname" class="form-control" required data-parsley-trigger="keyup"></textarea>
                      <span id="error_spschname" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <label>School Address<span class="text-danger">*</span></label>
                      <textarea type="text" name="spsaddress" id="spsaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                      <span id="error_spsaddress" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4"> 
                      <label>School Type<span class="text-danger">*</span></label>
                      <select name="spstype" id="spstype" class="form-control" required>
                        <option value="">Select School Type</option>
                        <option value="Public">Public</option>
                        <option value="Private">Private</option>
                      </select>
                      <span id="error_spstype" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Course<span class="text-danger">*</span></label>
                      <input type="text" name="spscourse" id="spscourse" class="form-control" />
                      <span id="error_spscourse" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Year/Grade Level<span class="text-danger">*</span></label>
                      <input type="text" name="spsyrlvl" id="spsyrlvl" class="form-control" />
                      <span id="error_spsyrlvl" class="text-danger"></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <h4 class="sub-title">Current</h4>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <label>School Intended to enroll In<span class="text-danger">*</span></label>
                      <textarea type="text" name="scsintend" id="scsintend" class="form-control" required data-parsley-trigger="keyup"></textarea>
                      <span id="error_scsintend" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <label>School Address<span class="text-danger">*</span></label>
                      <textarea type="text" name="scsadd" id="scsadd" class="form-control" required data-parsley-trigger="keyup"></textarea>
                      <span id="error_scsadd" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>School Type<span class="text-danger">*</span></label>
                      <select name="scschooltype" id="scschooltype" class="form-control" required>
                        <option value="">Select School Type</option>
                        <option value="Public">Public</option>
                        <option value="Private">Private</option>
                      </select>
                      <span id="error_scschooltype" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
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
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Course Priority<span class="text-danger">*</span></label>
                      <select name="sccourseprio" id="sccourseprio" class="form-control" required>
                        <option value="">Select </option>
                        <option value="Priority">Piority</option>
                        <option value="Not Priority">Not Priority</option>
                      </select>
                      <span id="error_sccourseprio" class="text-danger"></span>
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
                <div class="form-group text-center">
                    <button type="button" name="previous_btn_education" id="previous_btn_education" class="btn btn-primary btn-md">Previous</button>
                    <input type="hidden" name="action" value="student_register" />
                    <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-success">Submit</button>
                </div>
              </div>
          </div>
        </div>
        </div>
        </div>
    </div>
    </form>
    <?php
        include('footer.php');
    ?>
<!-- Script -->
    <script>
    // Student Fetch Details
        $(document).ready(function(){

        <?php
        foreach($result as $row)
        {
        ?>

        // Personal Details
            $('#vss_id').val("<?php echo $row['ss_id']; ?>");
            $('#sfname').val("<?php echo $row['sfname']; ?>");
            $('#smname').val("<?php echo $row['smname']; ?>");
            $('#slname').val("<?php echo $row['slname']; ?>");
            $('#snext').val("<?php echo $row['snext']; ?>");
            $('#sdbirth').val("<?php echo $row['sdbirth']; ?>");
            $('#sgender').val("<?php echo $row['sgender']; ?>");
            $('#saddress').val("<?php echo $row['saddress']; ?>");
            $('#szcode').val("<?php echo $row['szcode']; ?>");
            $('#scontact').val("<?php echo $row['scontact']; ?>");
            // $('#semail').val("<?php echo $row['semail']; ?>");
            $('#sctship').val("<?php echo $row['sctship']; ?>");
            $('#scivilstat').val("<?php echo $row['scivilstat']; ?>");
            $('#sdisability').val("<?php echo $row['sdisability']; ?>");
            $('#s4psno').val("<?php echo $row['s4psno']; ?>");
            $('#spwdid').val("<?php echo $row['spwdid']; ?>");
            $('#srappsship').val("<?php echo $row['srappsship']; ?>");
        // Family Details
            $('#sgfname').val("<?php echo $row['sgfname']; ?>");
            $('#sgmname').val("<?php echo $row['sgmname']; ?>");
            $('#sglname').val("<?php echo $row['sglname']; ?>");
            $('#sgnext').val("<?php echo $row['sgnext']; ?>");
            $('#sglstatus').val("<?php echo $row['sglstatus']; ?>");
            $('#sgeduc').val("<?php echo $row['sgeduc']; ?>");
            $('#sgcontact').val("<?php echo $row['sgcontact']; ?>");
            $('#sgaddress').val("<?php echo $row['sgaddress']; ?>");
            $('#sgoccu').val("<?php echo $row['sgoccu']; ?>");
            $('#sgcompany').val("<?php echo $row['sgcompany']; ?>");
            $('#sffname').val("<?php echo $row['sffname']; ?>");
            $('#sfmname').val("<?php echo $row['sfmname']; ?>");
            $('#sflname').val("<?php echo $row['sflname']; ?>");
            $('#sfnext').val("<?php echo $row['sfnext']; ?>");
            $('#sflstatus').val("<?php echo $row['sflstatus']; ?>");
            $('#sfeduc').val("<?php echo $row['sfeduc']; ?>");
            $('#sfcontact').val("<?php echo $row['sfcontact']; ?>");
            $('#sfaddress').val("<?php echo $row['sfaddress']; ?>");
            $('#sfoccu').val("<?php echo $row['sfoccu']; ?>");
            $('#sfcompany').val("<?php echo $row['sfcompany']; ?>");
            $('#smfname').val("<?php echo $row['smfname']; ?>");
            $('#smmname').val("<?php echo $row['smmname']; ?>");
            $('#smlname').val("<?php echo $row['smlname']; ?>");
            $('#smnext').val("<?php echo $row['smnext']; ?>");
            $('#smlstatus').val("<?php echo $row['smlstatus']; ?>");
            $('#smeduc').val("<?php echo $row['smeduc']; ?>");
            $('#smcontact').val("<?php echo $row['smcontact']; ?>");
            $('#smaddress').val("<?php echo $row['smaddress']; ?>");
            $('#smoccu').val("<?php echo $row['smoccu']; ?>");
            $('#smcompany').val("<?php echo $row['smcompany']; ?>");
            $('#snsibling').val("<?php echo $row['snsibling']; ?>");
            $('#spcyincome').val("<?php echo $row['spcyincome']; ?>");
        // Education Details
            // Current
            $('#spschname').val("<?php echo $row['spschname']; ?>");
            $('#spsaddress').val("<?php echo $row['spsaddress']; ?>");
            $('#spstype').val("<?php echo $row['spstype']; ?>");
            $('#spscourse').val("<?php echo $row['spscourse']; ?>");
            $('#spsyrlvl').val("<?php echo $row['spsyrlvl']; ?>");
            $('#scsintend').val("<?php echo $row['scsintend']; ?>");
            // Previous
            $('#scsadd').val("<?php echo $row['scsadd']; ?>");
            $('#scschooltype').val("<?php echo $row['scschooltype']; ?>");
            $('#sccourse').val("<?php echo $row['sccourse']; ?>");
            $('#sccourseprio').val("<?php echo $row['sccourseprio']; ?>");
            $('#scsyrlvl').val("<?php echo $row['scsyrlvl']; ?>");

        // Student Scholarship Status
            $('#s_scholarship_type').val("<?php echo $row['s_scholarship_type']; ?>");
            $('#s_grant_stat').val("<?php echo $row['s_grant_stat']; ?>");
            $('#s_scholar_stat').val("<?php echo $row['s_scholar_stat']; ?>");
            <?php
            }
            ?>


    // sid 
        $('#btn_ss_id_details').click(function(){
        

            var error_vss_id = '';

            if($.trim($('#vss_id').val()).length == 0)
            {
            error_vss_id = 'Student ID No. is required';
            $('#error_vss_id').text(error_vss_id);
            $('#vss_id').addClass('has-error');
            }
            else
            {
            error_vss_id = '';
            $('#error_vss_id').text(error_vss_id);
            $('#vss_id').removeClass('has-error');
            }

            if(error_vss_id != '')
            {
                return false
            }
            else{
            
                $('#list_ss_id_details').removeClass('active active_tab1');
                $('#list_ss_id_details').removeAttr('href data-toggle');
                $('#ss_id_details').removeClass('active');
                $('#list_ss_id_details').addClass('inactive_tab1');
                $('#list_personal_details').removeClass('inactive_tab1');
                $('#list_personal_details').addClass('active_tab1 active');
                $('#list_personal_details').attr('href', '#personal_details');
                $('#list_personal_details').attr('data-toggle', 'tab');
                $('#personal_details').addClass('active in');
            }
        });

        $('#previous_btn_personal').click(function(){
        $('#list_personal_details').removeClass('active active_tab1');
        $('#list_personal_details').removeAttr('href data-toggle');
        $('#personal_details').removeClass('active in');
        $('#list_personal_details').addClass('inactive_tab1');
        $('#list_ss_id_details').removeClass('inactive_tab1');
        $('#list_ss_id_details').addClass('active_tab1 active');
        $('#list_ss_id_details').attr('href', '#ss_id_details');
        $('#list_ss_id_details').attr('data-toggle', 'tab');
        $('#ss_id_details').addClass('active in');
        });

    // Personal Details
        $('#btn_personal_details').click(function(){
        var error_sfname = '';
        var error_smname = '';
        var error_slname = '';
        var error_snext = '';
        var error_sdbirth = '';
        var error_sgender = '';
        var error_saddress = '';
        var error_szcode = '';
        var error_scontact = '';
        var pcnumval = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        var emailval = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)(?!outlook.com)([\w-]+\.)+[\w-]{2,4})?$/;
        var error_sctship = '';
        var error_scivilstat = '';
        var error_sdisability = '';
        var error_s4psno = '';
        var error_spwdid = '';
        var error_srappsship = '';
        
        if($.trim($('#sfname').val()).length == 0)
        {
        error_sfname = 'First Name is required';
        $('#error_sfname').text(error_sfname);
        $('#sfname').addClass('has-error');
        }
        else
        {
        error_sfname = '';
        $('#error_sfname').text(error_sfname);
        $('#sfname').removeClass('has-error');
        }

        if($.trim($('#smname').val()).length == 0)
        {
        error_smname = 'Put N/A if None';
        $('#error_smname').text(error_smname);
        $('#smname').addClass('has-error');
        }
        else
        {
        error_smname = '';
        $('#error_smname').text(error_smname);
        $('#smname').removeClass('has-error');
        }
        
        if($.trim($('#slname').val()).length == 0)
        {
        error_slname = 'Last Name is required';
        $('#error_slname').text(error_slname);
        $('#slname').addClass('has-error');
        }
        else
        {
        error_slname = '';
        $('#error_slname').text(error_slname);
        $('#slname').removeClass('has-error');
        }

        //Suffix

        if($.trim($('#snext').val()).length == 0)
        {
        error_snext = 'Select N/A if None';
        $('#error_snext').text(error_snext);
        $('#snext').addClass('has-error');
        }
        else
        {
        error_snext = '';
        $('#error_snext').text(error_snext);
        $('#snext').removeClass('has-error');
        }

        if($.trim($('#sdbirth').val()).length == 0)
        {
        error_sdbirth = 'Date of Birth is required';
        $('#error_sdbirth').text(error_sdbirth);
        $('#sdbirth').addClass('has-error');
        }
        else
        {
        error_sdbirth = '';
        $('#error_sdbirth').text(error_sdbirth);
        $('#sdbirth').removeClass('has-error');
        }

        if($.trim($('#sgender').val()).length == 0)
        {
        error_sgender = 'Gender is required';
        $('#error_sgender').text(error_sgender);
        $('#sgender').addClass('has-error');
        }
        else
        {
        error_sgender = '';
        $('#error_sgender').text(error_sgender);
        $('#sgender').removeClass('has-error');
        }

        if($.trim($('#saddress').val()).length == 0)
        {
        error_saddress = 'Address is required';
        $('#error_saddress').text(error_saddress);
        $('#saddress').addClass('has-error');
        }
        else
        {
        error_saddress = '';
        $('#error_saddress').text(error_saddress);
        $('#saddress').removeClass('has-error');
        }

        if($.trim($('#semail').val()).length == 0)
        {
        error_semail = 'Email is required';
        $('#error_semail').text(error_semail);
        $('#semail').addClass('has-error');
        }
        else
        {
        //     if(emailval.test($('#semail').val()))
        //    {
        //     error_semail = 'Invalid Email Only(gmail, hotmail, outlook or yahoo is allowed).';
        //     $('#error_semail').text(error_semail);
        //     $('#semail').addClass('has-error');
        //    }
        //    else {
        error_semail = '';
        $('#error_semail').text(error_semail);
        $('#semail').removeClass('has-error');
        }
        //   }

        if($.trim($('#scontact').val()).length == 0)
        {
        error_scontact = 'Contact Number is required';
        $('#error_scontact').text(error_scontact);
        $('#scontact').addClass('has-error');
        }
        else
        {
        //    if (!pcnumval.test($('#scontact').val()))
        //    {
        //     error_scontact = 'Invalid Contact Number';
        //     $('#error_scontact').text(error_scontact);
        //     $('#scontact').addClass('has-error');
        //    }
        //    else
        //    {
            error_scontact = '';
            $('#error_scontact').text(error_scontact);
            $('#scontact').removeClass('has-error');
        //    }
        }

        if($.trim($('#szcode').val()).length == 0)
        {
        error_szcode = 'Zip Code is required';
        $('#error_szcode').text(error_szcode);
        $('#szcode').addClass('has-error');
        }
        else
        {
        error_szcode = '';
        $('#error_szcode').text(error_szcode);
        $('#szcode').removeClass('has-error');
        }

        if($.trim($('#sctship').val()).length == 0)
        {
        error_sctship = 'Citizenship is required';
        $('#error_sctship').text(error_sctship);
        $('#sctship').addClass('has-error');
        }
        else
        {
        error_sctship = '';
        $('#error_sctship').text(error_sctship);
        $('#sctship').removeClass('has-error');
        }

        if($.trim($('#scivilstat').val()).length == 0)
        {
        error_scivilstat = 'Civil Status is required';
        $('#error_scivilstat').text(error_scivilstat);
        $('#scivilstat').addClass('has-error');
        }
        else
        {
        error_scivilstat = '';
        $('#error_scivilstat').text(error_scivilstat);
        $('#scivilstat').removeClass('has-error');
        }

        if($.trim($('#s4psno').val()).length == 0)
        {
        error_s4psno = 'Put N/A if None';
        $('#error_s4psno').text(error_s4psno);
        $('#s4psno').addClass('has-error');
        }
        else
        {
        error_s4psno = '';
        $('#error_s4psno').text(error_s4psno);
        $('#s4psno').removeClass('has-error');
        }

        if($.trim($('#sdisability').val()).length == 0)
        {
        error_sdisability = 'Put N/A if None';
        $('#error_sdisability').text(error_sdisability);
        $('#sdisability').addClass('has-error');
        }
        else
        {
        error_sdisability = '';
        $('#error_sdisability').text(error_sdisability);
        $('#sdisability').removeClass('has-error');
        }

        if($.trim($('#spwdid').val()).length == 0)
        {
        error_spwdid = 'Put N/A if None';
        $('#error_spwdid').text(error_spwdid);
        $('#spwdid').addClass('has-error');
        }
        else
        {
        error_spwdid = '';
        $('#error_spwdid').text(error_spwdid);
        $('#spwdid').removeClass('has-error');
        }

        if($.trim($('#srappsship').val()).length == 0)
        {
        error_srappsship = 'Put N/A if None';
        $('#error_srappsship').text(error_srappsship);
        $('#srappsship').addClass('has-error');
        }
        else
        {
        error_srappsship = '';
        $('#error_srappsship').text(error_srappsship);
        $('#srappsship').removeClass('has-error');
        }

        if(error_sfname != '' || error_smname != '' 
        || error_slname != '' || error_snext != ''
        || error_sdbirth != '' || error_sgender != ''
        || error_saddress != '' || error_szcode != ''
        || error_scontact != ''  || error_sctship != '' 
        || error_scivilstat != '' || error_sdisability != '' 
        || error_s4psno != ''|| error_spwdid != '' 
        || error_srappsship != ''
        )
        {
        return false;
        }
        else
        {
        $("#saemail").val($("#semail").val()); 
        $('#list_personal_details').removeClass('active active_tab1');
        $('#list_personal_details').removeAttr('href data-toggle');
        $('#personal_details').removeClass('active');
        $('#list_personal_details').addClass('inactive_tab1');
        $('#list_family_details').removeClass('inactive_tab1');
        $('#list_family_details').addClass('active_tab1 active');
        $('#list_family_details').attr('href', '#family_details');
        $('#list_family_details').attr('data-toggle', 'tab');
        $('#family_details').addClass('active in');
        }
        });
    
        $('#previous_btn_family_details').click(function(){
        $('#list_family_details').removeClass('active active_tab1');
        $('#list_family_details').removeAttr('href data-toggle');
        $('#family_details').removeClass('active in');
        $('#list_family_details').addClass('inactive_tab1');
        $('#list_personal_details').removeClass('inactive_tab1');
        $('#list_personal_details').addClass('active_tab1 active');
        $('#list_personal_details').attr('href', '#personal_details');
        $('#list_personal_details').attr('data-toggle', 'tab');
        $('#personal_details').addClass('active in');
        });
    

    // Family Details
        $('#btn_family_details').click(function(){
        var error_sgfname = '';
        var error_sgmname = '';
        var error_sglname = '';
        var error_sgnext = '';
        var error_sglstatus = '';
        var error_sgeduc = '';
        var error_sgcontact = '';
        var error_sgaddress = '';
        var error_sgoccu = '';
        var error_sgcompany = '';
        var error_sffname = '';
        var error_sfmname = '';
        var error_sflname = '';
        var error_sfnext = '';
        var error_sflstatus = '';
        var error_sfeduc = '';
        var error_sfcontact = '';
        var error_sfaddress = '';
        var error_sfoccu = '';
        var error_sfcompany = '';
        var error_smfname = '';
        var error_smmname = '';
        var error_smlname = '';
        var error_smnext = '';
        var error_smlstatus = '';
        var error_smeduc = '';
        var error_smcontact = '';
        var error_smaddress = '';
        var error_smoccu = '';
        var error_smcompany = '';
        var error_snsibling = '';
        var error_spcyincome = '';
    // Guardian
        // Complete Name
        if($.trim($('#sgfname').val()).length == 0)
        {
        error_sgfname = 'First Name is required';
        $('#error_sgfname').text(error_sgfname);
        $('#sgfname').addClass('has-error');
        }
        else
        {
        error_sgfname = '';
        $('#error_sgfname').text(error_sgfname);
        $('#sgfname').removeClass('has-error');
        }

        if($.trim($('#sgmname').val()).length == 0)
        {
        error_sgmname = 'Put N/A if None';
        $('#error_sgmname').text(error_sgmname);
        $('#sgmname').addClass('has-error');
        }
        else
        {
        error_sgmname = '';
        $('#error_sgmname').text(error_sgmname);
        $('#sgmname').removeClass('has-error');
        }

        if($.trim($('#sglname').val()).length == 0)
        {
        error_sglname = 'Last Name is required';
        $('#error_sglname').text(error_sglname);
        $('#sglname').addClass('has-error');
        }
        else
        {
        error_sglname = '';
        $('#error_sglname').text(error_sglname);
        $('#sglname').removeClass('has-error');
        }

        //Guardian Suffix
        if($.trim($('#sgnext').val()).length == 0)
        {
        error_sgnext = 'Select N/A if none';
        $('#error_sgnext').text(error_sgnext);
        $('#sgnext').addClass('has-error');
        }
        else
        {
        error_sgnext = '';
        $('#error_sgnext').text(error_sgnext);
        $('#sgnext').removeClass('has-error');
        }

        //Life Status 
        if($.trim($('#sglstatus').val()).length == 0)
        {
        error_sglstatus = 'Life Status is required';
        $('#error_sglstatus').text(error_sglstatus);
        $('#sglstatus').addClass('has-error');
        }
        else
        {
            error_sglstatus = '';
        $('#error_sglstatus').text(error_sglstatus);
        $('#sglstatus').removeClass('has-error');
        }

        //Educational Attainment
        if($.trim($('#sgeduc').val()).length == 0)
        {
        error_sgeduc = 'Put N/A if none';
        $('#error_sgeduc').text(error_sgeduc);
        $('#sgeduc').addClass('has-error');
        }
        else
        {
            error_sgeduc = '';
        $('#error_sgeduc').text(error_sgeduc);
        $('#sgeduc').removeClass('has-error');
        }

        // Guardian Contact
        if($.trim($('#sgcontact').val()).length == 0)
        {
        error_sgcontact = 'Contact Number is required';
        $('#error_sgcontact').text(error_sgcontact);
        $('#sgcontact').addClass('has-error');
        }
        else
        {
        //    if (!pcnumval.test($('#sgcontact').val()))
        //    {
        //     error_sgcontact = 'Invalid Contact Number';
        //     $('#error_sgcontact').text(error_sgcontact);
        //     $('#sgcontact').addClass('has-error');
        //    }
        //    else
        //    {
            error_sgcontact = '';
            $('#error_sgcontact').text(error_sgcontact);
            $('#sgcontact').removeClass('has-error');
        //    }
        }

        // Guardian Address
        if($.trim($('#sgaddress').val()).length == 0)
        {
        error_sgaddress = 'Address is required';
        $('#error_sgaddress').text(error_sgaddress);
        $('#sgaddress').addClass('has-error');
        }
        else
        {
        error_sgaddress = '';
        $('#error_sgaddress').text(error_sgaddress);
        $('#sgaddress').removeClass('has-error');
        }

        // Occupation
        if($.trim($('#sgoccu').val()).length == 0)
        {
        error_sgoccu = 'Put N/A if None';
        $('#error_sgoccu').text(error_sgoccu);
        $('#sgoccu').addClass('has-error');
        }
        else
        {
        error_sgoccu = '';
        $('#error_sgoccu').text(error_sgoccu);
        $('#sgoccu').removeClass('has-error');
        }

        // Company
        if($.trim($('#sgcompany').val()).length == 0)
        {
        error_sgcompany = 'Put N/A if None';
        $('#error_sgcompany').text(error_sgcompany);
        $('#sgcompany').addClass('has-error');
        }
        else
        {
        error_sgcompany = '';
        $('#error_sgcompany').text(error_sgcompany);
        $('#sgcompany').removeClass('has-error');
        }
    // Father
        // Complete Name
        if($.trim($('#sffname').val()).length == 0)
        {
        error_sffname = 'First Name is required';
        $('#error_sffname').text(error_sffname);
        $('#sffname').addClass('has-error');
        }
        else
        {
        error_sffname = '';
        $('#error_sffname').text(error_sffname);
        $('#sffname').removeClass('has-error');
        }

        if($.trim($('#sfmname').val()).length == 0)
        {
        error_sfmname = 'Put N/A if None';
        $('#error_sfmname').text(error_sfmname);
        $('#sfmname').addClass('has-error');
        }
        else
        {
        error_sfmname = '';
        $('#error_sfmname').text(error_sfmname);
        $('#sfmname').removeClass('has-error');
        }

        if($.trim($('#sflname').val()).length == 0)
        {
        error_sflname = 'Last Name is required';
        $('#error_sflname').text(error_sflname);
        $('#sflname').addClass('has-error');
        }
        else
        {
        error_sflname = '';
        $('#error_sflname').text(error_sflname);
        $('#sflname').removeClass('has-error');
        }

        //Father Suffix
        if($.trim($('#sfnext').val()).length == 0)
        {
        error_sfnext = 'Select N/A if none';
        $('#error_sfnext').text(error_sfnext);
        $('#sfnext').addClass('has-error');
        }
        else
        {
        error_sfnext = '';
        $('#error_sfnext').text(error_sfnext);
        $('#sfnext').removeClass('has-error');
        }

        //Life Status 
        if($.trim($('#sflstatus').val()).length == 0)
        {
        error_sflstatus = 'Life Status is required';
        $('#error_sflstatus').text(error_sflstatus);
        $('#sflstatus').addClass('has-error');
        }
        else
        {
            error_sflstatus = '';
        $('#error_sflstatus').text(error_sflstatus);
        $('#sflstatus').removeClass('has-error');
        }

        //Educational Attainment
        if($.trim($('#sfeduc').val()).length == 0)
        {
        error_sfeduc = 'Put N/A if none';
        $('#error_sfeduc').text(error_sfeduc);
        $('#sfeduc').addClass('has-error');
        }
        else
        {
            error_sfeduc = '';
        $('#error_sfeduc').text(error_sfeduc);
        $('#sfeduc').removeClass('has-error');
        }

        // Contact
        if($.trim($('#sfcontact').val()).length == 0)
        {
        error_sfcontact = 'Contact Number is required';
        $('#error_sfcontact').text(error_sfcontact);
        $('#sfcontact').addClass('has-error');
        }
        else
        {
        //    if (!pcnumval.test($('#scontact').val()))
        //    {
        //     error_scontact = 'Invalid Contact Number';
        //     $('#error_scontact').text(error_scontact);
        //     $('#scontact').addClass('has-error');
        //    }
        //    else
        //    {
            error_sfcontact = '';
            $('#error_sfcontact').text(error_sfcontact);
            $('#sfcontact').removeClass('has-error');
        //    }
        }

        // Address
        if($.trim($('#sfaddress').val()).length == 0)
        {
        error_sfaddress = 'Address is required';
        $('#error_sfaddress').text(error_sfaddress);
        $('#sfaddress').addClass('has-error');
        }
        else
        {
        error_sfaddress = '';
        $('#error_sfaddress').text(error_sfaddress);
        $('#sfaddress').removeClass('has-error');
        }

        // Occupation
        if($.trim($('#sfoccu').val()).length == 0)
        {
        error_sfoccu = 'Put N/A if None';
        $('#error_sfoccu').text(error_sfoccu);
        $('#sfoccu').addClass('has-error');
        }
        else
        {
        error_sfoccu = '';
        $('#error_sfoccu').text(error_sfoccu);
        $('#sfoccu').removeClass('has-error');
        }

        // Company
        if($.trim($('#sfcompany').val()).length == 0)
        {
        error_sfcompany = 'Put N/A if None';
        $('#error_sfcompany').text(error_sfcompany);
        $('#sfcompany').addClass('has-error');
        }
        else
        {
        error_sfcompany = '';
        $('#error_sfcompany').text(error_sfcompany);
        $('#sfcompany').removeClass('has-error');
        }
        
    // Mother
        // Complete Name
        if($.trim($('#smfname').val()).length == 0)
        {
        error_smfname = 'First Name is required';
        $('#error_smfname').text(error_smfname);
        $('#smfname').addClass('has-error');
        }
        else
        {
        error_smfname = '';
        $('#error_smfname').text(error_smfname);
        $('#smfname').removeClass('has-error');
        }

        if($.trim($('#smmname').val()).length == 0)
        {
        error_smmname = 'Put N/A if None';
        $('#error_smmname').text(error_smmname);
        $('#smmname').addClass('has-error');
        }
        else
        {
        error_smmname = '';
        $('#error_smmname').text(error_smmname);
        $('#smmname').removeClass('has-error');
        }

        if($.trim($('#smlname').val()).length == 0)
        {
        error_smlname = 'Last Name is required';
        $('#error_smlname').text(error_smlname);
        $('#smlname').addClass('has-error');
        }
        else
        {
        error_smlname = '';
        $('#error_smlname').text(error_smlname);
        $('#smlname').removeClass('has-error');
        }

        //Mother Suffix
        if($.trim($('#smnext').val()).length == 0)
        {
        error_smnext = 'Select N/A if none';
        $('#error_smnext').text(error_smnext);
        $('#smnext').addClass('has-error');
        }
        else
        {
        error_smnext = '';
        $('#error_smnext').text(error_smnext);
        $('#smnext').removeClass('has-error');
        }

        //Life Status 
        if($.trim($('#smlstatus').val()).length == 0)
        {
        error_smlstatus = 'Life Status is required';
        $('#error_smlstatus').text(error_smlstatus);
        $('#smlstatus').addClass('has-error');
        }
        else
        {
            error_smlstatus = '';
        $('#error_smlstatus').text(error_smlstatus);
        $('#smlstatus').removeClass('has-error');
        }

        //Educational Attainment
        if($.trim($('#smeduc').val()).length == 0)
        {
        error_smeduc = 'Put N/A if none';
        $('#error_smeduc').text(error_smeduc);
        $('#smeduc').addClass('has-error');
        }
        else
        {
            error_smeduc = '';
        $('#error_smeduc').text(error_smeduc);
        $('#smeduc').removeClass('has-error');
        }

        // Contact Number
        if($.trim($('#smcontact').val()).length == 0)
        {
        error_smcontact = 'Contact Number is required';
        $('#error_smcontact').text(error_smcontact);
        $('#smcontact').addClass('has-error');
        }
        else
        {
        //    if (!pcnumval.test($('#scontact').val()))
        //    {
        //     error_scontact = 'Invalid Contact Number';
        //     $('#error_scontact').text(error_scontact);
        //     $('#scontact').addClass('has-error');
        //    }
        //    else
        //    {
            error_smcontact = '';
            $('#error_smcontact').text(error_smcontact);
            $('#smcontact').removeClass('has-error');
        //    }
        }

        // Address
        if($.trim($('#smaddress').val()).length == 0)
        {
        error_smaddress = 'Address is required';
        $('#error_smaddress').text(error_smaddress);
        $('#smaddress').addClass('has-error');
        }
        else
        {
        error_smaddress = '';
        $('#error_smaddress').text(error_smaddress);
        $('#smaddress').removeClass('has-error');
        }

        // Occupation
        if($.trim($('#smoccu').val()).length == 0)
        {
        error_smoccu = 'Put N/A if None';
        $('#error_smoccu').text(error_smoccu);
        $('#smoccu').addClass('has-error');
        }
        else
        {
        error_smoccu = '';
        $('#error_smoccu').text(error_smoccu);
        $('#smoccu').removeClass('has-error');
        } 

        // Company
        if($.trim($('#smcompany').val()).length == 0)
        {
        error_smcompany = 'Put N/A if None';
        $('#error_smcompany').text(error_smcompany);
        $('#smcompany').addClass('has-error');
        }
        else
        {
        error_smcompany = '';
        $('#error_smcompany').text(error_smcompany);
        $('#smcompany').removeClass('has-error');
        } 

        // No. of Siblings
        if($.trim($('#snsibling').val()).length == 0)
        {
            error_snsibling = 'Put N/A if None';
        $('#error_snsibling').text(error_snsibling);
        $('#snsibling').addClass('has-error');
        }
        else
        {
            error_snsibling = '';
        $('#error_snsibling').text(error_snsibling);
        $('#snsibling').removeClass('has-error');
        } 

        // ParentYearlyIncome
        if($.trim($('#spcyincome').val()).length == 0)
        {
        error_spcyincome = 'Parents Yearly Income is required';
        $('#error_spcyincome').text(error_spcyincome);
        $('#spcyincome').addClass('has-error');
        }
        else
        {
        error_spcyincome = '';
        $('#error_spcyincome').text(error_spcyincome);
        $('#spcyincome').removeClass('has-error');
        } 

        if( error_sgfname != '' ||
        error_sgmname != '' ||
        error_sglname != '' ||
        error_sgnext != '' ||
        error_sglstatus != '' ||
        error_sgeduc != '' ||
        error_sgcontact != '' ||
        error_sgaddress != '' ||
        error_sgoccu != '' ||
        error_sgcompany != '' ||
        error_sffname != '' ||
        error_sfmname != '' ||
        error_sflname != '' ||
        error_sfnext != '' ||
        error_sflstatus != '' ||
        error_sfeduc != '' ||
        error_sfcontact != '' ||
        error_sfaddress != '' ||
        error_sfoccu != '' ||
        error_sfcompany != '' ||
        error_smfname != '' ||
        error_smmname != '' ||
        error_smlname != '' ||
        error_smnext != '' ||
        error_smlstatus != '' ||
        error_smeduc != '' ||
        error_smcontact != '' ||
        error_smaddress != '' ||
        error_smoccu != '' ||
        error_smcompany != '' ||
        error_snsibling != '' ||
        error_spcyincome != '')
        {
        return false;
        }
        else
        {
            $('#list_family_details').removeClass('active active_tab1');
            $('#list_family_details').removeAttr('href data-toggle');
            $('#family_details').removeClass('active');
            $('#list_family_details').addClass('inactive_tab1');
            $('#list_education_details').removeClass('inactive_tab1');
            $('#list_education_details').addClass('active_tab1 active');
            $('#list_education_details').attr('href', '#education_details');
            $('#list_education_details').attr('data-toggle', 'tab');
            $('#education_details').addClass('active in');   
        }
        });

        $('#previous_btn_education').click(function(){
        $('#list_education_details').removeClass('active active_tab1');
        $('#list_education_details').removeAttr('href data-toggle');
        $('#education_details').removeClass('active in');
        $('#list_education_details').addClass('inactive_tab1');
        $('#list_family_details').removeClass('inactive_tab1');
        $('#list_family_details').addClass('active_tab1 active');
        $('#list_family_details').attr('href', '#family_details');
        $('#list_family_details').attr('data-toggle', 'tab');
        $('#family_details').addClass('active in');
        });
    // Education Details
      $('#btn_submit').click(function(){
          
          var error_spschname = '';
          var error_spsaddress = '';
          var error_spstype = '';
          var error_spscourse = '';
          var error_spsyrlvl = '';
          var error_scsintend = '';
          var error_scsadd = '';
          var error_scschooltype = '';
          var error_sccourse = '';
          var error_sccourseprio = '';
          var error_scsyrlvl = '';

          if($.trim($('#spschname').val()).length == 0)
          {
          error_spschname = 'School Name is required';
          $('#error_spschname').text(error_spschname);
          $('#spschname').addClass('has-error');
          }
          else
          {
          error_spschname = '';
          $('#error_spschname').text(error_spschname);
          $('#spschname').removeClass('has-error');
          }
          
          if($.trim($('#spsaddress').val()).length == 0)
          {
          error_spsaddress = 'School Address is required';
          $('#error_spsaddress').text(error_spsaddress);
          $('#spsaddress').addClass('has-error');
          }
          else
          {
          error_spsaddress = '';
          $('#error_spsaddress').text(error_spsaddress);
          $('#spsaddress').removeClass('has-error');
          }

          if($.trim($('#spstype').val()).length == 0)
          {
          error_spstype = 'School Type is required';
          $('#error_spstype').text(error_spstype);
          $('#spstype').addClass('has-error');
          }
          else
          {
          error_spstype = '';
          $('#error_spstype').text(error_spstype);
          $('#spstype').removeClass('has-error');
          }

          if($.trim($('#spscourse').val()).length == 0)
          {
          error_spscourse = 'School Course is required';
          $('#error_spscourse').text(error_spscourse);
          $('#spscourse').addClass('has-error');
          }
          else
          {
          error_spscourse = '';
          $('#error_spscourse').text(error_spscourse);
          $('#spscourse').removeClass('has-error');
          }

          if($.trim($('#spsyrlvl').val()).length == 0)
          {
          error_spsyrlvl = 'Year/Grade Level is required';
          $('#error_spsyrlvl').text(error_spsyrlvl);
          $('#spsyrlvl').addClass('has-error');
          }
          else
          {
          error_spsyrlvl = '';
          $('#error_spsyrlvl').text(error_spsyrlvl);
          $('#spsyrlvl').removeClass('has-error');
          }

          if($.trim($('#scsintend').val()).length == 0)
          {
          error_scsintend = 'School Intended to Enroll is required';
          $('#error_scsintend').text(error_scsintend);
          $('#scsintend').addClass('has-error');
          }
          else
          {
          error_scsintend = '';
          $('#error_scsintend').text(error_scsintend);
          $('#scsintend').removeClass('has-error');
          }

          if($.trim($('#scsadd').val()).length == 0)
          {
          error_scsadd = 'School Address is required';
          $('#error_scsadd').text(error_scsadd);
          $('#scsadd').addClass('has-error');
          }
          else
          {
          error_scsadd = '';
          $('#error_scsadd').text(error_scsadd);
          $('#scsadd').removeClass('has-error');
          }

          if($.trim($('#scschooltype').val()).length == 0)
          {
          error_scschooltype = 'School Type is required';
          $('#error_scschooltype').text(error_scschooltype);
          $('#scschooltype').addClass('has-error');
          }
          else
          {
          error_scschooltype = '';
          $('#error_scschooltype').text(error_scschooltype);
          $('#scschooltype').removeClass('has-error');
          }

          if($.trim($('#sccourse').val()).length == 0)
          {
          error_sccourse = 'School Course is required';
          $('#error_sccourse').text(error_sccourse);
          $('#sccourse').addClass('has-error');
          }
          else
          {
          error_sccourse = '';
          $('#error_sccourse').text(error_sccourse);
          $('#sccourse').removeClass('has-error');
          }

          if($.trim($('#sccourseprio').val()).length == 0)
          {
          error_sccourseprio = 'Course Priority is required';
          $('#error_sccourseprio').text(error_sccourseprio);
          $('#sccourseprio').addClass('has-error');
          }
          else
          {
          error_sccourseprio = '';
          $('#error_sccourseprio').text(error_sccourseprio);
          $('#sccourseprio').removeClass('has-error');
          }

          if($.trim($('#scsyrlvl').val()).length == 0)
          {
          error_scsyrlvl = ' Year/Grade Level is required';
          $('#error_scsyrlvl').text(error_scsyrlvl);
          $('#scsyrlvl').addClass('has-error');
          }
          else
          {
          error_scsyrlvl = '';
          $('#error_scsyrlvl').text(error_scsyrlvl);
          $('#scsyrlvl').removeClass('has-error');
          }

          if(error_spschname != '' ||
          error_spsaddress != '' ||
          error_spstype != '' ||
          error_spscourse != '' ||
          error_spsyrlvl != '' ||
          error_scsintend != '' ||
          error_scsadd != '' ||
          error_scschooltype != '' ||
          error_sccourse != '' ||
          error_sccourseprio != '' ||
          error_scsyrlvl != '' )
          {
          return false;
          }
          else
          {  
              $('#student_register_form').parsley();
          
              $('#student_register_form').on('submit', function(event){
              event.preventDefault();
              if($('#student_register_form').parsley().isValid())
              {
                  $.ajax({
                  url:"student_dashboard_action.php",
                  method:"POST",
                  data:$(this).serialize(),
                  dataType:'json',
                  beforeSend:function(){
                      $('#btn_submit').attr('disabled', 'disabled');
                  },
                  success:function(data)
                  {
                      $('#btn_submit').attr('disabled', false);
                      // $('#student_register_form')[0].reset();
                      //For wait 2 seconds
                      if(data.success != '')
                      {
                      $('#message').html(data.success);
                      setTimeout(function() 
                      {
                      location.reload();  //Refresh page
                      }, 2000);
                      }
                  }
                  });
              }

              });
          }
          });
    });           
    </script>
