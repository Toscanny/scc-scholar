<?php

include('../class/dbcon.php');

require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// use PHPMailer\PHPMailer\PHPMailer;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

$object = new sms;

// Search and Table
	if(isset($_POST["action"]))
	{
		if($_POST["action"] == 'fetch')
		{

			$order_column = array('slname', 'sfname', 'scontact', 'semail', 's_account_status', 's_applied_on');
			/* Common Data
				+slname, +sfname, +smname, +sdbirth, +scontact, +sgender, +semail, +s_account_status		
			*/
			$output = array();
			
			$main_query = "
			SELECT * FROM tbl_student WHERE s_account_status != ''
			";

			$search_query = '';
			
			if(isset($_POST['search']['value']))
			{
				
				$search_query .= 'AND(slname LIKE "%'.$_POST['search']['value'].'%" '; 
				$search_query .= 'OR sfname LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR sccourse LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR syrlvl LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR scontact LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR semail LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR s_account_status LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR s_scholarship_type LIKE "%'.$_POST['search']['value'].'%" )';
			}

			if(isset($_POST["order"]))
			{
				$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
			}
			else
			{
				$order_query = 'ORDER BY slname ASC ';
			}

			$limit_query = '';

			if($_POST["length"] != -1)
			{
				$limit_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
			}

			$object->query = $main_query .$search_query .$order_query;

			$object->execute();

			$filtered_rows = $object->row_count();

			$object->query .= $limit_query;

			$result = $object->get_result();

			$object->query = $main_query;

			$object->execute();

			$total_rows = $object->row_count();

			$data = array();

					foreach($result as $row)
					{
						$sub_array = array();
						$sub_array[] = $check = '<div style="text-align: center;"><input type="checkbox" name="checkbox" id="checkbox" class="checkbox" value="'.$row["s_id"].'" data-email="'.$row["semail"].'" data-sms="'.$row["scontact"].'"/></div>';
						$sub_array[] = $row["slname"];
						$sub_array[] = $row["sfname"];
						$sub_array[] = $row["sccourse"];
						$sub_array[] = $row["syrlvl"];
						$sub_array[] = $row["scontact"];
						$sub_array[] = $row["semail"];
						$status = '';
						if($row["s_account_status"] == 'Active')
						{
							$status = '<button type="button" name="status_button" class="btn btn-warning btn-sm status_button" data-id="'.$row["s_id"].'" data-status="'.$row["s_account_status"].'">Active</button>';
						}
						else
						{
							$status = '<button type="button" name="status_button" class="btn btn-info btn-sm status_button" data-id="'.$row["s_id"].'" data-status="'.$row["s_account_status"].'">Inactive</button>';
						}
						$sub_array[] = $status;
						$sub_array[] = $row["s_scholarship_type"];
						$sub_array[] = '
						<div align="center">
							<button type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" data-id="'.$row["s_id"].'"><i class="fas fa-eye"></i></button>
							<button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id="'.$row["s_id"].'"><i class="fas fa-edit"></i></button>
							<button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="'.$row["s_id"].'"><i class="fas fa-times"></i></button>
						</div>
						';
						$data[] = $sub_array;
					}
		
					$output = array(
						"draw"    			=> 	intval($_POST["draw"]),
						"recordsTotal"  	=>  $total_rows,
						"recordsFiltered" 	=> 	$filtered_rows,
						"data"    			=> 	$data
					);
						
					echo json_encode($output);
				
		}

// Add_acad Query
	if($_POST["action"] == 'add_acad')
	{
		$error = '';

		$success = '';

		$data = array(
			':semail'	=>	$_POST["semail"]
		);

		$object->query = "
		SELECT * FROM tbl_student
		WHERE semail = :semail
		";

		$object->execute($data);

		if($object->row_count() > 0)
		{
			$error = '<div class="alert alert-danger">Email Address Already Exists</div>';
		}
		else
		{
			$object->query = "
			INSERT INTO tbl_student
			(ss_id, sfname, smname, slname, snext, sdbirth, sgender, sctship, saddress, semail, scontact, sccourse, scsyrlvl, sgfname, 
			sgaddress, sgcontact, sgoccu, sgcompany, sffname, sfaddress, sfcontact, sfoccu, sfcompany, smfname, smaddress, smcontact, 
			smoccu, smcompany, spcyincome, spsgwa, spsraward, spsdawardrceive, spass, sdsprc, sdsprcstat, sdspgm, sdspgmstat, sdspcr, sdspcrstat, 
			s_verification_code, s_email_verify, s_account_status, s_scholarship_note, s_account_status, s_scholarship_type, s_applied_on) 
			VALUES (:ss_id, :sfname, :smname, :slname, :snext, :sdbirth, :sgender, :sctship, :saddress, :semail, :scontact, :sccourse, :scsyrlvl, 
			:sgfname, :sgaddress, :sgcontact, :sgoccu, :sgcompany, :sffname, :sfaddress, :sfcontact, :sfoccu, :sfcompany, :smfname, 
			:smaddress, :smcontact, :smoccu, :smcompany, :spcyincome, :spsgwa, :spsraward, :spsdawardrceive, :spass, :sdsprc, :sdsprcstat, 
			:sdspgm, :sdspgmstat, :sdspcr, :sdspcrstat, :s_verification_code, 'No', 'Active', :s_scholarship_note, :s_account_status, 'Academic', '$object->now')";

			if($error == '')
			{
				// Generate Verifcation Code
				$s_verification_code = md5(uniqid());
				// Generate Random Password
				$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
				$password = substr( str_shuffle( $chars ), 0, 8 );
	
				$hash = password_hash($password, PASSWORD_ARGON2I);

				$data = array(
					// Student ID Details
					':ss_id'					    =>	$object->clean_input($_POST["ss_id"]),
					// Personal Details
                    ':sfname'					    =>	$object->clean_input($_POST["sfname"]),
                    ':smname'					    =>	$object->clean_input($_POST["smname"]),
                    ':slname'					    =>	$object->clean_input($_POST["slname"]),
					':snext'					  	=>	$object->clean_input($_POST["snext"]),
                    ':sdbirth'					  	=>	$object->clean_input($_POST["sdbirth"]),
					':sgender'					  	=>	$object->clean_input($_POST["sgender"]),
					':sctship'				    	=>	$object->clean_input($_POST["sctship"]),
                    ':saddress'						=>	$object->clean_input($_POST["saddress"]),
                    ':semail'					    =>	$object->clean_input($_POST["semail"]),
                    ':scontact'						=>	$object->clean_input($_POST["scontact"]),
					':sccourse'						=>	$object->clean_input($_POST["sccourse"]),
					':scsyrlvl'						=>	$object->clean_input($_POST["scsyrlvl"]),
					// Family Details
					// Guardian Details
					':sgfname'				      	=>	$object->clean_input($_POST["sgfname"]),
                    ':sgaddress'					=>	$object->clean_input($_POST["sgaddress"]),
                    ':sgcontact'					=>	$object->clean_input($_POST["sgcontact"]),
                    ':sgoccu'					    =>	$object->clean_input($_POST["sgoccu"]),
                    ':sgcompany'					=>	$object->clean_input($_POST["sgcompany"]),
					// Father Details
					':sffname'				      	=>	$object->clean_input($_POST["sffname"]),
                    ':sfaddress'					=>	$object->clean_input($_POST["sfaddress"]),
                    ':sfcontact'					=>	$object->clean_input($_POST["sfcontact"]),
					':sfoccu'				      	=>	$object->clean_input($_POST["sfoccu"]),
					':sfcompany'				   	=>	$object->clean_input($_POST["sfcompany"]),
					// Mother Details
					':smfname'				      	=>	$object->clean_input($_POST["smfname"]),
                    ':smaddress'					=>	$object->clean_input($_POST["smaddress"]),
                    ':smcontact'					=>	$object->clean_input($_POST["smcontact"]),
					':smoccu'				      	=>	$object->clean_input($_POST["smoccu"]),
					':smcompany'				    =>	$object->clean_input($_POST["smcompany"]),
                    ':spcyincome'				  	=>	$object->clean_input($_POST["spcyincome"]),
					// Achievement Details
                    ':spsgwa'				      	=>	$object->clean_input($_POST["spsgwa"]),
                    ':spsraward'					=>	$object->clean_input($_POST["spsraward"]),
                    ':spsdawardrceive'		  		=>	$object->clean_input($_POST["spsdawardrceive"]),
					// Password
					':spass'				        =>	$hash,
					// Verification Code
					':s_verification_code'	        =>	$s_verification_code,
					// Requirements Details
					':sdsprc'				    	=>	$object->clean_input($_POST["sdsprc"]),
                    ':sdsprcstat'				    =>	$object->clean_input($_POST["sdsprcstat"]),
					':sdspgm'						=>	$object->clean_input($_POST["sdspgm"]),
                    ':sdspgmstat'					=>	$object->clean_input($_POST["sdspgmstat"]),
					':sdspcr'		  				=>	$object->clean_input($_POST["sdspcr"]),
                    ':sdspcrstat'		  			=>	$object->clean_input($_POST["sdspcrstat"]),
					// Scholarship Note
					':s_scholarship_note'		  	=>	$object->clean_input($_POST["s_scholarship_note"]),
					// Scholarship Details
					':s_account_status'		  		=>	$object->clean_input($_POST["s_account_status"])
 				);

					// // Load composer's autoloader
					// require '../vendor/autoload.php';

					// $mail = new PHPMailer\PHPMailer\PHPMailer();                            
					// try {
					// 	//Server settings
					// 	$mail->isSMTP();                                     
					// 	$mail->Host = 'smtp.gmail.com';                      
					// 	$mail->SMTPAuth = true;                             
					// 	$mail->Username = 'unswaa20@gmail.com';     
					// 	$mail->Password = 'sio@1231999';             
					// 	$mail->SMTPOptions = array(
					// 		'ssl' => array(
					// 		'verify_peer' => false,
					// 		'verify_peer_name' => false,
					// 		'allow_self_signed' => true
					// 		)
					// 	);                         
					// 	$mail->SMTPSecure = 'ssl';                           
					// 	$mail->Port = 465;                                   
				
					// 	//Send Email
					// 	$mail->setFrom('unswaa20@gmail.com');
					// 	$mail->FromName = 'Unswaa20';
						
					// 	//Recipients
					// 	$mail->addAddress($_POST["semail"]);            
					// 	$mail->addReplyTo('unswaa20@gmail.com');
					// 	$mail->WordWrap = 50;
	
					// 	//Content
					// 	$mail->isHTML(true);                                  
					// 	$mail->Subject = 'Verification code for Verify Your Email Address';
					// 	$message_body = '
					// 	<p>For verify your email address, Please click on this <a href="'.$object->base_url.'admin/register_verify.php?code='.$s_verification_code.'"><b>link</b></a>.</p>
					// 	<p>Input this information to login.</p>
					// 	<p>Username: '.$_POST["semail"].'</p>
					// 	<p>Password: '.$password.'</p>
					// 	<p>Sincerely,</p>
					// 	<p>Unswaa20</p>
					// 	';
					// 	$mail->Body = $message_body;
				
					// 	$mail->send();
	
					// 	$success = '<div class="alert alert-success">Please Check Your Email for email Verification</div>';
	
					// } catch (Exception $e) {
					// 	$error = '<div class="alert alert-danger">' . $mail->ErrorInfo . '</div>';
					// }

				$object->execute($data);

				$success = '<div class="alert alert-success">Student Data Added</div>';
			}
		}

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);

	}

