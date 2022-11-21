<!DOCTYPE html>
<?php
	require 'connect.php';
?>
<html lang="en">
	<head>
		<style>	
		.table {
			width: 100%;
			margin-bottom: 20px;
		}	
		
		.table-striped tbody > tr:nth-child(odd) > td,
		.table-striped tbody > tr:nth-child(odd) > th {
			background-color: #f9f9f9;
		}
		
		@media print{
			#print {
				display:none;
			}
		}
		@media print {
			#PrintButton {
				display: none;
			}
		}
		
		@page {
			size: auto;   /* auto is the initial value */
			margin: 0;  /* this affects the margin in the printer settings */
		}
	</style>
	</head>
<body>

<?php 

include_once ("connect 2.php");

$statement = $conn->prepare("SELECT * FROM  tbl_newstudent");
$statement ->execute();
$tbl_student = $statement-> fetch(PDO :: FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


 <link rel="stylesheet" href= "app.css"> 

    <title>Record of Information</title>
  </head>

<style>

.marg{
  margin-top: 100px;
  margin-bottom: 100px;
  margin-right: 150px;
  margin-left: 80px;
}

table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

	</style>

<div class="marg">
<style>
table, th, td {
  border:1px solid black;
  border-collapse: collapse;
}

h1 {
  font-size: 30px;
}

h2 {
  font-size: 20px;
  letter-spacing: -1px;
}
</style>
<body>
<p style="text-align:center">
St. Cecilia's College-Cebu, Inc.
LASSO Supervised School
Natallio B. Bacalso South National Highway
Minglanilla, Cebu
Tel. No. 032268474/032-490-0767
</p>
<h1 style="text-align:center">UniFast APPLICATION FORM</h1>
<h2 style="text-align:center">S.Y.:</h2>

<table>
  <tr>
    <td>STUDENT ID NO. </td>
    <td style="width:60%"><?php echo $tbl_student ['ss_id'] ?></td>
  </tr>
</table>
<br>

<table style="width:100%">
  <tr>
    <th style="text-align:center" colspan="6">PERSONAL DETAILS</th> 
  </tr>
  <tr>
    <td>LAST NAME</td>
    <td style="width:70%" colspan="5"><?php echo $tbl_student ['slname'] ?></td> 
  </tr>
  <tr>
    <td>GIVEN NAME</td>
    <td colspan="5"><?php echo $tbl_student ['sfname'] ?></td>
  </tr>
  <tr>
    <td>MIDDLE NAME</td>
    <td colspan="5"><?php echo $tbl_student ['smname'] ?></td>
  </tr>
  <tr>
    <td>GENDER</td>
    <td><?php echo $tbl_student ['sgender'] ?></td>
    <td>BIRTHDATE: (mm/dd/yyyy)</td>
    <td><?php echo $tbl_student ['sdbirth'] ?></td>
    <td>CELLPHONE NO.</td>
    <td><?php echo $tbl_student ['scontact'] ?></td>
  </tr>
</table>
<br>
<table style="width:100%">
  <tr>
    <td>PERMANENT HOME ADDRESS</td>
    <td style="width:70%" colspan="5"><?php echo $tbl_student ['saddress'] ?></td> 
  </tr>
  <tr>
    <td>PREVIOUS SCHOOL ATTENDED</td>
    <td colspan="5"><?php echo $tbl_student ['spschname'] ?></td>
  </tr>
  <tr>
    <td>COURSE/PROGRAM</td>
    <td colspan="3"><?php echo $tbl_student ['sccourse'] ?></td>
    <td>YEAR LEVEL</td>
    <td><?php echo $tbl_student ['syrlvl'] ?></td>
  </tr>
  <tr>
    <td>EMAIL ADDRESS</td>
    <td style="width:70%" colspan="5"><?php echo $tbl_student ['semail'] ?></td> 
  </tr>
</table>
<br>
<table style="width:100%">
	
  <tr>
    <th style="text-align:center" colspan="6">FAMILY DETAILS</th> 
  </tr>
  <tr>
  	<td></td>
    <td>LAST NAME</td>
    <td>GIVEN NAME</td>
    <td>MIDDLE NAME</td>
    <td colspan="2">OCCUPATION</td>
  </tr>
  <tr>
    <td>FATHER</td>
    <td><?php echo $tbl_student ['sflname'] ?></td>
    <td><?php echo $tbl_student ['sffname'] ?></td>
    <td><?php echo $tbl_student ['sfmname'] ?></td>
    <td colspan="2"><?php echo $tbl_student ['sfoccu'] ?></td>
  </tr>
  <tr>
    <td>MOTHER</td>
    <td><?php echo $tbl_student ['smlname'] ?></td>
    <td><?php echo $tbl_student ['smfname'] ?></td>
    <td><?php echo $tbl_student ['smmname'] ?></td>
    <td colspan="2"><?php echo $tbl_student ['smoccu'] ?></td>
  </tr>
</table>
<br>
<table style="width:100%">
  <tr>
    <td>DSWD HOUSEHOLD/4PS NO.</td>
    <td style="width:70%" colspan="5"><?php echo $tbl_student ['s4psno'] ?></td> 
  </tr>
  <tr>
    <td>HOUSEHOLD CAPITAL INCOME</td>
    <td colspan="5"><?php echo $tbl_student ['spcyincome'] ?></td>
  </tr>
  <tr>
    <td>SPECIFY DISABILITY/ATTACHED PWD ID</td>
    <td colspan="3"><?php echo $tbl_student ['S_disability'] ?></td>
    <td>DATE FILED</td>
    <td><?php echo $tbl_student ['s_datefil'] ?></td>
  </tr>
</table>
</body>
</html>

<p style="text-align:center"> I certify that the entries above are true and correct to the best of my knowledge and belief. I hereby authorize the scholarship coordinator to verify such entries. I also understand and agree that any misinterpretation or material omission made herein related to the UniFAST SCHOLARSHIP shall be subject for disciplinary action.


<p>(Signature of applicant over  printed name)</p>

<p>Date</p>

<p style="text-align:center">SCHOLARSHIP AGREEMENT</p>
<p>UniFast Requirements:</p>
<p>1. 1pc 2X2 colored picture</p>
<p>2. 1pc Photocopy of NSO|PSA</p>
<p>3. Brgy., Residency(Minglanilla)</p>


   


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

	<center><button id="PrintButton" onclick="PrintPage()">Print</button></center>
</body>
<script type="text/javascript">
	function PrintPage() {
		window.print();
	}
	document.loaded = function(){
		
	}
	window.addEventListener('DOMContentLoaded', (event) => {
   		PrintPage()
		setTimeout(function(){ window.close() },750)
	});
</script>
</html>

