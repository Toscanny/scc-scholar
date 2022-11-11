
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
      <form method="post" id="unifast_form">
          <div class="row justify-content-center"><div class="col-md-10">
            <h1 class="h3 mb-4 text-gray-800">UNIFAST Scholarship (US)<br>Application Form</h1>
            <span id="message"></span>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active_tab1" id="list_studentid_details" style="border:1px solid #ccc">Student ID Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">Personal Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link inactive_tab1" id="list_education_details" style="border:1px solid #ccc">Education Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link inactive_tab1" id="list_family_details" style="border:1px solid #ccc">Family Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link inactive_tab1" id="list_requirement_details" style="border:1px solid #ccc">Requirements Details</a>
              </li>
            </ul>
    <!-- Student ID Details -->
      <div class="tab-content" style="margin-top:16px;">
        <div  class="tab-pane show active" id="studentid_details">
          <div class="card">
            <div class="card-header" style="font-weight: bold; font-size: 16px;">Fill Student ID Details</div>
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                      <label>Student ID NO.<span class="text-danger">*</span></label>
                      <input type="text" name="ss_id" id="ss_id" class="form-control" disabled />
                      <span id="error_ss_id" class="text-danger"></span>
                    </div>
                </div>
                </div>
                <div class="form-group text-center">
                  <a class="btn btn-primary" href="apply.php" role="button">Back</a>
                  <button type="button" name="btn_studentid_details" id="btn_studentid_details" class="btn btn-success btn-md">Next</button>
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
                    <h4 class="sub-title">Personal Details</h4>
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-3">
                        <label>Last Name<span class="text-danger">*</span></label>
                        <input type="text" name="slname" id="slname" class="form-control" />
                        <span id="error_slname" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-3">
                        <label>Given Name<span class="text-danger">*</span></label>
                        <input type="text" name="sfname" id="sfname" class="form-control" />
                        <span id="error_sfname" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-3">
                        <label>Middle Name<span class="text-danger">*</span></label>
                        <input type="text" name="smname" id="smname" class="form-control" />
                        <span id="error_smname" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-3">
                        <label>Select Suffix<span class="text-danger">*</label>
                        <select name="snext" id="snext" class="form-control" required>
                          <option value="">-Select-</option>
                          <option value="N/A">N/A</option>
                          <option value="Jr.">Jr.</option>
                          <option value="Sr.">Sr.</option>
                        </select>
                        <span id="error_snext" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-4">
                      <label>Gender<span class="text-danger">*</label>
                        <select name="sgender" id="sgender" class="form-control" required>
                          <option value="">-Select-</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                        <span id="error_sgender" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4"">
                        <label>Date of Birth<span class="text-danger">*</label>
                        <input type='date' name="sdbirth" id="sdbirth" class="form-control" />
                        <span id="error_sdbirth" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-4">
                        <label>Contact No.<span class="text-danger">*</span></label>
                        <input type="text" name="scontact" id="scontact" class="form-control" />
                        <span id="error_scontact" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                        <label>Email<span class="text-danger">*</span></label>
                        <input type="text" name="semail" id="semail" disabled class="form-control" />
                        <span id="error_semail" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <label>Permanent Home Address<span class="text-danger">*</span></label>
                        <textarea type="text" name="saddress" id="saddress" class="form-control" required data-parsley-trigger="keyup"></textarea>
                        <span id="error_saddress" class="text-danger"></span>
                      </div>
                    </div>
              </div>
              <div class="form-group text-center">
                <button type="button" name="previous_btn_personal_details" id="previous_btn_personal_details" class="btn btn-primary btn-md">Previous</button>
                <button type="button" name="btn_personal_details" id="btn_personal_details" class="btn btn-success btn-md">Next</button>
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
                        <label>School Attended<span class="text-danger">*</span></label>
                        <textarea type="text" name="spschname" id="spschname" class="form-control" required data-parsley-trigger="keyup"></textarea>
                        <span id="error_spschname" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <label>School Course/Program<span class="text-danger">*</span></label>
                        <input type="text" name="spscourse" id="spscourse" class="form-control" />
                        <span id="error_spscourse" class="text-danger"></span>
                      </div>
                      <div class="col-xs-12 col-sm-12 col-md-12">
                        <label>Year Level<span class="text-danger">*</span></label>
                        <input type="text" name="spsyrlvl" id="spsyrlvl" class="form-control" />
                        <span id="error_spsyrlvl" class="text-danger"></span>
                      </div>
                  </div>
              </div>
              <div class="form-group text-center">
                <button type="button" name="previous_btn_education_details" id="previous_btn_education_details" class="btn btn-primary btn-md">Previous</button>
                <button type="button" name="btn_education_details" id="btn_education_details" class="btn btn-success btn-md">Next</button>
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
                  <h4 class="sub-title">Father's Details</h4>
                  <div class="row" >
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>Full Name<span class="text-danger">*</span></label>
                      <input type="text" name="sffname" id="sffname" class="form-control" />
                      <span id="error_sffname" class="text-danger"></span>
                      </div>
                </div>
                <h4 class="sub-title">Mother's Details</h4>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                      <label>Full Name<span class="text-danger">*</span></label>
                      <input type="text" name="smfname" id="smfname" class="form-control" />
                      <span id="error_smfname" class="text-danger"></span>
                      </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                      <label>DSWD Household / 4ps No.<span class="text-danger">*</label>
                      <input type="text" name="s4psno" id="s4psno" placeholder="Put N/A if None" class="form-control" />
                      <span id="error_s4psno" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                      <label>Household Capital Income<span class="text-danger">*</label>
                      <input type="text" name="spcyincome" id="spcyincome" placeholder="Put N/A if None" class="form-control" />
                      <span id="error_spcyincome" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                      <label>Specify Disability / Attached PWD Id<span class="text-danger">*</label>
                      <input type="text" name="spwdid" id="spwdid" placeholder="Put N/A if None" class="form-control" />
                      <span id="error_spwdid" class="text-danger"></span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                      <label>Date Filed<span class="text-danger">*</label>
                      <input type='date' name="ssdfile" id="ssdfile" class="form-control" />
                      <span id="error_ssdfile" class="text-danger"></span>
                    </div>
                </div>
                </div>
                <div align="center">
                  <button type="button" name="previous_btn_family" id="previous_btn_family" class="btn btn-primary btn-md">Previous</button>
                  <button type="button" name="btn_family_details" id="btn_family_details" class="btn btn-success btn-md">Next</button>
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
                    <li class="list-group-item">3. 4th year High School Graduate(Old Curriculum)</li>
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
                      <li class="list-group-item">1. Photocopy of PSA(1pc.)</li>
                      <li class="list-group-item">2. 2x2 ID Picture(1pc.)</li>
                      <li class="list-group-item">3. Original Barangay Residency</li>
                    </ul>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault" style="font-style: italic; font-weight: normal;">
                        I agree that the requirements above are legit and will submit it on time.
                      </label>
                      <span id="error_flexCheckDefault" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="alert alert-warning" role="alert" style="font-style: italic;"><b>Note:</b> Please provide the hard copy of the following requirements, bring it to the Scholarship Office, and hand it over to Mr Gemini Daguplo or Ms Grabrielle Heruela.</div>
                  </div>
                </div>
                <div class="form-group text-center">
                  <button type="button" name="previous_btn_requirement" id="previous_btn_requirement" class="btn btn-primary btn-md">Previous</button>
                  <input type="hidden" name="action" value="student_unifast_apply" />
                  <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-success">Submit</button>
                </div>
            </div>
          </div>
      </div>
      </div></div>
      </form>
      <?php
        include('footer.php');
      ?>
    <!-- Script -->
      <script>
        $(document).ready(function(){
      
            <?php
            foreach($result as $row)
            {
            ?>

        // Student ID Details
            $('#ss_id').val("<?php echo $row['ss_id']; ?>");
        // Personal Details
            $('#sfname').val("<?php echo $row['sfname']; ?>");
            $('#smname').val("<?php echo $row['smname']; ?>");
            $('#slname').val("<?php echo $row['slname']; ?>");
            $('#snext').val("<?php echo $row['snext']; ?>");
            $('#sgender').val("<?php echo $row['sgender']; ?>");
            $('#sdbirth').val("<?php echo $row['sdbirth']; ?>");
            $('#scontact').val("<?php echo $row['scontact']; ?>");
            $('#saddress').val("<?php echo $row['saddress']; ?>");
            $('#spschname').val("<?php echo $row['spschname']; ?>");
            $('#spscourse').val("<?php echo $row['spscourse']; ?>");
            $('#spsyrlvl').val("<?php echo $row['spsyrlvl']; ?>");
            $('#semail').val("<?php echo $row['semail']; ?>");
        // Family Details
            $('#sffname').val("<?php echo $row['sffname']; ?>");
            $('#sfmname').val("<?php echo $row['sfmname']; ?>");
            $('#sflname').val("<?php echo $row['sflname']; ?>");
            $('#sfnext').val("<?php echo $row['sfnext']; ?>");
            $('#smfname').val("<?php echo $row['smfname']; ?>");
            $('#smmname').val("<?php echo $row['smmname']; ?>");
            $('#smlname').val("<?php echo $row['smlname']; ?>");
            $('#smnext').val("<?php echo $row['smnext']; ?>");
            $('#s4psno').val("<?php echo $row['s4psno']; ?>");
            $('#spcyincome').val("<?php echo $row['spcyincome']; ?>");
            $('#spwdid').val("<?php echo $row['spwdid']; ?>");
            $('#ssdfile').val("<?php echo $row['ssdfile']; ?>");

            <?php
            }
            ?>
    // Student ID Details
      $('#btn_studentid_details').click(function(){

        var error_ss_id = '';

        if($.trim($('#ss_id').val()).length == 0)
        {
        error_ss_id = 'Student ID No. is required';
        $('#error_ss_id').text(error_ss_id);
        $('#ss_id').addClass('has-error');
        }
        else
        {
        error_ss_id = '';
        $('#error_ss_id').text(error_ss_id);
        $('#ss_id').removeClass('has-error');
        }

        if(error_ss_id != '' )
        {
        return false;
        }
        else{
          
          $('#list_studentid_details').removeClass('active active_tab1');
          $('#list_studentid_details').removeAttr('href data-toggle');
          $('#studentid_details').removeClass('active');
          $('#list_studentid_details').addClass('inactive_tab1');
          $('#list_personal_details').removeClass('inactive_tab1');
          $('#list_personal_details').addClass('active_tab1 active');
          $('#list_personal_details').attr('href', '#personal_details');
          $('#list_personal_details').attr('data-toggle', 'tab');
          $('#personal_details').addClass('active in');

        }
      });

      $('#previous_btn_personal_details').click(function(){
        $('#list_personal_details').removeClass('active active_tab1');
        $('#list_personal_details').removeAttr('href data-toggle');
        $('#personal_details').removeClass('active in');
        $('#list_personal_details').addClass('inactive_tab1');
        $('#list_studentid_details').removeClass('inactive_tab1');
        $('#list_studentid_details').addClass('active_tab1 active');
        $('#list_studentid_details').attr('href', '#studentid_details');
        $('#list_studentid_details').attr('data-toggle', 'tab');
        $('#studentid_details').addClass('active in');
      });

    // Personal Details
      $('#btn_personal_details').click(function(){
        var error_slname = '';
        var error_sfname = '';
        var error_smname = '';
        var error_snext = '';
        var error_sgender = '';
        var error_sdbirth = '';
        var error_scontact = '';
        var error_saddress = '';
        
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

        if($.trim($('#scontact').val()).length == 0)
        {
        error_scontact = 'Contact No. is required';
        $('#error_scontact').text(error_scontact);
        $('#scontact').addClass('has-error');
        }
        else
        {
        error_scontact = '';
        $('#error_scontact').text(error_scontact);
        $('#scontact').removeClass('has-error');
        }

        if($.trim($('#saddress').val()).length == 0)
        {
        error_saddress = 'Permanent Home Address is required';
        $('#error_saddress').text(error_saddress);
        $('#saddress').addClass('has-error');
        }
        else
        {
        error_saddress = '';
        $('#error_saddress').text(error_saddress);
        $('#saddress').removeClass('has-error');
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

        if($.trim($('#snext').val()).length == 0)
        {
        error_snext = 'Select N/A if none';
        $('#error_snext').text(error_snext);
        $('#snext').addClass('has-error');
        }
        else
        {
        error_snext = '';
        $('#error_snext').text(error_snext);
        $('#snext').removeClass('has-error');
        }


        if(error_slname != '' || error_sfname != ''
        || error_smname != '' || error_snext != ''
        || error_sgender != '' || error_sdbirth != ''
        || error_scontact != '' || error_saddress != ''
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
          $('#list_education_details').removeClass('inactive_tab1');
          $('#list_education_details').addClass('active_tab1 active');
          $('#list_education_details').attr('href', '#education_details');
          $('#list_education_details').attr('data-toggle', 'tab');
          $('#education_details').addClass('active in');

        }
      });
  
      $('#previous_btn_education_details').click(function(){
        $('#list_education_details').removeClass('active active_tab1');
        $('#list_education_details').removeAttr('href data-toggle');
        $('#education_details').removeClass('active in');
        $('#list_education_details').addClass('inactive_tab1');
        $('#list_personal_details').removeClass('inactive_tab1');
        $('#list_personal_details').addClass('active_tab1 active');
        $('#list_personal_details').attr('href', '#personal_details');
        $('#list_personal_details').attr('data-toggle', 'tab');
        $('#personal_details').addClass('active in');
      });

    // Education Details
        $('#btn_education_details').click(function(){

        var error_spschname	= '';
        var error_spscourse = '';
        var error_spsyrlvl = '';

        if($.trim($('#spschname').val()).length == 0)
        {
        error_spschname = 'Previous School Attended is required';
        $('#error_spschname').text(error_spschname);
        $('#spschname').addClass('has-error');
        }
        else
        {
        error_spschname = '';
        $('#error_spschname').text(error_spschname);
        $('#spschname').removeClass('has-error');
        }

        if($.trim($('#spscourse').val()).length == 0)
        {
          error_spscourse = 'Previous School Course/Program is required';
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
          error_spsyrlvl = 'Previous School Year Level is required';
        $('#error_spsyrlvl').text(error_spsyrlvl);
        $('#spsyrlvl').addClass('has-error');
        }
        else
        {
          error_spsyrlvl = '';
        $('#error_spsyrlvl').text(error_spsyrlvl);
        $('#spsyrlvl').removeClass('has-error');
        }


        if(error_spschname != '' || error_spscourse != ''
        || error_spsyrlvl != '')
        {
        return false;
        }
        else
        {

          $('#list_education_details').removeClass('active active_tab1');
          $('#list_education_details').removeAttr('href data-toggle');
          $('#education_details').removeClass('active');
          $('#list_education_details').addClass('inactive_tab1');
          $('#list_family_details').removeClass('inactive_tab1');
          $('#list_family_details').addClass('active_tab1 active');
          $('#list_family_details').attr('href', '#family_details');
          $('#list_family_details').attr('data-toggle', 'tab');
          $('#family_details').addClass('active in');

        }
      });
  
      $('#previous_btn_family').click(function(){
        $('#list_family_details').removeClass('active active_tab1');
        $('#list_family_details').removeAttr('href data-toggle');
        $('#family_details').removeClass('active in');
        $('#list_family_details').addClass('inactive_tab1');
        $('#list_education_details').removeClass('inactive_tab1');
        $('#list_education_details').addClass('active_tab1 active');
        $('#list_education_details').attr('href', '#education_details');
        $('#list_education_details').attr('data-toggle', 'tab');
        $('#education_details').addClass('active in');
      });
  
    // Family Details
      $('#btn_family_details').click(function(){
        var error_sffname = '';
        var error_smfname = '';
        var error_s4psno = '';
        var error_spcyincome = '';
        var error_spwdid = '';
        var error_ssdfile = '';
      
      //Father First Name
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

        //Mother First Name

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

        //DSWD Household
        if($.trim($('#s4psno').val()).length == 0)
        {
        error_s4psno = 'Put N/A if none';
        $('#error_s4psno').text(error_s4psno);
        $('#s4psno').addClass('has-error');
        }
        else
        {
        error_s4psno = '';
        $('#error_s4psno').text(error_s4psno);
        $('#s4psno').removeClass('has-error');
        }
      // Household Capital Income
        if($.trim($('#spcyincome').val()).length == 0)
        {
        error_spcyincome = 'Capital Income is required';
        $('#error_spcyincome').text(error_spcyincome);
        $('#spcyincome').addClass('has-error');
        }
        else
        {
        error_spcyincome = '';
        $('#error_spcyincome').text(error_spcyincome);
        $('#spcyincome').removeClass('has-error');
        }

        // Specify Disability
        if($.trim($('#spwdid').val()).length == 0)
        {
        error_spwdid = 'Put N/A if none';
        $('#error_spwdid').text(error_spwdid);
        $('#spwdid').addClass('has-error');
        }
        else
        {
        error_spwdid = '';
        $('#error_spwdid').text(error_spwdid);
        $('#spwdid').removeClass('has-error');
        }

        // Date Filed
        if($.trim($('#ssdfile').val()).length == 0)
        {
        error_ssdfile = 'Date Filed is required';
        $('#error_ssdfile').text(error_ssdfile);
        $('#ssdfile').addClass('has-error');
        }
        else
        {
        error_ssdfile = '';
        $('#error_ssdfile').text(error_ssdfile);
        $('#ssdfile').removeClass('has-error');
        }
        

        if(error_sffname != '' ||
        error_smfname != '' ||
        error_s4psno != '' ||
        error_spwdid != '' ||
        error_spcyincome != '' ||
        error_ssdfile != '' 
        )
        {
        return false;
        }
        else
        {

          $('#list_family_details').removeClass('active active_tab1');
          $('#list_family_details').removeAttr('href data-toggle');
          $('#family_details').removeClass('active');
          $('#list_family_details').addClass('inactive_tab1');
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
        $('#list_family_details').removeClass('inactive_tab1');
        $('#list_family_details').addClass('active_tab1 active');
        $('#list_family_details').attr('href', '#family_details');
        $('#list_family_details').attr('data-toggle', 'tab');
        $('#family_details').addClass('active in');
      });

    // Requirements Details
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
                    $('#unifast_form').parsley();
                      
                    $('#unifast_form').on('submit', function(event){
                    event.preventDefault();
                    if($('#unifast_form').parsley().isValid())
                    {
                        $.ajax({
                        url:"unifast_action.php",
                        method:"POST",
                        data:$(this).serialize(),
                        dataType:'json',
                        beforeSend:function(){
                            $('#btn_submit').attr('disabled', 'disabled');
                        },
                        success:function(data)
                        {
                            $('#btn_submit').attr('disabled', false);
                            // $('#unifast_form')[0].reset();
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