// Add_nonacad Query
		if($_POST["action"] == 'add_nonacad')
		{
			$error = '';

			$success = '';

			$data = array(
				':snemail'	=>	$_POST["snemail"]
			);

			$object->query = "
			SELECT * FROM tbl_student
			WHERE semail = :snemail
			";

			$object->execute($data);

			if($object->row_count() > 0)
			{
				$error = '<div class="alert alert-danger">Email Address Already Exists</div>';
			}
			else
			{

				$object->query = "
				INSERT INTO tbl_student
				(ss_id, sfname, smname, slname, snext, sdbirth, sgender, sctship, saddress, semail, scontact, sccourse, 
				scsyrlvl, sgfname, sgaddress, sgcontact, sgoccu, sgcompany, sffname, sfaddress, sfcontact, sfoccu, 
				sfcompany, smfname, smaddress, smcontact, smoccu, smcompany, spcyincome, srappnas, sbos, ssskills, 
				stwinterest, spschname, spsaddress, spsyrlvl, spass, s_verification_code, sdsprc, sdsprcstat, sdspgm, 
				sdspgmstat, sdstbytpic, sdstbytpicstat, sdsbrgyin, sdsbrgyinstat, sdscef, sdscefstat, s_email_verify, 
				s_account_status, s_scholarship_note, s_account_status, s_scholarship_type, s_applied_on) 
				VALUES (:sns_id, :snfname, :snmname, :snlname, :snnext, :sndbirth, :sngender, :snctship, :snaddress, :snemail, :sncontact, 
				:snccourse, :sncsyrlvl, :sngfname, :sngaddress, :sngcontact, :sngoccu, :sngcompany, :snffname, :snfaddress, :snfcontact, 
				:snfoccu, :snfcompany, :snmfname, :snmaddress, :snmcontact, :snmoccu, :snmcompany, :snpcyincome, :snrappnas, :snbos, 
				:snsskills, :sntwinterest, :snpschname, :snpsaddress, :snpsyrlvl, :snpass, :sn_verification_code, :sndsprc, :sndsprcstat, :sndspgm, 
				:sndspgmstat, :sndstbytpic, :sndstbytpicstat, :sndsbrgyin, :sndsbrgyinstat, :sndscef, :sndscefstat, 
				'No', 'Active', :sn_scholarship_note, :sn_scholar_stat, 'Non-Academic', '$object->now')";
				
				

				if($error == '')
				{

					// Generate Verifcation Code
					$sn_verification_code = md5(uniqid());
					// Generate Random Password
					$snchars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
					$snpassword = substr( str_shuffle( $snchars ), 0, 8 );
		
					$snhash = password_hash($snpassword, PASSWORD_ARGON2I);

					$data = array(
				// Student ID Details
						':sns_id'					    =>	$object->clean_input($_POST["sns_id"]),
				// Personal Details
						':snfname'					    =>	$object->clean_input($_POST["snfname"]),
						':snmname'					    =>	$object->clean_input($_POST["snmname"]),
						':snlname'					    =>	$object->clean_input($_POST["snlname"]),
						':snnext'					  	=>	$object->clean_input($_POST["snnext"]),
						':sndbirth'					  	=>	$object->clean_input($_POST["sndbirth"]),
						':sngender'					  	=>	$object->clean_input($_POST["sngender"]),
						':snctship'				    	=>	$object->clean_input($_POST["snctship"]),
						':snaddress'					=>	$object->clean_input($_POST["snaddress"]),
						':snemail'					    =>	$object->clean_input($_POST["snemail"]),
						':sncontact'					=>	$object->clean_input($_POST["sncontact"]),
						':snccourse'					=>	$object->clean_input($_POST["snccourse"]),
						':sncsyrlvl'					=>	$object->clean_input($_POST["sncsyrlvl"]),
				// Family Details
					// Guardian Details
						':sngfname'				      	=>	$object->clean_input($_POST["sngfname"]),
						':sngaddress'					=>	$object->clean_input($_POST["sngaddress"]),
						':sngcontact'					=>	$object->clean_input($_POST["sngcontact"]),
						':sngoccu'					    =>	$object->clean_input($_POST["sngoccu"]),
						':sngcompany'					=>	$object->clean_input($_POST["sngcompany"]),
					// Father Details
						':snffname'				      	=>	$object->clean_input($_POST["snffname"]),
						':snfaddress'					=>	$object->clean_input($_POST["snfaddress"]),
						':snfcontact'					=>	$object->clean_input($_POST["snfcontact"]),
						':snfoccu'				      	=>	$object->clean_input($_POST["snfoccu"]),
						':snfcompany'				   	=>	$object->clean_input($_POST["snfcompany"]),
					// Mother Details
						':snmfname'				      	=>	$object->clean_input($_POST["snmfname"]),
						':snmaddress'					=>	$object->clean_input($_POST["snmaddress"]),
						':snmcontact'					=>	$object->clean_input($_POST["snmcontact"]),
						':snmoccu'				      	=>	$object->clean_input($_POST["snmoccu"]),
						':snmcompany'				    =>	$object->clean_input($_POST["snmcompany"]),
						':snpcyincome'				  	=>	$object->clean_input($_POST["snpcyincome"]),
				// Application Details
						':snrappnas'				    =>	$object->clean_input($_POST["snrappnas"]),
						':snbos'					  	=>	$object->clean_input($_POST["snbos"]),
						':snsskills'		  			=>	$object->clean_input($_POST["snsskills"]),
						':sntwinterest'		  			=>	$object->clean_input($_POST["sntwinterest"]),
				// Education Details
						':snpschname'				    =>	$object->clean_input($_POST["snpschname"]),
						':snpsaddress'					=>	$object->clean_input($_POST["snpsaddress"]),
						':snpsyrlvl'		  			=>	$object->clean_input($_POST["snpsyrlvl"]),
				// Password
						':snpass'				        =>	$snhash,
				// Verification Code
						':sn_verification_code'	        =>	$sn_verification_code,
				// Requirements Details
						':sndsprc'				   		=>	$object->clean_input($_POST["sndsprc"]),
						':sndsprcstat'					=>	$object->clean_input($_POST["sndsprcstat"]),
						':sndspgm'		  				=>	$object->clean_input($_POST["sndspgm"]),
						':sndspgmstat'				    =>	$object->clean_input($_POST["sndspgmstat"]),
						':sndstbytpic'					=>	$object->clean_input($_POST["sndstbytpic"]),
						':sndstbytpicstat'		  		=>	$object->clean_input($_POST["sndstbytpicstat"]),
						':sndsbrgyin'				   	=>	$object->clean_input($_POST["sndsbrgyin"]),
						':sndsbrgyinstat'				=>	$object->clean_input($_POST["sndsbrgyinstat"]),
						':sndscef'		  				=>	$object->clean_input($_POST["sndscef"]),
						':sndscefstat'		  			=>	$object->clean_input($_POST["sndscefstat"]),
				// Scholarship Note
						':sn_scholarship_note'		  		=>	$object->clean_input($_POST["sn_scholarship_note"]),
				// Scholarship Details
						':sn_scholar_stat'		  		=>	$object->clean_input($_POST["sn_scholar_stat"])
					);

					// // Load composer's autoloader
					// require '../vendor/autoload.php';

					// $mail = new PHPMailer\PHPMailer\PHPMailer();                            
					// try {
					// 	//Server settings
					// 	$mail->isSMTP();                                     
					// 	$mail->Host = 'smtp.gmail.com';                      
					// 	$mail->SMTPAuth = true;                             
					// 	$mail->Username = 'unswaa20@gmail.com';     
					// 	$mail->Password = 'sio@1231999';             
					// 	$mail->SMTPOptions = array(
					// 		'ssl' => array(
					// 		'verify_peer' => false,
					// 		'verify_peer_name' => false,
					// 		'allow_self_signed' => true
					// 		)
					// 	);                         
					// 	$mail->SMTPSecure = 'ssl';                           
					// 	$mail->Port = 465;                                   
				
					// 	//Send Email
					// 	$mail->setFrom('unswaa20@gmail.com');
					// 	$mail->FromName = 'Unswaa20';
						
					// 	//Recipients
					// 	$mail->addAddress($_POST["snemail"]);            
					// 	$mail->addReplyTo('unswaa20@gmail.com');
					// 	$mail->WordWrap = 50;
	
					// 	//Content
					// 	$mail->isHTML(true);                                  
					// 	$mail->Subject = 'Verification code for Verify Your Email Address';
					// 	$message_body = '
					// 	<p>For verify your email address, Please click on this <a href="'.$object->base_url.'admin/register_verify.php?code='.$s_verification_code.'"><b>link</b></a>.</p>
					// 	<p>Input this information to login.</p>
					// 	<p>Username: '.$_POST["snemail"].'</p>
					// 	<p>Password: '.$snpassword.'</p>
					// 	<p>Sincerely,</p>
					// 	<p>Unswaa20</p>
					// 	';
					// 	$mail->Body = $message_body;
				
					// 	$mail->send();
	
					// 	$success = '<div class="alert alert-success">Please Check Your Email for email Verification</div>';
	
					// } catch (Exception $e) {
					// 	$error = '<div class="alert alert-danger">' . $mail->ErrorInfo . '</div>';
					// }

					$object->execute($data);

					$success = '<div class="alert alert-success">Student Data Added</div>';
				}
			}

			$output = array(
				'error'		=>	$error,
				'success'	=>	$success
			);

			echo json_encode($output);

		}
