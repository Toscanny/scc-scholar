<?php

//verify.php
include('../class/dbcon.php');

$object = new sms;

if(isset($_GET["code"]))
{
	$s_verification_code = $_GET["code"];

	$object->query = "
	UPDATE tbl_student
	SET s_email_verify = 'Yes',
	s_added_on = '$object->now' 
	WHERE s_verification_code = '".$s_verification_code."'
	";

	$object->execute();

	$_SESSION['success_message'] = '<div class="alert alert-success">You Email has been verify, now you can login into system</div>';

	header("location:index.php");
}

?>