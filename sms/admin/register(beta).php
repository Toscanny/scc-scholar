<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>SMS | Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/bootstrap.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="../vendor/fontawesome-free/all.min.css"/> -->
    <link rel="stylesheet" type="text/css" href="../vendor/datepicker/bootstrap-datepicker.css"/>
    <link rel="stylesheet" type="text/css" href="../vendor/parsley/parsley.css"/>
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap-select/bootstrap-select.min.css"/>

  <style>
  .box
  {
   width:800px;
   margin:0 auto;
  }
  .active_tab1
  {
   background-color:#fff;
   color:#333; 
   font-weight: 600;
  }
  .inactive_tab1
  {
   background-color: #f5f5f5;
   color: #333;
   cursor: not-allowed;
  }
  .has-error
  {
   border-color:#cc0000;
   background-color:#ffff99;
  }
  </style>
 </head>
 <body>
 <br />
  <div class="container box">
   <br />
   <h2 align="center">Create Account</h2><br />
   <span id="message"></span>
   <form method="post" id="student_register_form">
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
            <li class="nav-item">
                <a class="nav-link inactive_tab1" id="list_account_details" style="border:1px solid #ccc">Account Details</a>
            </li>
        </ul>
<!-- Student ID Details -->
  <div class="tab-content" style="margin-top:16px;">
    <div class="tab-pane show active" id="ss_id_details">
      <div class="card">
          <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Student Details</div>
          <div class="card-body">
              <div class="form-group">
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-4">
                          <label>Student ID NO.<span class="text-danger">*</span></label>
                          <input type="text" name="vss_id" id="vss_id" class="form-control" required/>
                          <span id="error_vss_id" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-4">
                        <label>Last Name<span class="text-danger">*</span></label>
                        <input type="text" name="vslname" id="vslname" class="form-control" />
                        <span id="error_vslname" class="text-danger"></span>
                      </div>
                      <div class="col-xs-10 col-sm-12 col-md-4">
                        <label>Date of Birth<span class="text-danger">*</span></label>
                          <input type="date" name="vsdbirth" id="vsdbirth" autocomplete="off" class="form-control" />
                        <span id="error_vsdbirth" class="text-danger"></span>
                      </div>
                  </div>
              </div>
              <div class="form-group text-center">
              <a class="btn btn-primary" href="index.php" role="button">Back</a>
              <!-- <input type="hidden" name="action" value="ssid_verify" /> -->
              <input type="button" name="btn_ss_id_details" id="btn_ss_id_details" class="btn btn-success" value="Next" />
              <!-- <button type="button" name="btn_ss_id_details" id="btn_ss_id_details" class="btn btn-success btn-md">Next</button> -->
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
                    <input type="text" name="smname" id="smname" class="form-control" />
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
                    <label>Email Address<span class="text-danger">*</span></label>
                    <input type="text" name="semail" id="semail" class="form-control" />
                    <span id="error_semail" class="text-danger"></span>
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
                  <div class="col-xs-12 col-sm-12 col-md-4">
                    <label>DSWD Household/4PS NO.<span class="text-danger">*</span></label>
                    <input type="text" name="s4psno" id="s4psno" class="form-control" />
                    <span id="error_s4psno" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4">
                    <label>Type of Disability(if applicable)<span class="text-danger">*</span></label>
                    <input type="text" name="sdisability" id="sdisability" class="form-control" />
                    <span id="error_sdisability" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                    <label>PWD ID<span class="text-danger">*</span></label>
                    <input type="text" name="spwdid" id="spwdid" class="form-control" />
                    <span id="error_spwdid" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <label>Reasons/Circumtances Applying for Scholarship<span class="text-danger">*</span></label>
                    <textarea type="text" name="srappsship" id="srappsship" class="form-control" required data-parsley-trigger="keyup"></textarea>
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
                      <input type="text" name="sgmname" id="sgmname" class="form-control" />
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
                      <input type="text" name="sgoccu" id="sgoccu" class="form-control" />
                      <span id="error_sgoccu" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                      <label>Company<span class="text-danger">*</span></label>
                      <input type="text" name="sgcompany" id="sgcompany" class="form-control" />
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
                      <input type="text" name="sfmname" id="sfmname" class="form-control" />
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
                      <input type="text" name="sfoccu" id="sfoccu" class="form-control" />
                      <span id="error_sfoccu" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                      <label>Company<span class="text-danger">*</span></label>
                      <input type="text" name="sfcompany" id="sfcompany" class="form-control" />
                      <span id="error_sfcompany" class="text-danger"></span>
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
                      <input type="text" name="smmname" id="smmname" class="form-control" />
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
                      <input type="text" name="smoccu" id="smoccu" class="form-control" />
                      <span id="error_smoccu" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                      <label>Company<span class="text-danger">*</span></label>
                      <input type="text" name="smcompany" id="smcompany" class="form-control" />
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
            <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Personal Details</div>
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
                      <label>Course<span class="text-danger">*</span></label>
                      <input type="text" name="sccourse" id="sccourse" class="form-control" />
                      <span id="error_sccourse" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Course Priority<span class="text-danger">*</span></label>
                      <input type="text" name="sccourseprio" id="sccourseprio" class="form-control" />
                      <span id="error_sccourseprio" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                      <label>Year/Grade Level<span class="text-danger">*</span></label>
                      <input type="text" name="scsyrlvl" id="scsyrlvl" class="form-control" />
                      <span id="error_scsyrlvl" class="text-danger"></span>
                    </div>
                  </div>
                </div>
                <div class="form-group text-center">
                  <button type="button" name="previous_btn_education" id="previous_btn_education" class="btn btn-primary btn-md">Previous</button>
                  <button type="button" name="btn_education_details" id="btn_education_details" class="btn btn-success btn-md">Next</button>
                </div>
              </div>
          </div>
        </div>