// Add Unifast Query
		if($_POST["action"] == 'add_unifast')
		{
			$error = '';

			$success = '';

			$data = array(
				':susemail'	=>	$_POST["susemail"]
			);

			$object->query = "
			SELECT * FROM tbl_student
			WHERE semail = :susemail
			";

			$object->execute($data);

			if($object->row_count() > 0)
			{
				$error = '<div class="alert alert-danger">Email Address Already Exists</div>';
			}
			else
			{
				$object->query = "
				INSERT INTO tbl_student
				(ss_id, slname, sfname, smname, snext, sgender, sdbirth, scontact, saddress, spschname, semail, spscourse, 
				spsyrlvl, sccourse, scsyrlvl, sffname, smfname, s4psno, spcyincome, spwdid, ssdfile, sdstbytpic, sdstbytpicstat, 
				sdspsa, sdspsastat, sdsbrgyin, sdsbrgyinstat, spass, s_verification_code, s_email_verify, 
				s_account_status, s_scholarship_note, s_account_status, s_scholarship_type, s_applied_on) 
				VALUES (:sus_id, :suslname, :susfname, :susmname, :susnext, :susgender, :susdbirth, :suscontact, 
				:susaddress, :suspschname, :susemail, :suspscourse, :suspsyrlvl, :susccourse, :suscsyrlvl, :susffname, :susmfname, :sus4psno, 
				:suspcyincome, :suspwdid, :sussdfile, :susdstbytpic, :susdstbytpicstat, :susdspsa, :susdspsastat, 
				:susdsbrgyin, :susdsbrgyinstat, :suspass, :sus_verification_code, 'No', 'Active', :sus_scholarship_note, :sus_account_status, 
				'UNIFAST', '$object->now')";
				
				// Generate Verifcation Code
				$sus_verification_code = md5(uniqid());
				// Generate Random Password
				$suschars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
				$suspassword = substr( str_shuffle( $suschars ), 0, 8 );
	
				$sushash = password_hash($suspassword, PASSWORD_ARGON2I);

				if($error == '')
				{
					$data = array(
					// Student ID Details
						':sus_id'						=>	$object->clean_input($_POST["sus_id"]),
					// Personal Details
						':suslname'					    =>	$object->clean_input($_POST["suslname"]),
						':susfname'					    =>	$object->clean_input($_POST["susfname"]),
						':susmname'					    =>	$object->clean_input($_POST["susmname"]),
						':susnext'					  	=>	$object->clean_input($_POST["susnext"]),
						':susgender'					=>	$object->clean_input($_POST["susgender"]),
						':susdbirth'					=>	$object->clean_input($_POST["susdbirth"]),
						':suscontact'					=>	$object->clean_input($_POST["suscontact"]),
						':susaddress'					=>	$object->clean_input($_POST["susaddress"]),
						':susemail'				    	=>	$object->clean_input($_POST["susemail"]),
						':suspschname'					=>	$object->clean_input($_POST["suspschname"]),
						':suspscourse'					=>	$object->clean_input($_POST["suspscourse"]),
						':suspsyrlvl'				    =>	$object->clean_input($_POST["suspsyrlvl"]),
						':susccourse'					=>	$object->clean_input($_POST["susccourse"]),
						':suscsyrlvl'				    =>	$object->clean_input($_POST["suscsyrlvl"]),
					// Family Details
						// Father Details
						':susffname'					=>	$object->clean_input($_POST["susffname"]),
						// Mother Details
						':susmfname'					=>	$object->clean_input($_POST["susmfname"]),
					// Other Details
						':sus4psno'				        =>	$object->clean_input($_POST["sus4psno"]),
						':suspcyincome'					=>	$object->clean_input($_POST["suspcyincome"]),
						':suspwdid'		  			    =>	$object->clean_input($_POST["suspwdid"]),
						':sussdfile'		  			=>	$object->clean_input($_POST["sussdfile"]),
					// Requirements Details
						':susdstbytpic'				   	=>	$object->clean_input($_POST["susdstbytpic"]),
						':susdstbytpicstat'				=>	$object->clean_input($_POST["susdstbytpicstat"]),
						':susdspsa'		  				=>	$object->clean_input($_POST["susdspsa"]),
						':susdspsastat'				    =>	$object->clean_input($_POST["susdspsastat"]),
						':susdsbrgyin'					=>	$object->clean_input($_POST["susdsbrgyin"]),
						':susdsbrgyinstat'		  		=>	$object->clean_input($_POST["susdsbrgyinstat"]),
					// Scholarship Note
						':sus_scholarship_note'			=>	$object->clean_input($_POST["sus_scholarship_note"]),
					// Scholarship Details
						':sus_account_status'		  		=>	$object->clean_input($_POST["sus_account_status"]),
					// Password
						':suspass'				        =>	$sushash,
					// Verification Code
						':sus_verification_code'	    =>	$sus_verification_code

					);

					// // Load composer's autoloader
					// require '../vendor/autoload.php';

					// $mail = new PHPMailer\PHPMailer\PHPMailer();                            
					// try {
					// 	//Server settings
					// 	$mail->isSMTP();                                     
					// 	$mail->Host = 'smtp.gmail.com';                      
					// 	$mail->SMTPAuth = true;                             
					// 	$mail->Username = 'unswaa20@gmail.com';     
					// 	$mail->Password = 'sio@1231999';             
					// 	$mail->SMTPOptions = array(
					// 		'ssl' => array(
					// 		'verify_peer' => false,
					// 		'verify_peer_name' => false,
					// 		'allow_self_signed' => true
					// 		)
					// 	);                         
					// 	$mail->SMTPSecure = 'ssl';                           
					// 	$mail->Port = 465;                                   
				
					// 	//Send Email
					// 	$mail->setFrom('unswaa20@gmail.com');
					// 	$mail->FromName = 'Unswaa20';
						
					// 	//Recipients
					// 	$mail->addAddress($_POST["susemail"]);            
					// 	$mail->addReplyTo('unswaa20@gmail.com');
					// 	$mail->WordWrap = 50;
	
					// 	//Content
					// 	$mail->isHTML(true);                                  
					// 	$mail->Subject = 'Verification code for Verify Your Email Address';
					// 	$message_body = '
					// 	<p>For verify your email address, Please click on this <a href="'.$object->base_url.'admin/register_verify.php?code='.$s_verification_code.'"><b>link</b></a>.</p>
					// 	<p>Input this information to login.</p>
					// 	<p>Username: '.$_POST["susemail"].'</p>
					// 	<p>Password: '.$suspassword.'</p>
					// 	<p>Sincerely,</p>
					// 	<p>Unswaa20</p>
					// 	';
					// 	$mail->Body = $message_body;
				
					// 	$mail->send();
	
					// 	$success = '<div class="alert alert-success">Please Check Your Email for email Verification</div>';
	
					// } catch (Exception $e) {
					// 	$error = '<div class="alert alert-danger">' . $mail->ErrorInfo . '</div>';
					// }

					$object->execute($data);

					$success = '<div class="alert alert-success">Student Data Added</div>';
				}
			}

			$output = array(
				'error'		=>	$error,
				'success'	=>	$success
			);

			echo json_encode($output);

		}
