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

$statement = $conn->prepare("SELECT * FROM  tbl_student");
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
  <body>
    <h1>List of New Applicant!</h1>

   
    <?php foreach ($tbl_student as $i => $tbl_student): ?>
    <table style="width:50%">
  <tr>
    <th>Student ID NO. </th>
    <td style="width: 70%">
    <!-- <?php echo $tbl_student ['ss_id'] ?> -->
  </td> 


  <th>Student ID NO. </th>
    <td style="width: 70%">
    <!-- <?php echo $tbl_student ['ss_id'] ?> -->
  </td> 


   
    </tr>








</table>


   
    <tr style="width:10%">>

      <th scope="col">Image</th>
     <th scope="col">Last Name</th>
      <th scope="col">Given Name</th>
      <th scope="col">Middle Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Birthday</th>



      <!-- <th scope="col">Permanent Home Address</th>
      <th scope="col">Previous School Attended</th>
      <th scope="col">Course/Program</th>
      <th scope="col">Email Address</th>
      <th scope="col">Year Level</th> -->

    </tr>


    <tbody>
      
    <tr>

   
      <td><?php echo $tbl_student ['simage'] ?></td>
      <td><?php echo $tbl_student ['slname'] ?></td> 
      <td><?php echo $tbl_student ['sfname'] ?></td> 
      <td><?php echo $tbl_student ['smname'] ?></td> 
      <td><?php echo $tbl_student ['sgender'] ?></td> 
      <td><?php echo $tbl_student ['sdbirth'] ?></td> 
     
     

    </tr>
        
    
    <?php endforeach; ?>

    
  </tbody>
</table>


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