<!-- Account Details -->
        <div class="tab-pane" id="account_details">
          <div class="card">
          <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Account Details</div>
            <div class="card-body">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="saemail" id="saemail" class="form-control" />
                <span id="error_saemail" class="text-danger"></span>
              </div>
              <div class="form-group">
              <label>Password</label>
              <input type="text" name="spass" id="spass" class="form-control" />
              <span id="error_spass" class="text-danger"></span>
              </div>
              <div class="form-group text-center">
              <button type="button" name="previous_btn_account" id="previous_btn_account" class="btn btn-primary btn-md">Previous</button>
              <input type="hidden" name="action" value="student_register" />
              <input type="submit" name="btn_submit" id="btn_submit" class="btn btn-success" value="Register" />
              </div>
            </div>
            </div>
     </div>
    </div>
   </form>
  </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <script type="text/javascript" src="../vendor/parsley/dist/parsley.min.js"></script>

</body>
</html>
<script>
// Student Details
    $(document).ready(function(){

  // sid 
    $('#btn_ss_id_details').click(function(){
      

        var error_vss_id = '';
        var error_vslname = '';
        var error_vsdbirth = '';

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

        if($.trim($('#vslname').val()).length == 0)
        {
          error_vslname = 'Last Name is required';
        $('#error_vslname').text(error_vslname);
        $('#vslname').addClass('has-error');
        }
        else
        {
          error_vslname = '';
        $('#error_vslname').text(error_vslname);
        $('#vslname').removeClass('has-error');
        }

        if($.trim($('#vsdbirth').val()).length == 0)
        {
          error_vsdbirth = 'Date of Birth is required';
        $('#error_vsdbirth').text(error_vsdbirth);
        $('#vsdbirth').addClass('has-error');
        }
        else
        {
          error_vsdbirth = '';
        $('#error_vsdbirth').text(error_vsdbirth);
        $('#vsdbirth').removeClass('has-error');
        }

        if(error_vss_id != '' || 
        error_vslname != '' ||
        error_vsdbirth != ''
        )
      {
        return false
      }
      // else{
        var vss_id = $('#vss_id').val();
        var vslname = $('#vslname').val();
        var vsdbirth = $('#vsdbirth').val();

        $.ajax({
              url:"register_action.php",
              method:"POST",
              data:{'vss_id':vss_id, 'vslname':vslname, 'vsdbirth':vsdbirth, action:'ssid_verify'},
              dataType:'json',
              beforeSend:function(){
                $('#btn_ss_id_details').attr('disabled', 'disabled');
              },
              success:function(data)
              {
                $('#btn_ss_id_details').attr('disabled', false);
                // $('#verify_sid_form')[0].reset();
                if(data.error !== '')
                {
                    $('#message').html(data.error);
                    //For wait 2 seconds
                    setTimeout(function() 
                    {
                    location.reload();  //Refresh page
                    }, 1000);
                    }
                if(data.success != '')
                {
                  $('#message').html(data.success);
                  
                  $('#list_ss_id_details').removeClass('active active_tab1');
                  $('#list_ss_id_details').removeAttr('href data-toggle');
                  $('#ss_id_details').removeClass('active');
                  $('#list_ss_id_details').addClass('inactive_tab1');
                  $('#list_personal_details').removeClass('inactive_tab1');
                  $('#list_personal_details').addClass('active_tab1 active');
                  $('#list_personal_details').attr('href', '#personal_details');
                  $('#list_personal_details').attr('data-toggle', 'tab');
                  $('#personal_details').addClass('active in');

                  // var s_id = $(this).data('s_id');
                  var vss_id = $('#vss_id').val();
                  // var slname = $('#slname').val();
                  // var sdbirth = $('#sdbirth').val();

                  $.ajax({

                    url:"register_action.php",

                    method:"POST",

                    data:{'vss_id':vss_id, action:'fetch_single'},

                    dataType:'JSON',

                    success:function(data)
                    {
                   
                      $('#vss_id').val(data.vss_id);
                      $('#sfname').val(data.sfname);
                      $('#smname').val(data.smname);
                      $('#slname').val(data.slname);
                      $('#snext').val(data.snext);
                      $('#sdbirth').val(data.sdbirth);
                      $('#sgender').val(data.sgender);
                      $('#saddress').val(data.saddress);
                      $('#szcode').val(data.szcode);
                      $('#scontact').val(data.scontact);
                      $('#semail').val(data.semail);
                      $('#sctship').val(data.sctship);
                      $('#scivilstat').val(data.scivilstat);
                      $('#sdisability').val(data.sdisability);
                      $('#s4psno').val(data.s4psno);
                      $('#spwdid').val(data.spwdid);
                      $('#srappsship').val(data.srappsship);
                      $('#sgfname').val(data.sgfname);
                      $('#sgmname').val(data.sgmname);
                      $('#sglname').val(data.sglname);
                      $('#sgnext').val(data.sgnext);
                      $('#sglstatus').val(data.sglstatus);
                      $('#sgeduc').val(data.sgeduc);
                      $('#sgcontact').val(data.sgcontact);
                      $('#sgaddress').val(data.sgaddress);
                      $('#sgoccu').val(data.sgoccu);
                      $('#sgcompany').val(data.sgcompany);
                      $('#sffname').val(data.sffname);
                      $('#sfmname').val(data.sfmname);
                      $('#sflname').val(data.sflname);
                      $('#sfnext').val(data.sfnext);
                      $('#sflstatus').val(data.sflstatus);
                      $('#sfeduc').val(data.sfeduc);
                      $('#sfcontact').val(data.sfcontact);
                      $('#sfaddress').val(data.sfaddress);
                      $('#sfoccu').val(data.sfoccu);
                      $('#sfcompany').val(data.sfcompany);
                      $('#smfname').val(data.smfname);
                      $('#smmname').val(data.smmname);
                      $('#smlname').val(data.smlname);
                      $('#smnext').val(data.smnext);
                      $('#smlstatus').val(data.smlstatus);
                      $('#smeduc').val(data.smeduc);
                      $('#smcontact').val(data.smcontact);
                      $('#smaddress').val(data.smaddress);
                      $('#smoccu').val(data.smoccu);
                      $('#smcompany').val(data.smcompany);
                      $('#snsibling').val(data.snsibling);
                      $('#spcyincome').val(data.spcyincome);
                      $('#spschname').val(data.spschname);
                      $('#spsaddress').val(data.spsaddress);
                      $('#spstype').val(data.spstype);
                      $('#spscourse').val(data.spscourse);
                      $('#spsyrlvl').val(data.spsyrlvl);
                      $('#scsintend').val(data.scsintend);
                      $('#scsadd').val(data.scsadd);
                      $('#scschooltype').val(data.scschooltype);
                      $('#sccourse').val(data.sccourse);
                      $('#sccourseprio').val(data.sccourseprio);
                      $('#scsyrlvl').val(data.scsyrlvl);

                    }

                  })
                }
              }
            });
      // }
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
      var error_semail = '';
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
      || error_scontact != '' || error_semail != '' 
      || error_sctship != '' || error_scivilstat != '' 
      || error_sdisability != '' || error_s4psno != ''
      || error_spwdid != '' || error_srappsship != ''
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
    $('#btn_education_details').click(function(){
      
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
        $('#list_education_details').removeClass('active active_tab1');
        $('#list_education_details').removeAttr('href data-toggle');
        $('#education_details').removeClass('active');
        $('#list_education_details').addClass('inactive_tab1');
        $('#list_account_details').removeClass('inactive_tab1');
        $('#list_account_details').addClass('active_tab1 active');
        $('#list_account_details').attr('href', '#account_details');
        $('#list_account_details').attr('data-toggle', 'tab');
        $('#account_details').addClass('active in');  
      }
    });

    $('#previous_btn_account').click(function(){
      $('#list_account_details').removeClass('active active_tab1');
      $('#list_account_details').removeAttr('href data-toggle');
      $('#account_details').removeClass('active in');
      $('#list_account_details').addClass('inactive_tab1');
      $('#list_education_details').removeClass('inactive_tab1');
      $('#list_education_details').addClass('active_tab1 active');
      $('#list_education_details').attr('href', '#education_details');
      $('#list_education_details').attr('data-toggle', 'tab');
      $('#education_details').addClass('active in');
    });
// Account Details
    $('#btn_submit').click(function(){
      
      var error_saemail = '';
      var error_spass = '';
      
      if($.trim($('#saemail').val()).length == 0)
      {
      error_saemail = 'Email is required';
      $('#error_saemail').text(error_saemail);
      $('#saemail').addClass('has-error');
      }
      else
      {
      error_saemail = '';
      $('#error_saemail').text(error_saemail);
      $('#saemail').removeClass('has-error');
      }
      
      if($.trim($('#spass').val()).length == 0)
      {
      error_spass = 'Password is required';
      $('#error_spass').text(error_spass);
      $('#spass').addClass('has-error');
      }
      else
      {
      error_spass = '';
      $('#error_spass').text(error_spass);
      $('#spass').removeClass('has-error');
      }

      if( error_saemail != '' ||
        error_spass != '')
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
              url:"register_action.php",
              method:"POST",
              data:$(this).serialize(),
              dataType:'json',
              beforeSend:function(){
                $('#btn_submit').attr('disabled', 'disabled');
              },
              success:function(data)
              {
                $('#btn_submit').attr('disabled', false);
                $('#student_register_form')[0].reset();
                //For wait 2 seconds
                setTimeout(function() 
                {
                  location.reload();  //Refresh page
                }, 2000);
                if(data.error !== '')
                {
                  $('#message').html(data.error);
                }
                if(data.success != '')
                {
                  $('#message').html(data.success);
                }
              }
            });
          }

        });
      }
    });
  });           
</script>