// Add CHED Query
		if($_POST["action"] == 'add_ched')
		{
			$error = '';
	
			$success = '';
	
			$data = array(
				':scsemail'	=>	$_POST["scsemail"]
			);
	
			$object->query = "
			SELECT * FROM tbl_student
			WHERE semail = :scsemail
			";
	
			$object->execute($data);
	
			if($object->row_count() > 0)
			{
				$error = '<div class="alert alert-danger">Email Address Already Exists</div>';
			}
			else
			{
				$object->query = "
				INSERT INTO tbl_student
				(ss_id, sfname, smname, slname, snext, sdbirth, sgender, scivilstat, spbirth, saddress, szcode, 
				spschname, spsaddress,  spstype, spsyrlvl, sctship, scontact, semail, sdisability, sffname, sflstatus, 
				sfaddress, sfoccu, sfeduc, smfname, smlstatus, smaddress, smoccu, smeduc, spcyincome, snsibling, scsintend, 
				scsadd, scschooltype, sccourse, scsyrlvl, sccourseprio, sdsprc, sdsprcstat, sdsbrgyin, sdsbrgyinstat, sdspgm, sdspgmstat, 
				spass, s_verification_code, s_email_verify, s_account_status, s_scholarship_note, s_account_status, s_scholarship_type, s_applied_on) 
				VALUES (:scss_id, :scsfname, :scsmname, :scslname, :scsnext, :scsdbirth, :scsgender, :scscivilstat, :scspbirth, 
				:scsaddress, :scszcode, :scspschname, :scspsaddress, :scspstype, :scspsyrlvl, :scsctship, :scscontact, :scsemail, 
				:scsdisability, :scsffname, :scsflstatus, :scsfaddress, :scsfoccu, :scsfeduc, :scsmfname, :scsmlstatus, :scsmaddress, 
				:scsmoccu, :scsmeduc, :scspcyincome, :scsnsibling, :scscsintend, :scscsadd, :scscschooltype, :scsccourse, :scscsyrlvl, 
				:scsccourseprio, :scsdsprc, :scsdsprcstat, :scsdsbrgyin, :scsdsbrgyinstat, :scsdspgm, :scsdspgmstat, :scspass, 
				:sc_verification_code, 'No', 'Active', :scs_scholarship_note, :scs_account_status, 'CHED', '$object->now')";
				
				// Generate Verifcation Code
				$sc_verification_code = md5(uniqid());
				// Generate Random Password
				$scchars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
				$scpassword = substr( str_shuffle( $scchars ), 0, 8 );
	
				$schash = password_hash($scpassword, PASSWORD_ARGON2I);
	
				if($error == '')
				{
					$data = array(
					// Student ID Details
						':scss_id'					    =>	$object->clean_input($_POST["scss_id"]),
					// Personal Details
						':scsfname'					    =>	$object->clean_input($_POST["scsfname"]),
						':scsmname'					    =>	$object->clean_input($_POST["scsmname"]),
						':scslname'					    =>	$object->clean_input($_POST["scslname"]),
						':scsnext'					  	=>	$object->clean_input($_POST["scsnext"]),
						':scsdbirth'					=>	$object->clean_input($_POST["scsdbirth"]),
						':scsgender'					=>	$object->clean_input($_POST["scsgender"]),
						':scscivilstat'				    =>	$object->clean_input($_POST["scscivilstat"]),
						':scspbirth'					=>	$object->clean_input($_POST["scspbirth"]),
						':scsaddress'					=>	$object->clean_input($_POST["scsaddress"]),
						':scszcode'						=>	$object->clean_input($_POST["scszcode"]),
						':scspschname'					=>	$object->clean_input($_POST["scspschname"]),
						':scspsaddress'					=>	$object->clean_input($_POST["scspsaddress"]),
						':scspstype'					=>	$object->clean_input($_POST["scspstype"]),
						':scspsyrlvl'					=>	$object->clean_input($_POST["scspsyrlvl"]),
						':scsctship'					=>	$object->clean_input($_POST["scsctship"]),
						':scscontact'					=>	$object->clean_input($_POST["scscontact"]),
						':scsemail'					    =>	$object->clean_input($_POST["scsemail"]),
						':scsdisability'				=>	$object->clean_input($_POST["scsdisability"]),
					// Family Details
						// Father Details
						':scsffname'				    =>	$object->clean_input($_POST["scsffname"]),
						':scsflstatus'			        =>	$object->clean_input($_POST["scsflstatus"]),
						':scsfaddress'					=>	$object->clean_input($_POST["scsfaddress"]),
						':scsfoccu'				      	=>	$object->clean_input($_POST["scsfoccu"]),
						':scsfeduc'					    =>	$object->clean_input($_POST["scsfeduc"]),
						// Mother Details
						':scsmfname'				    =>	$object->clean_input($_POST["scsmfname"]),
						':scsmlstatus'			        =>	$object->clean_input($_POST["scsmlstatus"]),
						':scsmaddress'					=>	$object->clean_input($_POST["scsmaddress"]),
						':scsmoccu'				      	=>	$object->clean_input($_POST["scsmoccu"]),
						':scsmeduc'					    =>	$object->clean_input($_POST["scsmeduc"]),
						':scspcyincome'				  	=>	$object->clean_input($_POST["scspcyincome"]),
						':scsnsibling'					=>	$object->clean_input($_POST["scsnsibling"]),
					// Education Details
						':scscsintend'				    =>	$object->clean_input($_POST["scscsintend"]),
						':scscsadd'					    =>	$object->clean_input($_POST["scscsadd"]),
						':scscschooltype'		  		=>	$object->clean_input($_POST["scscschooltype"]),
						':scsccourse'				    =>	$object->clean_input($_POST["scsccourse"]),
						':scscsyrlvl'				    =>	$object->clean_input($_POST["scscsyrlvl"]),
						':scsccourseprio'				=>	$object->clean_input($_POST["scsccourseprio"]),
					// Requirements Details
						':scsdsprc'				   		=>	$object->clean_input($_POST["scsdsprc"]),
						':scsdsprcstat'					=>	$object->clean_input($_POST["scsdsprcstat"]),
						':scsdspgm'		  				=>	$object->clean_input($_POST["scsdspgm"]),
						':scsdspgmstat'				    =>	$object->clean_input($_POST["scsdspgmstat"]),
						':scsdsbrgyin'				    =>	$object->clean_input($_POST["scsdsbrgyin"]),
						':scsdsbrgyinstat'				=>	$object->clean_input($_POST["scsdsbrgyinstat"]),
					// Scholarship Note
						':scs_scholarship_note'			=>	$object->clean_input($_POST["scs_scholarship_note"]),
					// Scholarship Details
						':scs_account_status'			=>	$object->clean_input($_POST["scs_account_status"]),
					// Password
						':scspass'				        =>	$schash,
					// Verification Code
						':sc_verification_code'	    	=>	$sc_verification_code
					);

					// // Load composer's autoloader
					// require '../vendor/autoload.php';

					// $mail = new PHPMailer\PHPMailer\PHPMailer();                            
					// try {
					// 	//Server settings
					// 	$mail->isSMTP();                                     
					// 	$mail->Host = 'smtp.gmail.com';                      
					// 	$mail->SMTPAuth = true;                             
					// 	$mail->Username = 'unswaa20@gmail.com';     
					// 	$mail->Password = 'sio@1231999';             
					// 	$mail->SMTPOptions = array(
					// 		'ssl' => array(
					// 		'verify_peer' => false,
					// 		'verify_peer_name' => false,
					// 		'allow_self_signed' => true
					// 		)
					// 	);                         
					// 	$mail->SMTPSecure = 'ssl';                           
					// 	$mail->Port = 465;                                   
				
					// 	//Send Email
					// 	$mail->setFrom('unswaa20@gmail.com');
					// 	$mail->FromName = 'Unswaa20';
						
					// 	//Recipients
					// 	$mail->addAddress($_POST["scsemail"]);            
					// 	$mail->addReplyTo('unswaa20@gmail.com');
					// 	$mail->WordWrap = 50;
	
					// 	//Content
					// 	$mail->isHTML(true);                                  
					// 	$mail->Subject = 'Verification code for Verify Your Email Address';
					// 	$message_body = '
					// 	<p>For verify your email address, Please click on this <a href="'.$object->base_url.'admin/register_verify.php?code='.$s_verification_code.'"><b>link</b></a>.</p>
					// 	<p>Input this information to login.</p>
					// 	<p>Username: '.$_POST["scsemail"].'</p>
					// 	<p>Password: '.$scpassword.'</p>
					// 	<p>Sincerely,</p>
					// 	<p>Unswaa20</p>
					// 	';
					// 	$mail->Body = $message_body;
				
					// 	$mail->send();
	
					// 	$success = '<div class="alert alert-success">Please Check Your Email for email Verification</div>';
	
					// } catch (Exception $e) {
					// 	$error = '<div class="alert alert-danger">' . $mail->ErrorInfo . '</div>';
					// }
	
					$object->execute($data);
	
					$success = '<div class="alert alert-success">Student Data Added</div>';
				}
			}
	
			$output = array(
				'error'		=>	$error,
				'success'	=>	$success
			);
	
			echo json_encode($output);
	
		}
