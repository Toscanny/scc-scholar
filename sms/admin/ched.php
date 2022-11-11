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
      <form method="post" id="ched_form">
          <div class="row justify-content-center"><div class="col-md-10">
            <h1 class="h3 mb-4 text-gray-800">CHED STUDENT FINANCIAL ASSISTANCE PROGRAMS(StuFAPs)<br>Application Form</h1>
            <span id="message"></span>
            <ul class="nav nav-tabs">
              <li class="nav-item">
              <a class="nav-link active_tab1" id="list_personal_details" style="border:1px solid #ccc">Personal Details</a>
              </li>
              <li class="nav-item">
              <a class="nav-link inactive_tab1" id="list_family_details" style="border:1px solid #ccc">Family Details</a>
              </li>
              <li class="nav-item">
              <a class="nav-link inactive_tab1" id="list_education_details" style="border:1px solid #ccc">Education Details</a>
              </li>
              <li class="nav-item">
              <a class="nav-link inactive_tab1" id="list_requirement_details" style="border:1px solid #ccc">Requirements Details</a>
              </li>
            </ul>
    <!-- Personal Details -->
        <div class="tab-content" style="margin-top:16px;">
          <div class="tab-pane show active" id="personal_details">
              <div class="card">
                <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Personal Details</div>
                  <div class="card-body">
                    <div class="form-group">
                      <h4 class="sub-title">Personal Details</h4>
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
                            <input type='date' name="sdbirth" id="sdbirth" class="form-control" />
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
                          <label>Civil Status<span class="text-danger">*</span></label>
                          <select name="scivilstat" id="scivilstat" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                          </select>
                          <span id="error_scivilstat" class="text-danger"></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                          <label>Place of birth<span class="text-danger">*</span></label>
                          <textarea type="text" name="spbirth" id="spbirth" class="form-control" required data-parsley-trigger="keyup"></textarea>
                          <span id="error_spbirth" class="text-danger"></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                          <label>Permanent Mailing Address<span class="text-danger">*</span></label>
                          <textarea type="text" name="saddress" id="saddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                          <span id="error_saddress" class="text-danger"></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                          <label>Zip Code<span class="text-danger">*</span></label>
                          <input type="text" name="szcode" id="szcode" class="form-control" required data-parsley-trigger="keyup" required/>
                          <span id="error_szcode" class="text-danger"></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                          <label>Citizenship<span class="text-danger">*</span></label>
                          <input type="text" name="sctship" id="sctship" class="form-control" required/>
                          <span id="error_sctship" class="text-danger"></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                          <label>Mobile Number<span class="text-danger">*</span></label>
                          <input type="text" name="scontact" id="scontact" class="form-control" required/>
                          <span id="error_scontact" class="text-danger"></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <label>Email<span class="text-danger">*</span></label>
                          <input type="text" name="semail" id="semail" disabled class="form-control" required/>
                          <span id="error_semail" class="text-danger"></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                          <label>Type of Disability(if applicable)<span class="text-danger">*</span></label>
                          <input type="text" name="sdisability" id="sdisability" placeholder="Put N/A if None" class="form-control" />
                          <span id="error_sdisability" class="text-danger"></span>
                        </div>      
                      </div>
                    </div>
                    <div class="form-group text-center">
                      <a class="btn btn-primary" href="apply.php" role="button">Back</a>
                      <button type="button" name="btn_personal_details" id="btn_personal_details" class="btn btn-success btn-md">Next</button>
                    </div>
                  </div>
              </div>
            </div>
    <!-- Family Details -->
        <div class="tab-pane" id="family_details">
                <div class="card panel-default">
                  <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Family Details</div>
                    <div class="card-body">
                    <div class="form-group">
                        <h4 class="sub-title">Father's Details</h4>
                        <div class="row" >
                          <div class="col-xs-12 col-sm-12 col-md-6">
                              <label>First Name<span class="text-danger">*</span></label>
                              <input type="text" name="sffname" id="sffname" class="form-control" required/>
                              <span id="error_sffname" class="text-danger"></span>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                              <label>Status<span class="text-danger">*</label>
                              <select name="sflstatus" id="sflstatus" class="form-control" required>
                              <option value="">-Select-</option>
                              <option value="Living">Living</option>
                              <option value="Deceased">Deceased</option>
                              </select>
                              <span id="error_sflstatus" class="text-danger"></span>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                              <label>Occupation<span class="text-danger">*</span></label>
                              <input type="text" name="sfoccu" id="sfoccu" class="form-control" required/>
                              <span id="error_sfoccu" class="text-danger"></span>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                              <label>Educational Attainment<span class="text-danger">*</span></label>
                              <input type="text" name="sfeduc" id="sfeduc" class="form-control" required/>
                              <span id="error_sfeduc" class="text-danger"></span>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12">
                              <label>Address<span class="text-danger">*</span></label>
                              <textarea type="text" name="sfaddress" id="sfaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                              <span id="pob" class="text-danger"></span>
                              <span id="error_sfaddress" class="text-danger"></span>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <h4 class="sub-title">Mother's Details</h4>
                        <div class="row" >
                          <div class="col-xs-12 col-sm-12 col-md-6">
                              <label>First Name<span class="text-danger">*</span></label>
                              <input type="text" name="smfname" id="smfname" class="form-control" required/>
                              <span id="error_smfname" class="text-danger"></span>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                              <label>Status<span class="text-danger">*</label>
                              <select name="smlstatus" id="smlstatus" class="form-control" required>
                              <option value="">-Select-</option>
                              <option value="Living">Living</option>
                              <option value="Deceased">Deceased</option>
                              </select>
                              <span id="error_smlstatus" class="text-danger"></span>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                              <label>Occupation<span class="text-danger">*</span></label>
                              <input type="text" name="smoccu" id="smoccu" class="form-control" required/>
                              <span id="error_smoccu" class="text-danger"></span>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                              <label>Educational Attainment<span class="text-danger">*</span></label>
                              <input type="text" name="smeduc" id="smeduc" class="form-control" required/>
                              <span id="error_smeduc" class="text-danger"></span>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12">
                              <label>Address<span class="text-danger">*</span></label>
                              <textarea type="text" name="smaddress" id="smaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                              <span id="error_smaddress" class="text-danger"></span>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                              <label>Total Parent Gross Income<span class="text-danger">*</span></label>
                              <input type="text" name="spcyincome" id="spcyincome" class="form-control" required/>
                              <span id="error_spcyincome" class="text-danger"></span>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-6">
                              <label>No. of Siblings in the family<span class="text-danger">*</span></label>
                              <input type="text" name="snsibling" id="snsibling" class="form-control" required/>
                              <span id="error_snsibling" class="text-danger"></span>
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
					      <h4 class="sub-title">Education Details</h4>
                <h5 class="sub-title">Previous</h5>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <label>School Name<span class="text-danger">*</span></label>
                      <textarea type="text" name="spschname" id="spschname" class="form-control" required data-parsley-trigger="keyup"></textarea>
                      <span id="error_spschname" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <label>School Address<span class="text-danger">*</span></label>
                      <textarea type="text" name="spsaddress" id="spsaddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                      <span id="error_spsaddress" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                    <label>School Type<span class="text-danger">*</span></label>
                      <select name="spstype" id="spstype" class="form-control" required>
                        <option value="">Select Type</option>
                        <option value="Private">Private</option>
                        <option value="Public">Public</option>
                      </select>
                      <span id="error_spstype" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                      <label>Highest Grade/Year<span class="text-danger">*</span></label>
                      <input type="text" name="spsyrlvl" id="spsyrlvl" class="form-control" required/>
                      <span id="error_spsyrlvl" class="text-danger"></span>
                    </div>
                </div>
              </div>
              <div class="form-group">
					      <h5 class="sub-title">Current</h5>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <label>School intended to enroll in <span class="text-danger">*</span></label>
                    <textarea type="text" name="scsintend" id="scsintend" class="form-control" required data-parsley-trigger="keyup"></textarea>
                    <span id="error_scsintend" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <label>School Address <span class="text-danger">*</span></label>
                    <textarea type="text" name="scsadd" id="scsadd" class="form-control" required data-parsley-trigger="keyup"></textarea>
                    <span id="error_scsadd" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4">
                  <label>School Type<span class="text-danger">*</span></label>
                    <select name="scschooltype" id="scschooltype" class="form-control" required>
                      <option value="">Select Type</option>
                      <option value="Private">Private</option>
                      <option value="Public">Public</option>
                    </select>
                    <span id="error_scschooltype" class="text-danger"></span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-4">
                    <label>Course<span class="text-danger">*</span></label>
                    <input type="text" name="sccourse" id="sccourse" class="form-control" />
                    <span id="error_sccourse" class="text-danger"></span>
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
                </div>
              </div>
              <div class="form-group text-center">
                <button type="button" name="previous_btn_education" id="previous_btn_education" class="btn btn-primary btn-md">Previous</button>
                <button type="button" name="btn_education" id="btn_education" class="btn btn-success btn-md">Next</button>
              </div>
            </div>
        </div>
      </div>
    <!-- Requirement Details -->
      <div class="tab-pane" id="requirement_details">
        <div class="card">
          <div class="card-header" style="font-weight: bold; font-size: 16px;">Applicant Must Be:</div>
          <div class="card-body">
            <ul class="list-group d-flex justify-content-center">
              <li class="list-group-item">1. Senior High Graduate</li>
              <li class="list-group-item">2. College Level</li>
              <li class="list-group-item">3. 4th year High shool Graduate(Old Curriculum)</li>
              <li class="list-group-item">4. ALS Passer Promoted to College</li>
              <li class="list-group-item">5. Enrolled of the said Institution</li>
            </ul>
          </div>
        </div>
        <div class="card">
        <div class="card-header" style="font-weight: bold; font-size: 16px;">List of Requirements</div>
          <div class="card-body">
            <div class="form-group">
              <ul class="list-group d-flex justify-content-center">
                <li class="list-group-item">1. Photocopy of Report Card</li>
                <li class="list-group-item">2. Photocopy of Good Moral</li>
                <li class="list-group-item">3. Original Barangay Indigency</li>
              </ul>
            </div>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault" style="font-style: italic; font-weight: normal;">
                  I agree that the requirements above are legit and will submit it on time.
                </label><br>
              </div>
              <span id="error_flexCheckDefault" class="text-danger"></span>
            </div>
            <div class="form-group">
              <div class="alert alert-warning" role="alert" style="font-style: italic;"><b>Note:</b> Please provide the hard copy of the following requirements, bring it to the sholarship Office, and hand it over to Mr Gemini Daguplo or Ms Grabrielle Heruela.</div>
            </div>
          </div>
          <div class="form-group text-center">
            <button type="button" name="previous_btn_requirement" id="previous_btn_requirement" class="btn btn-primary btn-md">Previous</button>
            <input type="hidden" name="action" value="student_ched_apply" />
            <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-success">Submit</button>
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
  <!-- script -->
    <script>
    $(document).ready(function(){
  
        <?php
        foreach($result as $row)
        {
        ?>

        // Personal Details
            $('#sfname').val("<?php echo $row['sfname']; ?>");
            $('#smname').val("<?php echo $row['smname']; ?>");
            $('#slname').val("<?php echo $row['slname']; ?>");
            $('#snext').val("<?php echo $row['snext']; ?>");
            $('#sdbirth').val("<?php echo $row['sdbirth']; ?>");
            $('#sgender').val("<?php echo $row['sgender']; ?>");
            $('#scivilstat').val("<?php echo $row['scivilstat']; ?>");
            $('#spbirth').val("<?php echo $row['spbirth']; ?>");
            $('#saddress').val("<?php echo $row['saddress']; ?>");
            $('#szcode').val("<?php echo $row['szcode']; ?>");
            $('#sctship').val("<?php echo $row['sctship']; ?>");
            $('#scontact').val("<?php echo $row['scontact']; ?>");
            $('#semail').val("<?php echo $row['semail']; ?>");
            $('#sdisability').val("<?php echo $row['sdisability']; ?>");
        // Family Details
            $('#sffname').val("<?php echo $row['sffname']; ?>");
            $('#sfmname').val("<?php echo $row['sfmname']; ?>");
            $('#sflname').val("<?php echo $row['sflname']; ?>");
            $('#sfnext').val("<?php echo $row['sfnext']; ?>");
            $('#sflstatus').val("<?php echo $row['sflstatus']; ?>");
            $('#sfoccu').val("<?php echo $row['sfoccu']; ?>");
            $('#sfeduc').val("<?php echo $row['sfeduc']; ?>");
            $('#sfaddress').val("<?php echo $row['sfaddress']; ?>");
            $('#smfname').val("<?php echo $row['smfname']; ?>");
            $('#smmname').val("<?php echo $row['smmname']; ?>");
            $('#smlname').val("<?php echo $row['smlname']; ?>");
            $('#smnext').val("<?php echo $row['smnext']; ?>");
            $('#smlstatus').val("<?php echo $row['smlstatus']; ?>");
            $('#smoccu').val("<?php echo $row['smoccu']; ?>");
            $('#smeduc').val("<?php echo $row['smeduc']; ?>");
            $('#smaddress').val("<?php echo $row['smaddress']; ?>");
            $('#spcyincome').val("<?php echo $row['spcyincome']; ?>");
            $('#snsibling').val("<?php echo $row['snsibling']; ?>");
        // Education Details
            // Current
            $('#spschname').val("<?php echo $row['spschname']; ?>");
            $('#spsaddress').val("<?php echo $row['spsaddress']; ?>");
            $('#spstype').val("<?php echo $row['spstype']; ?>");
            $('#spsyrlvl').val("<?php echo $row['spsyrlvl']; ?>");
            // Previous
            $('#scsintend').val("<?php echo $row['scsintend']; ?>");
            $('#scsadd').val("<?php echo $row['scsadd']; ?>");
            $('#scschooltype').val("<?php echo $row['scschooltype']; ?>");
            $('#sccourse').val("<?php echo $row['sccourse']; ?>");
            $('#sccourseprio').val("<?php echo $row['sccourseprio']; ?>");
            
            <?php
            }
            ?>
  // Personal Details
    $('#btn_personal_details').click(function(){
      var error_sfname = '';
      var error_smname = '';
      var error_slname= '';
      var error_snext = '';
      var error_sdbirth = '';
      var error_sgender = '';
      var error_scivilstat = '';
      var error_spbirth = '';
      var error_saddress = '';
      var error_szcode = '';
      var error_sctship = '';
      var error_scontact = '';
      var error_semail = '';
      var error_sdisability = '';
      var emailval = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)(?!outlook.com)([\w-]+\.)+[\w-]{2,4})?$/;
      var pcnumval = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
      
    //Firstname

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

      //Middlename

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

      // Lastname
      
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

      //Date of Birth
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
      
      //Gender

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

      //Civil Status
      if($.trim($('#scivilstat').val()).length == 0)
      {
      error_scivilstat = 'Civil status is required';
      $('#error_scivilstat').text(error_scivilstat);
      $('#scivilstat').addClass('has-error');
      }
      else
      {
      error_scivilstat = '';
      $('#error_scivilstat').text(error_scivilstat);
      $('#scivilstat').removeClass('has-error');
      }

      //Place of Birth

      if($.trim($('#spbirth').val()).length == 0)
      {
      error_spbirth = 'Place of birth is required';
      $('#error_spbirth').text(error_spbirth);
      $('#spbirth').addClass('has-error');
      }
      else
      {
      error_spbirth = '';
      $('#error_spbirth').text(error_spbirth);
      $('#spbirth').removeClass('has-error');
      }

    //Address

      if($.trim($('#saddress').val()).length == 0)
      {
      error_saddress = 'Mail Address is required';
      $('#error_saddress').text(error_saddress);
      $('#saddress').addClass('has-error');
      }
      else
      {

        error_saddress = '';
        $('#error_saddress').text(error_saddress);
        $('#saddress').removeClass('has-error');

      }
      //Zipcode

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

      //Citizenship
      if($.trim($('#sctship').val()).length == 0)
      {
      error_sctship= 'Citizenship is required';
      $('#error_sctship').text(error_sctship);
      $('#sctship').addClass('has-error');
      }
      else
      {
      error_sctship= '';
      $('#error_sctship').text(error_sctship);
      $('#sctship').removeClass('has-error');
      }

      //Mobile Number
      if($.trim($('#scontact').val()).length == 0)
      {
      error_scontact = 'Mobile Number is required';
      $('#error_scontact').text(error_scontact);
      $('#scontact').addClass('has-error');
      }
      else
      {
      error_scontact = '';
      $('#error_scontact').text(error_scontact);
      $('#scontact').removeClass('has-error');
      }
      //Email
      if($.trim($('#semail').val()).length == 0)
      {
      error_semail = 'Email is required';
      $('#error_semail').text(error_semail);
      $('#semail').addClass('has-error');
      }
      else
      {
      error_semail = '';
      $('#error_semail').text(error_semail);
      $('#semail').removeClass('has-error');
      }
      //Specify Disability

      if($.trim($('#sdisability').val()).length == 0)
      {
      error_sdisability = 'Put N/A if None';
      $('#error_sdisability').text(error_sdisability);
      $('#sdisability').addClass('has-error');
      }
      else
      {
      error_sdisability= '';
      $('#error_sdisability').text(error_sdisability);
      $('#sdisability').removeClass('has-error');
      }

      if(error_sfname != '' || error_smname != '' 
      || error_slname != '' || error_snext != '' 
      || error_sdbirth != '' || error_sgender != '' 
      || error_scivilstat != '' || error_spbirth != '' 
      || error_saddress != '' || error_szcode != '' 
      || error_sctship != '' || error_scontact != '' 
      || error_semail != '' || error_sdisability != '' 
      

      )
      {
      return false;
      }
      else
      {
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
      var error_sffname = '';
      var error_sflstatus = '';
      var error_sfoccu = '';
      var error_sfeduc = '';
      var error_sfaddress = '';
      var error_smfname = '';
      var error_smlstatus = '';
      var error_smoccu = '';
      var error_smeduc = '';
      var error_smaddress = '';
      var error_spcyincome = '';
      var error_snsibling = '';

      //Father's First Name
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

      //Father Status

      if($.trim($('#sflstatus').val()).length == 0)
      {
      error_sflstatus = 'Status is required';
      $('#error_sflstatus').text(error_sflstatus);
      $('#sflstatus').addClass('has-error');
      }
      else
      {
      error_sflstatus = '';
      $('#error_sflstatus').text(error_sflstatus);
      $('#sflstatus').removeClass('has-error');
      }

      //Father Address

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

      //Occupation

      if($.trim($('#sfoccu').val()).length == 0)
      {
      error_sfoccu= 'Put N/A if none';
      $('#error_sfoccu').text(error_sfoccu);
      $('#sfoccu').addClass('has-error');
      }
      else
      {
      error_sfoccu = '';
      $('#error_sfoccu').text(error_sfoccu);
      $('#sfoccu').removeClass('has-error');
      }

    //Educational Attainment

      if($.trim($('#sfeduc').val()).length == 0)
      {
      error_sfeduc = 'Educational Attainment is required';
      $('#error_sfeduc').text(error_sfeduc);
      $('#sfeduc').addClass('has-error');
      }
      else
      {
      error_sfeduc = '';
      $('#error_sfeduc').text(error_sfeduc);
      $('#sfeduc').removeClass('has-error');
      }

      //Mother's First Name
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

      //Mother Status

      if($.trim($('#smlstatus').val()).length == 0)
      {
      error_smlstatus = 'Status is required';
      $('#error_smlstatus').text(error_smlstatus);
      $('#smlstatus').addClass('has-error');
      }
      else
      {
      error_smlstatus = '';
      $('#error_smlstatus').text(error_smlstatus);
      $('#smlstatus').removeClass('has-error');
      }

      //Father Address

      if($.trim($('#smaddress').val()).length == 0)
      {
      error_smaddress= 'Address is required';
      $('#error_smaddress').text(error_smaddress);
      $('#smaddress').addClass('has-error');
      }
      else
      {
      error_smaddress = '';
      $('#error_smaddress').text(error_smaddress);
      $('#smaddress').removeClass('has-error');
      }

      //Occupation

      if($.trim($('#smoccu').val()).length == 0)
      {
      error_smoccu= 'Put N/A if none';
      $('#error_smoccu').text(error_smoccu);
      $('#smoccu').addClass('has-error');
      }
      else
      {
      error_smoccu = '';
      $('#error_smoccu').text(error_smoccu);
      $('#smoccu').removeClass('has-error');
      }

    //Educational Attainment

      if($.trim($('#smeduc').val()).length == 0)
      {
      error_smeduc = 'Educational Attainment is required';
      $('#error_smeduc').text(error_smeduc);
      $('#smeduc').addClass('has-error');
      }
      else
      {
      error_smeduc= '';
      $('#error_smeduc').text(error_smeduc);
      $('#smeduc').removeClass('has-error');
      }


      //Total Gross Income

      if($.trim($('#spcyincome').val()).length == 0)
      {
      error_spcyincome = 'Total Gross income is required';
      $('#error_spcyincome').text(error_spcyincome);
      $('#spcyincome').addClass('has-error');
      }
      else
      {
      error_spcyincome = '';
      $('#error_spcyincome').text(error_spcyincome);
      $('#spcyincome').removeClass('has-error');
      }

      //Total Siblings in the Family

      if($.trim($('#snsibling').val()).length == 0)
      {
      error_snsibling = 'Total Sibling is required';
      $('#error_snsibling').text(error_snsibling);
      $('#snsibling').addClass('has-error');
      }
      else
      {
      error_snsibling= '';
      $('#error_snsibling').text(error_snsibling);
      $('#snsibling').removeClass('has-error');
      }

      if(error_sffname != '' ||
      error_sflstatus != '' ||
      error_sfoccu != '' ||
      error_sfeduc != '' ||
      error_sfaddress != '' ||
      error_smfname != '' ||
      error_smlstatus != '' ||
      error_smoccu != '' ||
      error_smeduc != '' ||
      error_smaddress != '' ||
      error_spcyincome != '' ||
      error_snsibling != '' )
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
        $('#list_education_details').attr('href', '#application_details');
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
      $('#list_family_details').attr('href', '#application_details');
      $('#list_family_details').attr('data-toggle', 'tab');
      $('#family_details').addClass('active in');
    });

  // Education Details
    $('#btn_education').click(function(){
    
    var error_spschname = '';
    var error_spsaddress = '' ;
    var error_scschooltype = '';
    var error_spstype = '';
    var error_spsyrlvl = '';
    var error_scsintend = '';
    var error_scsadd = '' ;
    var error_scschooltype = '';
    var error_sccourse= '';
    var error_sccourseprio= '';

    // Previous
      //School Name
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

      //School Address
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

      //School Type
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

      //Grade or Year
      if($.trim($('#spsyrlvl').val()).length == 0)
      {
      error_spsyrlvl = 'Grade/Year is required';
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
      $('#error_scsintend').text(error_scsintend );
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
      $('#error_scsadd').text(error_scsadd );
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
      error_sccourse = 'Course is required';
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
      error_sccourseprio = 'Course Priority required';
      $('#error_sccourseprio').text(error_sccourseprio);
      $('#sccourseprio').addClass('has-error');
      }
      else
      {
      error_sccourseprio = '';
      $('#error_sccourseprio').text(error_sccourseprio);
      $('#sccourseprio').removeClass('has-error');
      }

      if(error_spschname != '' || 
        error_spsaddress != '' ||
        error_spstype != '' ||
        error_spsyrlvl != '' ||
        error_scsintend != '' || 
        error_scsadd != '' ||
        error_scschooltype != '' ||
        error_sccourse != '' ||
        error_sccourseprio != '' 
        )
      {
      return false;
      }
      else
      {
        $('#list_education_details').removeClass('active active_tab1');
        $('#list_education_details').removeAttr('href data-toggle');
        $('#education_details').removeClass('active');
        $('#list_education_details').addClass('inactive_tab1');
        $('#list_requirement_details').removeClass('inactive_tab1');
        $('#list_requirement_details').addClass('active_tab1 active');
        $('#list_requirement_details').attr('href', '#requirement_details');
        $('#list_requirement_details').attr('data-toggle', 'tab');
        $('#requirement_details').addClass('active in');    
      }
    });

    $('#previous_btn_requirement').click(function(){
      $('#list_requirement_details').removeClass('active active_tab1');
      $('#list_requirement_details').removeAttr('href data-toggle');
      $('#requirement_details').removeClass('active in');
      $('#list_requirement_details').addClass('inactive_tab1');
      $('#list_education_details').removeClass('inactive_tab1');
      $('#list_education_details').addClass('active_tab1 active');
      $('#list_education_details').attr('href', '#education_details');
      $('#list_education_details').attr('data-toggle', 'tab');
      $('#education_details').addClass('active in');
    });

  // Requirement Details
    $('#btn_submit').click(function(){
      
      var error_flexCheckDefault = '';

      if($('#flexCheckDefault').not(':checked').length){
        error_flexCheckDefault = 'Checkbox is required';
        $('#error_flexCheckDefault').text(error_flexCheckDefault);
        $('#flexCheckDefault').addClass('has-error');
      } 
      else{
        error_flexCheckDefault = '';
        $('#error_flexCheckDefault').text(error_flexCheckDefault);
        $('#flexCheckDefault').removeClass('has-error');
      }

      if(error_flexCheckDefault != '')
      {
      return false;
      }
      else
      {
        $('#ched_form').parsley();

        $('#ched_form').on('submit', function(event){
        event.preventDefault();
        if($('#ched_form').parsley().isValid())
        {
            $.ajax({
            url:"ched_action.php",
            method:"POST",
            data:$(this).serialize(),
            dataType:'json',
            beforeSend:function(){
                $('#btn_submit').attr('disabled', 'disabled');
            },
            success:function(data)
            {
                $('#btn_submit').attr('disabled', false);
                // $('#ched_form')[0].reset();
                //For wait 3 seconds
                if(data.error !== '')
                {
                  $('#message').html(data.error);
                  setTimeout(function() 
                  {
                  location.reload();  //Refresh page
                  }, 5000);
                }

                if(data.success != '')
                {
                  $('#message').html(data.success);
                  setTimeout(function() 
                  {
                  location.reload();  //Refresh page
                  }, 3000);
                }
            }
            });
        }
        }); 
      }
    });

    });           
    </script>