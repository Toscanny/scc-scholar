<?php 
session_start();
include_once ("connect 2.php");

if(isset($_POST['apply'])){


$ss_id = $_POST['ss_id'];
$slname = $_POST['slname'];
$sfname = $_POST['sfname'];
$smname = $_POST['smname'];
$sgender = $_POST['sgender'];
$sdbirth = $_POST['vsdbirth'];
$scontact = $_POST ['cpNO'];
$saddress =  $_POST ['saddress'];
$phone =  $_POST['phone'];
$sccourse =  $_POST['sccourse']; 
$scsyrlvl =  $_POST['scsyrlvl'];
$semail = $_POST['semail'];



// Family
// father
$sflname =  $_POST['sflname'];
$sffname =  $_POST['sffname'];
$sfmname =  $_POST['sfmname'];
$sfoccu =  $_POST['sfoccu'];

// mother 
$smlname =  $_POST['smlname'];
$smfname =  $_POST['smfname'];
$smmname =  $_POST['smmname'];
$smoccu =  $_POST['smoccu'];

// DSWD
$S_IDNO =  $_POST['s4psno'];

//family income
$spcyincome =  $_POST['spcyincome'];

//PWD
$S_disability =  $_POST['sdisability'];

//student image
$image = $_FILES['filename']['name'];
//renaming the image
$image_ext = pathinfo($image, PATHINFO_EXTENSION);
$filename = time().'.'.$image_ext;

  


$statement = "INSERT INTO tbl_student (ss_id, slname, sfname, smname, sgender, sdbirth, scontact, saddress, spschname, spscourse, spsyrlvl, semail,sflname,sffname,sfmname,sfoccu,smlname,smfname,smmname,smoccu, s4psno, Sdisability, student_image ) 
VALUES ('$ss_id','$slname','$sfname','$smname','$sgender','$sdbirth','$scontact','$saddress','$phone','$sccourse','$scsyrlvl','$semail','$sflname','$sffname','$sfmname','$sfoccu','$smlname','$smfname','$smmname','$smoccu','$S_IDNO','$S_disability','$filename')";

$sql = mysqli_query($conn, $statement);
if($sql)
{
  move_uploaded_file($_FILES['filename']['tmp_name'], 'stud_img/'.$filename);
  echo '<script>alert("Congrats, You have applied in Unifast")</script>';
  header("Location: unifast.php");
  exit(0);
}
else
{
  header("Location: unifast.php");
  exit(0);
}





  
}

?>




<!DOCTYPE html>
<html>

<head>
<title>Unifast Application Form</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>




  
<style>



* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
  font-family: Raleway;
}

#regForm {
  background-color: #ffffff;
  margin: 50px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
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




h1 {
  text-align: center;  
}


input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}
.button_sub{
  background-color: black;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}


</style>
<body>

<div class="container box">
    <br />
<h1> UniFAST APPLICATION FORM </h1>
<p style="font-size:14px"><center><b>INSTRUCTION: &nbsp </b> Fill  out the required information below. Do not leave an Item blank. If an item is no apllicable, indicate <b> "N/A" </b><div class=""></div>
</center><br><br>

<form id="" action="" method="POST" enctype="multipart/form-data">

<!-- Student ID Details -->
<div class="tab-content" style="margin-top:16px;">
    <div class="tab-pane show active" id="ss_details">
      <div class="card">

      <div class="card-header">
<div class="col-md-10 ">
  <P style="font-weight: bold; font-size: 16px">Fill Student Details</h3>
</div>

<div class="col-md-1 float-right">
<i class="fa fa-info-circle fa-2x" data-toggle="modal" data-target="#myModal"></i>
  </div></div>  
        

<!-- Modal -->
<div class="modal fade" id="myModal"  >
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">INSTRUCTION</h4>
 
  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>       </button> 
       -->
</div>





      <div class="modal-body">
      Fill  out the required information below. Do not leave an Item blank. If an item is no apllicable, indicate <b> "N/A" </b><div class=""></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">OK</button> -->
      </div>



    </div>
  </div>
</div>




          
          <div class="card-body">
            
          <form action = "" method= "post" class="row g-3" enctype="multipart/form-data">

  <!-- One "tab" for each step in the form: -->
  
  <div class="tab">Student ID NO.
  <p><input placeholder="Student ID NO." oninput="this.className = 'ss_id'" name="ss_id"></p>

 Upload picture
  <input type="file" id="myFile" name="filename">

  </div>
  



  <div class="tab">Name:
  <div class="row">
     <div class="col-xs-12 col-sm-12 col-md-4">
    <p><input placeholder="Last name..." oninput="this.className = 'slname'" name="slname"></p> </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
    <p><input placeholder="Given name..." oninput="this.className = 'sfname'" name="sfname"></p> </div>

    <div class="col-xs-12 col-sm-12 col-md-4">
    <p><input placeholder="Middle name..." oninput="this.className = 'smname'" name="smname"></p> </div>


<div class="col-xs-12 col-sm-12 col-md-4">
<p>Gender:</p>
    <p><input placeholder="Gender..." oninput="this.className = 'sgender'" name="sgender"></p> </div>