// Upload
	if($_POST["action"] == 'upload')
	{

		$error = '';

		$html = '';

		if($_FILES['file']['name'] != '')
		{
		$file_array = explode(".", $_FILES['file']['name']);

		$extension = end($file_array);

		if($extension == 'csv')
		{
		$file_data = fopen($_FILES['file']['tmp_name'], 'r');

		$file_header = fgetcsv($file_data);

		$html .= '<table class="table table-bordered" style="min-width: 200px;"><tr style="min-width: 200px;">';

		for($count = 0; $count < count($file_header); $count++)
		{
		$html .= '
		<th style="min-width: 200px;">
			<select name="set_column_data" class="form-control set_column_data" data-column_number="'.$count.'">
				<option value="">Select Data</option>
				<option value="ss_id">Student ID No.</option>
				<option value="sfname">First Name</option>
				<option value="smname">Middle Name</option>
				<option value="slname">Last Name</option>
				<option value="snext">Name Ext.</option>
				<option value="sdbirth">Date of Birth</option>
				<option value="sgender">Gender</option>
				<option value="saddress">Address</option>
				<option value="szcode">Zip Code</option>
				<option value="scontact">Contact Number</option>
				<option value="semail">Email</option>
				<option value="sctship">Citizenship</option>
				<option value="scivilstat">Civil Status</option>
				<option value="spbirth">Place of Birth</option>
				<option value="sdisability">Disability ID No.</option>
				<option value="s4psno">4PS No.</option>
				<option value="spwdid">PWD ID</option>
				<option value="srappsship">Reason Applying Scholarship</option>
				<option value="srappnas">Reason Applying Non-Academic</option>
				<option value="sbos">Basic Office Skills</option>
				<option value="ssskills">Special Skills</option>
				<option value="stwinterest">Type of Work Interested In</option>
				<option value="ssdfile">Date Filed</option>
				<option value="sgfname">Guardian Full Name</option>
				<option value="sgmname">Guardian Middle Name</option>
				<option value="sglname">Guardian Last Name</option>
				<option value="sgnext">Guardian Name Ext.</option>
				<option value="sglstatus">Guardian Life Status</option>
				<option value="sgeduc">Guardian Educational Attainment</option>
				<option value="sgcontact">Guardian Contact Number</option>
				<option value="sgaddress">Guardian Address</option>
				<option value="sgoccu">Guardian Occupation</option>
				<option value="sgcompany">Guardian Company</option>
				<option value="sffname">Father Full Name</option>
				<option value="sfmname">Father Middle Name</option>
				<option value="sflname">Father Last Name</option>
				<option value="sfnext">Father Name Ext.</option>
				<option value="sflstatus">Father Life Status</option>
				<option value="sfeduc">Father Educational Attainment</option>
				<option value="sfcontact">Father Contact</option>
				<option value="sfaddress">Father Address</option>
				<option value="sfoccu">Father Occupation</option>
				<option value="sfcompany">Father Company</option>
				<option value="smfname">Mother Full Name</option>
				<option value="smmname">Mother Middle Name</option>
				<option value="smlname">Mother Last Name</option>
				<option value="smnext">Mother Name Ext.</option>
				<option value="smlstatus">Mother Life Status</option>
				<option value="smeduc">Mother Educational Attainment</option>
				<option value="smcontact">Mother Contact</option>
				<option value="smaddress">Mother Address</option>
				<option value="smoccu">Mother Occupation</option>
				<option value="smcompany">Mother Company</option>
				<option value="snsibling">Number of Sibling</option>
				<option value="spcyincome">Parents Combine Yearly Income</option>
				<option value="spschname">Previous School Attended</option>
				<option value="spsaddress">Previous School Address</option>
				<option value="spstype">Previous School Type</option>
				<option value="spscourse">Previous Course</option>
				<option value="spsyrlvl">Previous Year Level</option>
				<option value="spsgwa">Previous Genereal Weight Average</option>
				<option value="spsraward">Previous Received Award</option>
				<option value="spsdawardrceive">Previous Date Award Received</option>
				<option value="scsintend">Current School Intended to Enroll</option>
				<option value="scsadd">Current School Address</option>
				<option value="scschooltype">Current School Type</option>
				<option value="sccourse">Current Course</option>
				<option value="sccourseprio">Current Course Priority</option>
				<option value="scsyrlvl">Current Year Level</option>
				<option value="spass">Password</option>
				<option value="sdsprc">Date Submit Report Card</option>
				<option value="sdsprcstat">Date Submit Report Card Status</option>
				<option value="sdspgm">Date Submit Good Moral</option>
				<option value="sdspgmstat">Date Submit Good Moral Status</option>
				<option value="sdspcr">Date Submit Certificate of Recognition</option>
				<option value="sdspcrstat">Date Submit Certificate of Recognition Status</option>
				<option value="sdstbytpic">Date Submit Two by Two Picture</option>
				<option value="sdstbytpicstat">Date Submit Two by Two Picture Status</option>
				<option value="sdsbrgyin">Date Submit Brgy. Indegency</option>
				<option value="sdsbrgyinstat">Date Submit Brgy. Indegency Status</option>
				<option value="sdscef">Date Submit Enrollment Form</option>
				<option value="sdscefstat">Date Submit Enrollment Form Status</option>
				<option value="sdspsa">Date Submit PSA</option>
				<option value="sdspsastat">Date Submit PSA Status</option>
				<option value="sdsobr">Date Submit Brgy. Residency</option>
				<option value="sdsobrstat">Date Submit Brgy. Residency Status</option>
				<option value="s_scholarship_note">Scholars Note</option>
				<option value="s_added_on">Student Added On</option>
				<option value="s_applied_on">Student Applied On</option>
				<option value="s_verification_code">Student Verification Code</option>
				<option value="s_user_otp">Student OTP</option>
				<option value="s_email_verify">Student Email Verification Status</option>
				<option value="s_account_status">Student Account Status</option>
				<option value="s_grant_stat">Student Grant Status</option>
				<option value="s_account_status">Student Scholarship Status</option>
				<option value="s_scholarship_type">Student Scholarship Type</option>			
			</select>
		</th>
		';
		}

		$html .= '</tr>';

		$limit = 0;

		while(($row = fgetcsv($file_data)) !== FALSE)
		{
		$limit++;

		if($limit < 2)
		{
			$html .= '<tr style="min-width: 200px;">';

			for($count = 0; $count < count($row); $count++)
			{
			$html .= '<td style="min-width: 200px;">'.$row[$count].'</td>';
			}

			$html .= '</tr>';
		}

		$temp_data[] = $row;
		}

		$_SESSION['file_data'] = $temp_data;

		}
		else
		{
			$error = '<div class="alert alert-danger">Only <b>.csv</b> file allowed</div>';
		}
		}
		else
		{
			$error = '<div class="alert alert-danger">Please Select CSV File</div>';
		}

		$output = array(
		'error'  => $error,
		'output' => $html
		);

		echo json_encode($output);

	}

