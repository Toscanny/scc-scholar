<?php

include('../class/dbcon.php');
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';

$object = new sms;

if(isset($_POST["action"]))
{

// Admin
	// Admin Profile
		if($_POST["action"] == 'profile')
		{
			sleep(2);

			$error = '';

			$success = '';

			if($error == '')
			{
				$data = array(
					':username'					=>	$object->clean_input($_POST["username"]),
				);

				$object->query = "
				UPDATE users  
				SET username = :username, 
				WHERE S_id = '".$_SESSION["S_id"]."'
				";
				$object->execute($data);

				$success = '<div class="alert alert-success">Profile Data Updated</div>';

				$output = array(
					'error'					=>	$error,
					'success'				=>	$success,
					'username'			=>	$_POST["username"], 
				);

				echo json_encode($output);
			}
			else
			{
				$output = array(
					'error'					=>	$error,
					'success'				=>	$success
				);
				echo json_encode($output);
			}
		}
	// Old Password
			if($_POST['action'] == 'coapass')
			{
				$error = '';

				$success = '';

				$object->query = "
				SELECT * FROM users
				WHERE S_id = '".$_SESSION["S_id"]."' 
				";

				$result = $object->get_result();

				foreach($result as $row)
				{

					if(password_verify($_POST["ocapass"], $row["password"]))
					{
						$success = '<div class="alert alert-success">Password Match</div>';
					}
					else
					{
						$error = '<div class="alert alert-danger">Wrong Password</div>';	
					}
					
				}

				$output = array(
					'error'		=>	$error,
					'success'	=>	$success
				);
				echo json_encode($output);
			}
	// New Password
			if($_POST['action'] == 'ncccapass')
			{
				$error = '';

				$success = '';

				$object->query = "
				SELECT * FROM users
				WHERE S_id = '".$_SESSION["S_id"]."' 
				";

				$result = $object->get_result();

				foreach($result as $row)
				{

					if(password_verify($_POST["ncapass"], $row["password"]))
					{
						$error = '<div class="alert alert-danger">Old Password, Please Use Another Password</div>';
					}
					else
					{
						$new_password = $_POST["ncapass"];
						$confirm_password = $_POST["nccapass"];
					
						if($new_password == $confirm_password)
						{
					
							$object->query = "
							UPDATE users 
							SET password = '".password_hash($new_password, PASSWORD_ARGON2I)."'
							WHERE S_id = '".$_SESSION["S_id"]."'       
							";
					
							$success = '<div class="alert alert-success">Password Change Successfully</div>';
					
							$object->execute();
						}
						else
						{
							$error = '<div class="alert alert-danger">Password Not Match</div>';
						}	
					}
					
				}

				$output = array(
					'error'		=>	$error,
					'success'	=>	$success
				);
				echo json_encode($output);
			}


// Student
	// Student Profile
		if($_POST["action"] == 'profile')
		{
			sleep(2);

			$error = '';

			$success = '';

			if($error == '')
			{
					$data = array(
						':username'						=>	$object->clean_input($_POST["username"]),
					);

					$object->query = "
					UPDATE users  
					SET username = :username, 
					WHERE S_id = '".$_SESSION["S_id"]."'
					";
					$object->execute($data);

					$success = '<div class="alert alert-success">Student Data Updated</div>';			

				$output = array(
					'error'					=>	$error,
					'success'				=>	$success,
					'username'				=>	$_POST["username"],
				);

				echo json_encode($output);
			}
			else
			{
				$output = array(
					'error'					=>	$error,
					'success'				=>	$success
				);
				echo json_encode($output);
			}
		}
	// Old Password
		if($_POST['action'] == 'copass')
		{
			$error = '';

			$success = '';

			$object->query = "
			SELECT * FROM users
			WHERE S_id = '".$_SESSION["S_id"]."' 
			";

			$result = $object->get_result();

			foreach($result as $row)
			{

				if(password_verify($_POST["ocpass"], $row["spass"]))
				{
					$success = '<div class="alert alert-success">Password Match</div>';
				}
				else
				{
					$error = '<div class="alert alert-danger">Wrong Password</div>';	
				}
				
			}

			$output = array(
				'error'		=>	$error,
				'success'	=>	$success
			);
			echo json_encode($output);
		}
	// New Password
		if($_POST['action'] == 'ncspass')
		{
			$error = '';

			$success = '';

			$object->query = "
			SELECT * FROM users
			WHERE S_id = '".$_SESSION["S_id"]."' 
			";

			$result = $object->get_result();

			foreach($result as $row)
			{

				if(password_verify($_POST["ncpass"], $row["spass"]))
				{
					$error = '<div class="alert alert-danger">Old Password, Please Use Another Password</div>';
				}
				else
				{
					$new_password = $_POST["ncpass"];
					$confirm_password = $_POST["nccpass"];
				
					if($new_password == $confirm_password)
					{
				
						$object->query = "
						UPDATE users 
						SET password = '".password_hash($new_password, PASSWORD_ARGON2I)."'
						WHERE S_id = '".$_SESSION["S_id"]."'       
						";
				
						$success = '<div class="alert alert-success">Password Change Successfully</div>';
				
						$object->execute();
					}
					else
					{
						$error = '<div class="alert alert-danger">Password Not Match</div>';
					}	
				}
				
			}

			$output = array(
				'error'		=>	$error,
				'success'	=>	$success
			);
			echo json_encode($output);
		}
		}
		?>