<div class="col-xs-10 col-sm-12 col-md-4">
               <label>Date of Birth<span class="text-danger">*</span></label>
                          <input type="date" name="vsdbirth" id="vsdbirth" autocomplete="off" class="form-control" />
                        <span id="error_vsdbirth" class="text-danger"></span>
                      </div>

<div class="col-xs-10 col-sm-12 col-md-4">
Cellphone No:
<p><input placeholder="Cellphone No..." name="cpNO"></p> 
</div>

</div></div>






  <div class="tab">Permanent Home Address:
  <div class="row">

   <p> <input type="text" placeholder="Permanent Address..." oninput="this.className = ''" name="saddress"></p>

   <p> Previous School Attended:
    <input placeholder="Previous School Attended..." oninput="this.className = ''" name="phone"></p>
  

    <div class="col-md-6">
  Course/Program:
<select class="form-select" name="sccourse" aria-label="Default select example">
  <option selected>Choose course/program </option>
  <option value="BEED">BEED</option>
  <option value="BSED">BSED</option>
  <option value="BSBA-FM">BSBA-FM</option>
  <option value="BSBA-MM">BSBA-MM</option>
  <option value="BSTM">BSTM</option>
  <option value="BSHM">BSHM</option>
  <option value="BSCRIM">BSCRIM</option>
  <option value="BSIT">BSIT</option>
</select> </div> 


<div class="col-md-6">
Year-level:

<select name="scsyrlvl" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
</div> 




<p><p>Email Address:
    <input placeholder="Email Address..." oninput="this.className = ''" name="semail"></p>
      

<br> <br>
</div></div>



  <div class="tab">Family Details:
  <div class="row">

  <hr>
  Father
  <p><div class="col-xs-6 col-sm-3">
 <input placeholder="Last name..." oninput="this.className = ''" name="sffname"></p> </div>

  <div class="col-xs-6 col-sm-3">
 <input placeholder="Given name..." oninput="this.className = ''" name="sfmname"></p> </div>

  <div class="col-xs-6 col-sm-3">
  <input placeholder="Middle name..." oninput="this.className = ''" name="sflname"></p> </div>

  <div class="col-xs-6 col-sm-3">
 <input placeholder="Occupation..." oninput="this.className = ''" name="sfoccu"></p> </div>

<hr>
  Mother
  <p><div class="col-xs-6 col-sm-3">
  <p><input placeholder="Last name..." oninput="this.className = ''" name="smfname"></p> </div>

  <div class="col-xs-6 col-sm-3">
 <input placeholder="Given name..." oninput="this.className = ''" name="smmname"></p> </div>

  <div class="col-xs-6 col-sm-3">
<input placeholder="Middle name..." oninput="this.className = ''" name="smlname"></p> </div>

  <div class="col-xs-6 col-sm-3">
<input placeholder="Occupation..." oninput="this.className = ''" name="smoccu"></p> </div>


  </div></div>



  <div class="tab">DSWD Household/ 4PS NO.:
   <input placeholder="DSWD Household/ 4PS NO..." oninput="this.className = ''" name="s4psno"></p>


  <p> Household Capital Income per month:
 <input placeholder="Household Capital Income..." oninput="this.className = ''" name="spcyincome"></p>
  

  <p> Specify Disability / Attached PWD ID:
 <input placeholder="Specify Disability / Attached PWD ID..."oninput="this.className = ''" name="sdisability"></p>
  


 
  <label>Date Field<span class="text-danger">*</span></label>
                          <input type="date" name="vsdbirth" id="vsdbirth" autocomplete="off" class="form-control" />
                        <span id="error_vsdbirth" class="text-danger"></span>
                      </div>




  <div class="tab"> 

  <div class="row">
  <p style= "text-indent: 50px;">&nbsp &nbspI certify that the entries above are true and correct to the best of my knowledge and belief. I 
      hereby authorize the scholarship coordinator to verify such entries. I also understand and agree that
    any misinterpretation or material omission made herein related to the  UniFAST SCHOLARSHIP shall be subject for disciplinary action.</p>


    <div class="col-md-6">
    <br>
    <b><hr></b>
   <center>(Signature of Applicant Over Printed name)</p></center>
  </div>

  <div class="col-md-6">
  <br>
  <b><hr></b>
   <p><center>(Date)</p></center>
  </div> 

  <p><center><b>SCHOLARSHIP AGREEMENT </b></p></center>
  <b><hr></b>

<p>UniFAST Requirements:
  <ul>
    <ol> 1pc. 2x2 colored picture</ol>
      <ol> 1 pcs. Photocopy of NSO|PSA</ol>
        <ol> Brgy. Residency (Minglanilla)     </ol>
    </ul>
</p>

</div>
</div>





                      <br>

  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      <button name="apply" class="button_sub" type="submit">Apply</button>
    </div>
  </div>







  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>


	<!-- <a href= "../newdash.php" type="new" class="btn btn-success"> Go Back </a> 
  </div></div></div></div></div> -->

</div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  }

  else {
    document.getElementById("prevBtn").style.display = "inline";
  } 

  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}



function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

</body>
</html>