// Import CSV
	if($_POST["action"] == 'import')
	{
		// $error = '';

		$success = '';

		// if(isset($_POST["ss_id"]))
        // {

            $file_data = $_SESSION['file_data'];

            unset($_SESSION['file_data']);

            foreach($file_data as $row)
            {
				
				$data = array(

					':ss_id'	 				=>	 $row[$_POST["ss_id"]],
					':slname'	 				=>	 $row[$_POST["slname"]],
					':sdbirth'	 				=>	 $row[$_POST["sdbirth"]]

				);
				
				$object->query = "
				SELECT * FROM tbl_student	
				WHERE ss_id = :ss_id AND slname = :slname AND sdbirth = :sdbirth
				";

				$object->execute($data);
				
			if($object->row_count() == 0)
			{
				$data = array(
					':ss_id'					=>	$row[$_POST["ss_id"]],
					':sfname'					=>	$row[$_POST["sfname"]],
					':smname'					=>	$row[$_POST["smname"]],
					':slname'					=>	$row[$_POST["slname"]],
					':snext'					=>	$row[$_POST["snext"]],
					':sdbirth'					=>	$row[$_POST["sdbirth"]],
					':sgender'					=>	$row[$_POST["sgender"]],
					':saddress'					=>	$row[$_POST["saddress"]],
					':szcode'					=>	$row[$_POST["szcode"]],
					':scontact'					=>	$row[$_POST["scontact"]],
					':semail'					=>	$row[$_POST["semail"]],
					':sctship'					=>	$row[$_POST["sctship"]],
					':scivilstat'				=>	$row[$_POST["scivilstat"]],
					':spbirth'					=>	$row[$_POST["spbirth"]],
					':sdisability'				=>	$row[$_POST["sdisability"]],
					':s4psno'					=>	$row[$_POST["s4psno"]],
					':spwdid'					=>	$row[$_POST["spwdid"]],
					':srappsship'				=>	$row[$_POST["srappsship"]],
					':srappnas'					=>	$row[$_POST["srappnas"]],
					':sbos'						=>	$row[$_POST["sbos"]],	
					':ssskills'					=>	$row[$_POST["ssskills"]],
					':stwinterest'				=>	$row[$_POST["stwinterest"]],
					':ssdfile'					=>	$row[$_POST["ssdfile"]],
					':sgfname'					=>	$row[$_POST["sgfname"]],
					':sgmname'					=>	$row[$_POST["sgmname"]],
					':sglname'					=>	$row[$_POST["sglname"]],
					':sgnext'					=>	$row[$_POST["sgnext"]],
					':sglstatus'				=>	$row[$_POST["sglstatus"]],
					':sgeduc'					=>	$row[$_POST["sgeduc"]],
					':sgcontact'				=>	$row[$_POST["sgcontact"]],
					':sgaddress'				=>	$row[$_POST["sgaddress"]],
					':sgoccu'					=>	$row[$_POST["sgoccu"]],	
					':sgcompany'				=>	$row[$_POST["sgcompany"]],
					':sffname'					=>	$row[$_POST["sffname"]],
					':sfmname'					=>	$row[$_POST["sfmname"]],
					':sflname'					=>	$row[$_POST["sflname"]],
					':sfnext'					=>	$row[$_POST["sfnext"]],
					':sflstatus'				=>	$row[$_POST["sflstatus"]],
					':sfeduc'					=>	$row[$_POST["sfeduc"]],
					':sfcontact'				=>	$row[$_POST["sfcontact"]],
					':sfaddress'				=>	$row[$_POST["sfaddress"]],
					':sfoccu'					=>	$row[$_POST["sfoccu"]],
					':sfcompany'				=>	$row[$_POST["sfcompany"]],
					':smfname'					=>	$row[$_POST["smfname"]],
					':smmname'					=>	$row[$_POST["smmname"]],
					':smlname'					=>	$row[$_POST["smlname"]],
					':smnext'					=>	$row[$_POST["smnext"]],
					':smlstatus'				=>	$row[$_POST["smlstatus"]],
					':smeduc'					=>	$row[$_POST["smeduc"]],
					':smcontact'				=>	$row[$_POST["smcontact"]],
					':smaddress'				=>	$row[$_POST["smaddress"]],
					':smoccu'					=>	$row[$_POST["smoccu"]],
					':smcompany'				=>	$row[$_POST["smcompany"]],
					':snsibling'				=>	$row[$_POST["snsibling"]],
					':spcyincome'				=>	$row[$_POST["spcyincome"]],
					':spschname'				=>	$row[$_POST["spschname"]],
					':spsaddress'				=>	$row[$_POST["spsaddress"]],
					':spstype'					=>	$row[$_POST["spstype"]],
					':spscourse'				=>	$row[$_POST["spscourse"]],
					':spsyrlvl'					=>	$row[$_POST["spsyrlvl"]],
					':spsgwa'					=>	$row[$_POST["spsgwa"]],
					':spsraward'				=>	$row[$_POST["spsraward"]],
					':spsdawardrceive'			=>	$row[$_POST["spsdawardrceive"]],
					':scsintend	'				=>	$row[$_POST["scsintend"]],
					':scsadd'					=>	$row[$_POST["scsadd"]],
					':scschooltype'				=>	$row[$_POST["scschooltype"]],
					':sccourse'					=>	$row[$_POST["sccourse"]],
					':sccourseprio'				=>	$row[$_POST["sccourseprio"]],
					':scsyrlvl'					=>	$row[$_POST["scsyrlvl"]],
					':spass'					=>	$row[$_POST["spass"]],
					':sdsprc'					=>	$row[$_POST["sdsprc"]],
					':sdsprcstat'				=>	$row[$_POST["sdsprcstat"]],
					':sdspgm'					=>	$row[$_POST["sdspgm"]],
					':sdspgmstat'				=>	$row[$_POST["sdspgmstat"]],
					':sdspcr'					=>	$row[$_POST["sdspcr"]],
					':sdspcrstat'				=>	$row[$_POST["sdspcrstat"]],
					':sdstbytpic'				=>	$row[$_POST["sdstbytpic"]],
					':sdstbytpicstat'			=>	$row[$_POST["sdstbytpicstat"]],
					':sdsbrgyin'				=>	$row[$_POST["sdsbrgyin"]],
					':sdsbrgyinstat'			=>	$row[$_POST["sdsbrgyinstat"]],
					':sdscef'					=>	$row[$_POST["sdscef"]],
					':sdscefstat'				=>	$row[$_POST["sdscefstat"]],
					':sdspsa'					=>	$row[$_POST["sdspsa"]],
					':sdspsastat'				=>	$row[$_POST["sdspsastat"]],
					':sdsobr'					=>	$row[$_POST["sdsobr"]],
					':sdsobrstat'				=>	$row[$_POST["sdsobrstat"]],
					':s_scholarship_note'		=>	$row[$_POST["s_scholarship_note"]],
					':s_added_on'				=>	$row[$_POST["s_added_on"]],
					':s_applied_on'				=>	$row[$_POST["s_applied_on"]],
					':s_verification_code'		=>	$row[$_POST["s_verification_code"]],
					':s_user_otp'				=>	$row[$_POST["s_user_otp"]],
					':s_email_verify'			=>	$row[$_POST["s_email_verify"]],
					':s_account_status'			=>	$row[$_POST["s_account_status"]],
					':s_grant_stat'				=>	$row[$_POST["s_grant_stat"]],
					':s_account_status'			=>	$row[$_POST["s_account_status"]],
					':s_scholarship_type'		=>	$row[$_POST["s_scholarship_type"]]
				);

				$object->query = "
				INSERT INTO tbl_student 
				(ss_id, sfname, smname, slname, snext, sdbirth, sgender, 
				saddress, szcode, scontact, semail, sctship, scivilstat, spbirth, 
				sdisability, s4psno, spwdid, srappsship, srappnas, sbos, ssskills, 
				stwinterest, ssdfile, sgfname, sgmname, sglname, sgnext, sglstatus, 
				sgeduc, sgcontact, sgaddress, sgoccu, sgcompany, sffname, sfmname, sflname, 
				sfnext, sflstatus, sfeduc, sfcontact, sfaddress, sfoccu, sfcompany, smfname, 
				smmname, smlname, smnext, smlstatus, smeduc, smcontact, smaddress, smoccu, 
				smcompany, snsibling, spcyincome, spschname, spsaddress, spstype, spscourse, 
				spsyrlvl, spsgwa, spsraward, spsdawardrceive, scsintend, scsadd, scschooltype, 
				sccourse, sccourseprio, scsyrlvl, spass, sdsprc, sdsprcstat, sdspgm, sdspgmstat, 
				sdspcr, sdspcrstat, sdstbytpic, sdstbytpicstat, sdsbrgyin, sdsbrgyinstat, sdscef, 
				sdscefstat, sdspsa, sdspsastat, sdsobr, sdsobrstat, s_scholarship_note, s_added_on, 
				s_applied_on, s_verification_code, s_user_otp, s_email_verify, s_account_status, s_grant_stat, 
				s_account_status, s_scholarship_type) 
				VALUES (:ss_id, :sfname, :smname, :slname, :snext, :sdbirth, :sgender, :saddress, 
				:szcode, :scontact, :semail, :sctship, :scivilstat, :spbirth, :sdisability, :s4psno, 
				:spwdid, :srappsship, :srappnas, :sbos, :ssskills, :stwinterest, :ssdfile, :sgfname, 
				:sgmname, :sglname, :sgnext, :sglstatus, :sgeduc, :sgcontact, :sgaddress, :sgoccu, :sgcompany, 
				:sffname, :sfmname, :sflname, :sfnext, :sflstatus, :sfeduc, :sfcontact, :sfaddress, :sfoccu, 
				:sfcompany, :smfname, :smmname, :smlname, :smnext, :smlstatus, :smeduc, :smcontact, :smaddress, 
				:smoccu, :smcompany, :snsibling, :spcyincome, :spschname, :spsaddress, :spstype, :spscourse, 
				:spsyrlvl, :spsgwa, :spsraward, :spsdawardrceive, :scsintend, :scsadd, :scschooltype, :sccourse, 
				:sccourseprio, :scsyrlvl, :spass, :sdsprc, :sdsprcstat, :sdspgm	 :sdspgmstat, :sdspcr, :sdspcrstat, 
				:sdstbytpic, :sdstbytpicstat, :sdsbrgyin, :sdsbrgyinstat, :sdscef, :sdscefstat, :sdspsa, :sdspsastat, 
				:sdsobr, :sdsobrstat, :s_scholarship_note, :s_added_on, :s_applied_on, :s_verification_code, 
				:s_user_otp, :s_email_verify, :s_account_status, :s_grant_stat, :s_account_status, :s_scholarship_type)
				";

				$object->execute($data);

				$success = '<div class="alert alert-success">Data Imported Successfully</div>';

			}
			
		}
        
		// }
		$output = array(
			'success'	=>	$success
		);

		echo json_encode($output);
    }

