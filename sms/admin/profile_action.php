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
		if($_POST["action"] == 'admin_profile')
		{
			sleep(2);

			$error = '';

			$success = '';

			if($error == '')
			{
				$data = array(
					':admin_name'					=>	$object->clean_input($_POST["admin_name"]),
					':admin_position'				=>	$object->clean_input($_POST["admin_position"]),
					':admin_address'				=>	$object->clean_input($_POST["admin_address"]),
					':admin_contact_no'				=>	$object->clean_input($_POST["admin_contact_no"]),
				);

				$object->query = "
				UPDATE tbl_admin  
				SET admin_name = :admin_name, 
				admin_position = :admin_position, 
				admin_address = :admin_address, 
				admin_contact_no = :admin_contact_no
				WHERE admin_id = '".$_SESSION["admin_id"]."'
				";
				$object->execute($data);

				$success = '<div class="alert alert-success">Admin Data Updated</div>';

				$output = array(
					'error'					=>	$error,
					'success'				=>	$success,
					'admin_name'			=>	$_POST["admin_name"], 
					'admin_position'		=>	$_POST["admin_position"],
					'admin_address'			=>	$_POST["admin_address"],
					'admin_contact_no'		=>	$_POST["admin_contact_no"]
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
	// Admin Input New Email
		if($_POST['action'] == 'caemail')
		{
			$error = '';

			$success = '';

			$data = array(
				':admin_email_address'	=>	$_POST["canemail"]
			);

			$object->query = "
			SELECT * FROM tbl_admin
			WHERE admin_email_address = :admin_email_address
			";

			$object->execute($data);

			if($object->row_count() > 0)
			{
				$error = '<div class="alert alert-danger">Email Already Exists</div>';
			}
			else
			{

				$object->query = "
				UPDATE tbl_admin 
				SET admin_email_address = :admin_email_address,
				admin_verification_code = :admin_verification_code,
				admin_email_verify = :admin_email_verify
				WHERE admin_id = '".$_SESSION["admin_id"]."'       
				";

				// Generate Verifcation Code
				$admin_verification_code = rand(100000, 999999);

				$data = array(
					':admin_email_address'			=>	$_POST["canemail"],
					':admin_verification_code'	    =>	$admin_verification_code,
					':admin_email_verify'			=>	'No'
					
				);

					// Load composer's autoloader
					require '../vendor/autoload.php';
				
					$mail = new PHPMailer\PHPMailer\PHPMailer();                            
					try {
						//Server settings
						$mail->isSMTP();                                     
						$mail->Host = 'smtp.gmail.com';                      
						$mail->SMTPAuth = true;                             
						$mail->Username = 'unswaa20@gmail.com';     
						$mail->Password = 'sio@1231999';             
						$mail->SMTPOptions = array(
							'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
							)
						);                         
						$mail->SMTPSecure = 'ssl';                           
						$mail->Port = 465;                                   
				
						//Send Email
						$mail->setFrom('unswaa20@gmail.com');
						$mail->FromName = 'Unswaa20';
						
						//Recipients
						$mail->addAddress($_POST["canemail"]);            
						$mail->addReplyTo('unswaa20@gmail.com');
						$mail->WordWrap = 50;

						//Content
						$mail->isHTML(true);                                  
						$mail->Subject = 'Verification code for Verify Your Email Address';
						$message_body = '
						<p>For verify your email address, Please enter this verification code when prompted: <b>'.$admin_verification_code.'</b>.</p>
						';
						$mail->Body = $message_body;
				
						$mail->send();

						$success = '<div class="alert alert-success">Please Check Your Email for email Verification</div>';

					} catch (Exception $e) {
						$error = '<div class="alert alert-danger">' . $mail->ErrorInfo . '</div>';
					}

					$object->execute($data);
			}

			$output = array(
				'error'		=>	$error,
				'success'	=>	$success
			);
			echo json_encode($output);
		}
	// Admin Input Email OTP
		if($_POST['action'] == 'otpcaaemail')
		{
			$error = '';

			$success = '';

			$data = array(
				':admin_verification_code'	=>	$_POST["otpcaemail"]
			);

			$object->query = "
			SELECT * FROM tbl_admin
			WHERE admin_verification_code = :admin_verification_code
			";

			$object->execute($data);

			if($object->row_count() > 0)
			{
				$object->query = "
				UPDATE tbl_admin
				SET admin_email_verify = :admin_email_verify
				WHERE admin_id = '".$_SESSION["admin_id"]."'       
				";

				$data = array(
					':admin_email_verify'			    =>	'Yes'
				);

				$success = '<div class="alert alert-success">Email Successfully Changed</div>';

				$object->execute($data);
			}
			else
			{
				$error = '<div class="alert alert-danger">Invalid OTP Number</div>';	
			}

			$output = array(
				'error'		=>	$error,
				'success'	=>	$success
			);
			echo json_encode($output);
		}
	// Old Password
			if($_POST['action'] == 'coapass')
			{
				$error = '';

				$success = '';

				$object->query = "
				SELECT * FROM tbl_admin
				WHERE admin_id = '".$_SESSION["admin_id"]."' 
				";

				$result = $object->get_result();

				foreach($result as $row)
				{

					if(password_verify($_POST["ocapass"], $row["admin_password"]))
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
				SELECT * FROM tbl_admin
				WHERE admin_id = '".$_SESSION["admin_id"]."' 
				";

				$result = $object->get_result();

				foreach($result as $row)
				{

					if(password_verify($_POST["ncapass"], $row["admin_password"]))
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
							UPDATE tbl_admin 
							SET admin_password = '".password_hash($new_password, PASSWORD_ARGON2I)."'
							WHERE admin_id = '".$_SESSION["admin_id"]."'       
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
		if($_POST["action"] == 'student_profile')
		{
			sleep(2);

			$error = '';

			$success = '';

			if($error == '')
			{
					$data = array(
						':sfname'						=>	$object->clean_input($_POST["sfname"]),
						':smname'						=>	$object->clean_input($_POST["smname"]),
						':slname'						=>	$object->clean_input($_POST["slname"]),
						':sdbirth'						=>	$object->clean_input($_POST["sdbirth"]),
						':saddress'						=>	$object->clean_input($_POST["saddress"]),
						':sccourse'						=>	$object->clean_input($_POST["sccourse"]),
						':scsyrlvl'						=>	$object->clean_input($_POST["scsyrlvl"])
					);

					$object->query = "
					UPDATE tbl_student  
					SET sfname = :sfname, 
					smname = :smname, 
					slname = :slname, 
					sdbirth = :sdbirth, 
					saddress = :saddress, 
					sccourse = :sccourse, 
					scsyrlvl = :scsyrlvl
					WHERE s_id = '".$_SESSION["admin_id"]."'
					";
					$object->execute($data);

					$success = '<div class="alert alert-success">Student Data Updated</div>';			

				$output = array(
					'error'					=>	$error,
					'success'				=>	$success,
					'sfname'				=>	$_POST["sfname"],
					'smname'				=>	$_POST["smname"],
					'slname'				=>	$_POST["slname"],
					'sdbirth'				=>	$_POST["sdbirth"],
					'saddress'				=>	$_POST["saddress"],
					'sccourse'				=>	$_POST["sccourse"],
					'scsyrlvl'				=>	$_POST["scsyrlvl"]
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
	// Input New Email
		if($_POST['action'] == 'cemail')
		{
			$error = '';

			$success = '';

			$data = array(
				':nssemail'	=>	$_POST["nssemail"]
			);

			$object->query = "
			SELECT * FROM tbl_student
			WHERE semail = :nssemail
			";

			$object->execute($data);

			if($object->row_count() > 0)
			{
				$error = '<div class="alert alert-danger">Email Already Exists</div>';
			}
			else
			{

				$object->query = "
				UPDATE tbl_student 
				SET semail = :nssemail,
				s_verification_code = :s_verification_code,
				s_email_verify = :s_email_verify
				WHERE s_id = '".$_SESSION["admin_id"]."'       
				";

				// Generate Verifcation Code
				$s_verification_code = rand(100000, 999999);

				$data = array(
					':nssemail'			    		=>	$_POST["nssemail"],
					':s_verification_code'	        =>	$s_verification_code,
					':s_email_verify'			    =>	'No'
					
				);

					// Load composer's autoloader
					require '../vendor/autoload.php';
				
					$mail = new PHPMailer\PHPMailer\PHPMailer();                            
					try {
						//Server settings
						$mail->isSMTP();                                     
						$mail->Host = 'smtp.gmail.com';                      
						$mail->SMTPAuth = true;                             
						$mail->Username = 'unswaa20@gmail.com';     
						$mail->Password = 'sio@1231999';             
						$mail->SMTPOptions = array(
							'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
							)
						);                         
						$mail->SMTPSecure = 'ssl';                           
						$mail->Port = 465;                                   
				
						//Send Email
						$mail->setFrom('unswaa20@gmail.com');
						$mail->FromName = 'Unswaa20';
						
						//Recipients
						$mail->addAddress($_POST["nssemail"]);            
						$mail->addReplyTo('unswaa20@gmail.com');
						$mail->WordWrap = 50;

						//Content
						$mail->isHTML(true);                                  
						$mail->Subject = 'Verification code for Verify Your Email Address';
						$message_body = '
						<p>For verify your email address, Please enter this verification code when prompted: <b>'.$s_verification_code.'</b>.</p>
						';
						$mail->Body = $message_body;
				
						$mail->send();

						$success = '<div class="alert alert-success">Please Check Your Email for email Verification</div>';

					} catch (Exception $e) {
						$error = '<div class="alert alert-danger">' . $mail->ErrorInfo . '</div>';
					}

					$object->execute($data);
			}

			$output = array(
				'error'		=>	$error,
				'success'	=>	$success
			);
			echo json_encode($output);
		}
	// Input Email OTP
		if($_POST['action'] == 'otpcemail')
		{
			$error = '';

			$success = '';

			$data = array(
				':otpcemail'	=>	$_POST["otpcemail"]
			);

			$object->query = "
			SELECT * FROM tbl_student
			WHERE s_verification_code = :otpcemail
			";

			$object->execute($data);

			if($object->row_count() > 0)
			{
				$object->query = "
				UPDATE tbl_student 
				SET s_email_verify = :s_email_verify
				WHERE s_id = '".$_SESSION["admin_id"]."'       
				";

				$data = array(
					':s_email_verify'			    =>	'Yes'
				);

				$success = '<div class="alert alert-success">Email Successfully Changed</div>';

				$object->execute($data);
			}
			else
			{
				$error = '<div class="alert alert-danger">Invalid OTP Number</div>';	
			}

			$output = array(
				'error'		=>	$error,
				'success'	=>	$success
			);
			echo json_encode($output);
		}
	// Old Password
		if($_POST['action'] == 'copass')
		{
			$error = '';

			$success = '';

			$object->query = "
			SELECT * FROM tbl_student
			WHERE s_id = '".$_SESSION["admin_id"]."' 
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
			SELECT * FROM tbl_student
			WHERE s_id = '".$_SESSION["admin_id"]."' 
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
						UPDATE tbl_student 
						SET spass = '".password_hash($new_password, PASSWORD_ARGON2I)."'
						WHERE s_id = '".$_SESSION["admin_id"]."'       
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