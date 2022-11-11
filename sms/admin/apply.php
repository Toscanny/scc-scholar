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
<!-- Form -->
  <form method="post" name="apply_form" id="apply_form">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <h1 class="h3 mb-4 text-gray-800">Student Application Management</h1>
        <div class="card">
        <div class="card-header" style="font-weight: bold; font-size: 18px;">Scholarships</div>
          <div class="card-body">
            <div class="form-group">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <select name="select_sch" id="select_sch" class="form-control">
                      <option value="" selected>Choose Scholarship</option>
                      <optgroup label="School">
                          <option value="1" title="Applicant Must Be: 1. Senior High Graduate 2. College Level 3. 4th year High School Graduate(Old Curriculum) 
                               4. ALS Passer Promoted to College 5. Enrolled of the said Institution">Academic</option>
                          <option value="2" title="Applicant Must Be: 1. Senior High Graduate 2. College Level 3. 4th year High School Graduate(Old Curriculum) 
                               4. ALS Passer Promoted to College 5. Enrolled of the said Institution">Non-Academic</option>
                      </optgroup>
                      <optgroup label="Goverment">
                          <option value="3" title="Applicant Must Be: 1. Senior High Graduate 2. College Level 3. 4th year High School Graduate(Old Curriculum) 
                               4. ALS Passer Promoted to College 5. Enrolled of the said Institution">UNIFAST</option>
                          <option value="4" title="Applicant Must Be: 1. Senior High Graduate 2. College Level 3. 4th year High School Graduate(Old Curriculum) 
                               4. ALS Passer Promoted to College 5. Enrolled of the said Institution">CHED</option>
                      </optgroup>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group text-center">
                <button type="button" name="btn_choose" id="btn_choose" class="btn btn-success">Submit</button>
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
    $('#btn_choose').click(function(){

      var sel = document.getElementById('select_sch');
      if (sel.value == "1") {
        window.location.href = "academic.php";
      } else if (sel.value == "2") {
        window.location.href = "non-academic.php";
      } else if (sel.value == "3") {
        window.location.href = "unifast.php";
      } else if (sel.value == "4") {
        window.location.href = "ched.php";
      } else {
        alert("Please select scholarship");
      }

    });

    // Select Tooltip
    $(".select_sch").selectpicker()
    var title = [];
    $('#select_sch option').each(function(){
        title.push($(this).attr('title'));
    });

    $("ul.selectpicker li").each(function(i){
      $(this).attr('title',title[i]).tooltip({container:"#tooltipBox"});
    })
  </script>