// Export CSV
	if($_POST["action"] == 'export_csv')
	{
		$title = array("Student ID No.",
		"First Name", "Middle Name", 
		"Last Name", "Name Ext.", 
		"Date of Birth", "Gender", 
		"Address", "Zip Code", 
		"Contact Number", "Email", 
		"Citizenship", "Civil Status", 
		"Place of Birth", "Disability ID No.", 
		"4PS No.", "PWD ID", 
		"Reason Applying Scholarship", "Reason Applying Non-Academic",
		"Basic Office Skills", "Special Skills", 
		"Type of Work Interested In", "Date Filed", 
		"Guardian Full Name", "Guardian Middle Name", 
		"Guardian Last Name", "Guardian Name Ext.", 
		"Guardian Life Status", "Guardian Educational Attainment", 
		"Guardian Contact Number", "Guardian Address", 
		"Guardian Occupation", "Guardian Company", 
		"Father Full Name", "Father Middle Name", 
		"Father Last Name", "Father Name Ext.",
		"Father Life Status", "Father Educational Attainment", 
		"Father Contact", "Father Address", 
		"Father Occupation", "Father Company", 
		"Mother Full Name", "Mother Middle Name", 
		"Mother Last Name", "Mother Name Ext.", 
		"Mother Life Status", "Mother Educational Attainment", 
		"Mother Contact", "Mother Address", 
		"Mother Occupation", "Mother Company",
		"Number of Sibling", "Parents Combine Yearly Income", 
		"Previous School Attended", "Previous School Address", 
		"Previous School Type", "Previous Course", 
		"Previous Year Level", "Previous Genereal Weight Average", 
		"Previous Received Award", "Previous Date Award Received", 
		"Current School Intended to Enroll", "Current School Address", 
		"Current School Type", "Current Course", 
		"Current Course Priority", "Current Year Level",  
		"Password", "Date Submit Report Card", 
		"Date Submit Report Card Status", "Date Submit Good Moral", 
		"Date Submit Good Moral Status", "Date Submit Certificate of Recognition", 
		"Date Submit Certificate of Recognition Status", "Date Submit Two by Two Picture", 
		"Date Submit Two by Two Picture Status", "Date Submit Brgy. Indegency", 
		"Date Submit Brgy. Indegency Status", "Date Submit Enrollment Form", 
		"Date Submit Enrollment Form Status", "Date Submit PSA", 
		"Date Submit PSA Status", "Date Submit Brgy. Residency",
		"Date Submit Brgy. Residency Status", "Scholars Note", 
		"Student Added On", "Student Applied On", 
		"Student Verification Code", "Student OTP", 
		"Student Email Verification Status", "Student Account Status", 
		"Student Grant Status", "Student Scholarship Status", 
		"Student Scholarship Type" 
		);
		$output = fopen('php://output', 'w');
		fputcsv($output, $title);			
		for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
		{
			
			$object->query = "
			SELECT * FROM tbl_student
			WHERE s_id = '".$_POST["checkbox_value"][$count]."'
			";

			$object->execute();
			$result = $object->get_result();
			
			$content = array();
			foreach ($result as $rows) {
				$row = array();
				$row[] = $rows["ss_id"];
				$row[] = $rows["sfname"];
				$row[] = $rows["smname"];
				$row[] = $rows["slname"];
				$row[] = $rows["snext"];
				$row[] = $rows["sdbirth"];
				$row[] = $rows["sgender"];
				$row[] = $rows["saddress"];
				$row[] = $rows["szcode"];
				$row[] = $rows["scontact"];
				$row[] = $rows["semail"];
				$row[] = $rows["sctship"];
				$row[] = $rows["scivilstat"];
				$row[] = $rows["spbirth"];
				$row[] = $rows["sdisability"];
				$row[] = $rows["s4psno"];
				$row[] = $rows["spwdid"];
				$row[] = $rows["srappsship"];
				$row[] = $rows["srappnas"];
				$row[] = $rows["sbos"];
				$row[] = $rows["ssskills"];
				$row[] = $rows["stwinterest"];
				$row[] = $rows["ssdfile"];
				$row[] = $rows["sgfname"];
				$row[] = $rows["sgmname"];
				$row[] = $rows["sglname"];
				$row[] = $rows["sgnext"];
				$row[] = $rows["sglstatus"];
				$row[] = $rows["sgeduc"];
				$row[] = $rows["sgcontact"];
				$row[] = $rows["sgaddress"];
				$row[] = $rows["sgoccu"];
				$row[] = $rows["sgcompany"];
				$row[] = $rows["sffname"];
				$row[] = $rows["sfmname"];
				$row[] = $rows["sflname"];
				$row[] = $rows["sfnext"];
				$row[] = $rows["sflstatus"];
				$row[] = $rows["sfeduc"];
				$row[] = $rows["sfcontact"];
				$row[] = $rows["sfaddress"];
				$row[] = $rows["sfoccu"];
				$row[] = $rows["sfcompany"];
				$row[] = $rows["smfname"];
				$row[] = $rows["smmname"];
				$row[] = $rows["smlname"];
				$row[] = $rows["smnext"];
				$row[] = $rows["smlstatus"];
				$row[] = $rows["smeduc"];
				$row[] = $rows["smcontact"];
				$row[] = $rows["smaddress"];
				$row[] = $rows["smoccu"];
				$row[] = $rows["smcompany"];
				$row[] = $rows["snsibling"];
				$row[] = $rows["spcyincome"];
				$row[] = $rows["spschname"];
				$row[] = $rows["spsaddress"];
				$row[] = $rows["spstype"];
				$row[] = $rows["spscourse"];
				$row[] = $rows["spsyrlvl"];
				$row[] = $rows["spsgwa"];
				$row[] = $rows["spsraward"];
				$row[] = $rows["spsdawardrceive"];
				$row[] = $rows["scsintend"];
				$row[] = $rows["scsadd"];
				$row[] = $rows["scschooltype"];
				$row[] = $rows["sccourse"];
				$row[] = $rows["sccourseprio"];
				$row[] = $rows["scsyrlvl"];
				$row[] = $rows["spass"];
				$row[] = $rows["sdsprc"];
				$row[] = $rows["sdsprcstat"];
				$row[] = $rows["sdspgm"];
				$row[] = $rows["sdspgmstat"];
				$row[] = $rows["sdspcr"];
				$row[] = $rows["sdspcrstat"];
				$row[] = $rows["sdstbytpic"];
				$row[] = $rows["sdstbytpicstat"];
				$row[] = $rows["sdsbrgyin"];
				$row[] = $rows["sdsbrgyinstat"];
				$row[] = $rows["sdscef"];
				$row[] = $rows["sdscefstat"];
				$row[] = $rows["sdspsa"];
				$row[] = $rows["sdspsastat"];
				$row[] = $rows["sdsobr"];
				$row[] = $rows["sdsobrstat"];
				$row[] = $rows["s_scholarship_note"];
				$row[] = $rows["s_added_on"];
				$row[] = $rows["s_applied_on"];
				$row[] = $rows["s_verification_code"];
				$row[] = $rows["s_user_otp"];
				$row[] = $rows["s_email_verify"];
				$row[] = $rows["s_account_status"];
				$row[] = $rows["s_grant_stat"];
				$row[] = $rows["s_account_status"];
				$row[] = $rows["s_scholarship_type"];

				$content[] = $row;
				
			}

			foreach ($content as $con) {
				fputcsv($output, $con);
			}

		}
		fclose($output);

	}

