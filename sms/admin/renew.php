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
      <form method="post" id="acad_form">
        <div class="row justify-content-center"><div class="col-md-10">
          <h1 class="h3 mb-4 text-gray-800">Academic Scholarship Renewal</h1>
          <span id="message"></span>
    <!-- Requirement Details -->
        <div class="tab-pane" id="require_details">
            <div class="card">
              <div class="card-header" style="font-weight: bold; font-size: 16px;">List of Requirements</div>
                <div class="card-body">
                  <div class="form-group">
                    <ul class="list-group d-flex justify-content-center">
                      <li class="list-group-item">1. Photocopy of Grade of Previous Semester</li>
                      <li class="list-group-item">2. Photocopy of Current Semester Study Load</li>
                    </ul>
                  </div>
                  <div class="form-group">
                    <div class="alert alert-warning" role="alert" style="font-style: italic;"><b>Note:</b> Please provide the hard copy of the following requirements, bring it to the Scholarship Office, and hand it over to Mr. Gemini Daguplo or Ms. Grabrielle Heruela.</div>
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
