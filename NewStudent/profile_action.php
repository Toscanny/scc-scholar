<?php

// user
	// user Profile
		if($_POST["action"] == 'user_profile')
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

				$success = '<div class="alert alert-success">User Data Updated</div>';

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
					WHERE s_id = '".$_SESSION["S_id"]."'
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
				WHERE s_id = '".$_SESSION["S_id"]."'       
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
				WHERE s_id = '".$_SESSION["S_id"]."'       
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
			WHERE s_id = '".$_SESSION["S_id"]."' 
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
			WHERE s_id = '".$_SESSION["S_id"]."' 
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
						WHERE s_id = '".$_SESSION["S_id"]."'       
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