// Single Student Fetch Query
if($_POST["action"] == 'student_fetch_single')
{
	$object->query = "
	SELECT * FROM tbl_student 
	WHERE s_id = '".$_POST["s_id"]."'
	";

	$result = $object->get_result();

	$data = array();

	foreach($result as $row)
	{
		// Student ID Details
		$data['ss_id'] = $row['ss_id'];
		// Personal Details
		$data['sfname'] = $row['sfname'];
		$data['smname'] = $row['smname'];
		$data['slname'] = $row['slname'];
		$data['snext'] = $row['snext'];
		$data['sdbirth'] = $row['sdbirth'];
		$data['sgender'] = $row['sgender'];
		$data['scivilstat'] = $row['scivilstat'];
		$data['saddress'] = $row['saddress'];
		$data['scontact'] = $row['scontact'];
		$data['spschname'] = $row['spschname'];
		$data['sccourse'] = $row['sccourse'];
		$data['scsyrlvl'] = $row['scsyrlvl'];
		// Family Details
		// Guardian Details
		$data['sgfname'] = $row['sgfname'];
		// Father Details
		$data['sffname'] = $row['sffname'];
		$data['sfoccu'] = $row['sfoccu'];
		// Mother Details
		$data['smfname'] = $row['smfname'];
		$data['smoccu'] = $row['smoccu'];
		// Scholar Type
		$data['s_scholarship_type'] = $row['s_scholarship_type'];
		$data['s_account_status'] = $row['s_account_status'];
	}

	echo json_encode($data);
}

// Edit Acad Query
if($_POST["action"] == 'edit_student')
{
	$error = '';

	$success = '';

	$data = array(
		':ss_id'	 				=>	$_POST["ss_id"],
		':s_id'						=>	$_POST['student_hidden_id']
	);

	$object->query = "
	SELECT * FROM tbl_student	
	WHERE ss_id = :ss_id
	AND s_id != :s_id
	";

	$object->execute($data);

	if($object->row_count() > 0)
	{
		$error = '<div class="alert alert-danger">Email Address Already Exists</div>';
	}
	else
	{
		$object->query = "
		UPDATE tbl_student
		SET sfname = :sfname,
		smname = :smname,
		slname = :slname,
		snext = :snext,
		sdbirth = :sdbirth,
		scivilstat = :scivilstat,
		saddress = :saddress,
		scontact = :scontact,
		spschname = :spschname,
		sccourse = :sccourse,
		scsyrlvl = :scsyrlvl,
		sgender = :sgender,
		sgfname = :sgfname, 
		sffname = :sffname,
		sfoccu = :sfoccu,
		smfname = :smfname,
		smoccu = :smoccu,
		s_scholarship_type = :s_scholarship_type,
		s_account_status = :s_account_status
		WHERE s_id = '".$_POST['student_hidden_id']."'
		";

		if($error == '')
		{

			$data = array(
				// Personal Details
				':sfname'					    =>	$object->clean_input($_POST["sfname"]),
				':smname'					    =>	$object->clean_input($_POST["smname"]),
				':slname'					    =>	$object->clean_input($_POST["slname"]),
				':snext'					    =>	$object->clean_input($_POST["snext"]),
				':sdbirth'					  	=>	$object->clean_input($_POST["sdbirth"]),
				':sgender'					  	=>	$object->clean_input($_POST["sgender"]),
				':scivilstat'				    =>	$object->clean_input($_POST["scivilstat"]),
				':saddress'						=>	$object->clean_input($_POST["saddress"]),
				':scontact'						=>	$object->clean_input($_POST["scontact"]),
				':spschname'					=>	$object->clean_input($_POST["spschname"]),
				':sccourse'						=>	$object->clean_input($_POST["sccourse"]),
				':scsyrlvl'						=>	$object->clean_input($_POST["scsyrlvl"]),
				// Family Details
				// Guardian Details
				':sgfname'				      	=>	$object->clean_input($_POST["sgfname"]),
				// Father Details
				':sffname'				      	=>	$object->clean_input($_POST["sffname"]),
				':sfoccu'				      	=>	$object->clean_input($_POST["sfoccu"]),
				// Mother Details
				':smfname'				      	=>	$object->clean_input($_POST["smfname"]),
				':smoccu'				      	=>	$object->clean_input($_POST["smoccu"]),
				// Scholarship Details
				':s_scholarship_type'			=>	$object->clean_input($_POST["s_scholarship_type"]),
				':s_account_status'				=>	$object->clean_input($_POST["s_account_status"])

			);

			$object->execute($data);

			$success = '<div class="alert alert-success">Student Data Updated</div>';
		}
	}
	$output = array(
		'error'		=>	$error,
		'success'	=>	$success
	);

	echo json_encode($output);

}

// Change Status Query
if($_POST["action"] == 'change_status')
{
	$data = array(
		':s_account_status'		=>	$_POST['next_status']
	);

	$object->query = "
	UPDATE tbl_student
	SET s_account_status = :s_account_status 
	WHERE s_id = '".$_POST["id"]."'
	";

	$object->execute($data);

	echo '<div class="alert alert-success">Status change to '.$_POST['next_status'].' Successfully</div>';
}
// Delete
if($_POST["action"] == 'delete')
{
	$object->query = "
	DELETE FROM tbl_student 
	WHERE s_id = '".$_POST["id"]."'
	";

	$object->execute();

	echo '<div class="alert alert-success">Student Data Deleted</div>';
}
// Active All
if($_POST["action"] == 'active_all')
{
	for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
	{
	$object->query = "
		UPDATE tbl_student 
		SET s_account_status = 'Active'
		WHERE s_id = '".$_POST["checkbox_value"][$count]."'";

		$object->execute();
	}
	echo '<div class="alert alert-success">Selected Student Data Account Activated</div>';
}
// Inactive All
if($_POST["action"] == 'inactive_all')
{
	for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
	{
	$object->query = "
		UPDATE tbl_student 
		SET s_account_status = 'Inactive'
		WHERE s_id = '".$_POST["checkbox_value"][$count]."'";

		$object->execute();
	}
	echo '<div class="alert alert-success">Selected Student Data Account Inactived</div>';
}
// Delete All
if($_POST["action"] == 'delete_all')
{
	for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
	{
	$object->query = "
		DELETE FROM tbl_student 
		WHERE s_id = '".$_POST["checkbox_value"][$count]."'";

		$object->execute();
	}
	echo '<div class="alert alert-success">Selected Student Data Deleted</div>';
}
}

?>