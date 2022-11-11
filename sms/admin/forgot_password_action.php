<?php 

// register_action.php

include('../class/dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$object = new sms;

if(isset($_POST["action"]))
{

    if($_POST['action'] == 'submit_email')
    {
        $error = '';

        $success = '';

        $data = array(
            ':email'	=>	$_POST["email"]
        );

        $object->query = "
        SELECT * FROM tbl_student
        WHERE semail = :email AND s_email_verify = 'Yes'
        ";

        $object->execute($data);

        if($object->row_count() > 0)
        {
            $result = $object->statement_result();
            
            foreach($result as $row)
			{
                if($row["s_email_verify"] == 'No')
				{
                    $error = '<div class="alert alert-info">Your Email Address is not verify, so first verify your email address by click on this <a href="resend_email_otp.php">link</a></div>';
                }
                else{


                    // Generate Verifcation Code
                    $s_user_otp = rand(100000, 999999);

                    $object->query = "
                    UPDATE tbl_student 
                    SET s_user_otp = :s_user_otp
                    WHERE semail = :email AND s_email_verify = 'Yes'      
                    ";


                    $data = array(
                        ':email'			    		=>	$_POST["email"],
                        ':s_user_otp'	                =>	$s_user_otp,
                    );

                        // Load composer's autoloader
                        require '../vendor/autoload.php';
                    
                        $mail = new PHPMailer(true);                            
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
                            $mail->addAddress($_POST["email"]);            
                            $mail->addReplyTo('unswaa20@gmail.com');
                            $mail->WordWrap = 50;

                            //Content
                            $mail->isHTML(true);                                  
                            $mail->Subject = 'Verification code for changing password';
                            $message_body = '
                            <p>For changing your password, Please enter this verification code: <b>'.$s_user_otp.'</b>.</p>
                            ';
                            $mail->Body = $message_body;
                    
                            if($mail->Send())
                            {
                                $success = '<div class="alert alert-success">Please Check Your Email for OTP</div>';
                            }

                        } catch (Exception $e) {
                            $error = '<div class="alert alert-danger">' . $mail->ErrorInfo . '</div>';
                        }

                        $object->execute($data);
                }
            }
        }
        else
        {
            $error = '<div class="alert alert-danger">Email Address Not Found</div>';
        }

        $output = array(
            'error'		=>	$error,
            'success'	=>	$success
        );
        echo json_encode($output);
    }

    if($_POST['action'] == 'otp_verify')
    {
        $error = '';

        $success = '';

        $data = array(
            ':otp'	=>	$_POST["otp"]
        );

        $object->query = "
        SELECT * FROM tbl_student
        WHERE s_user_otp = :otp
        ";

        $object->execute($data);

        if($object->row_count() > 0)
        {
            $success = '<div class="alert alert-success">OTP Matched</div>';
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

    if($_POST['action'] == 'change_pass')
    {
        $error = '';

        $success = '';

        $data = array(
            ':email'	=>	$_POST["email"]
        );

        $object->query = "
        SELECT * FROM tbl_student
        WHERE semail = :email AND s_email_verify = 'Yes'
        ";

        $object->execute($data);

        if($object->row_count() > 0)
        {
            
            $result = $object->statement_result();

            // foreach($result as $row)
            // {

            //     if(password_verify($_POST["npass"], $row["spass"]))
            //     {
            //         $error = '<div class="alert alert-danger">Old Password, Please Use Another Password</div>';
            //     }
            //     else
            //     {
            //         if($error == '')
            //         {

                        $new_password = $_POST["npass"];
                        $confirm_password = $_POST["ncpass"];
                    
                        if($new_password == $confirm_password)
                        {
                    
                            $object->query = "
                            UPDATE tbl_student 
                            SET spass = :spass
                            WHERE semail = :email AND s_user_otp = :s_user_otp     
                            ";

                            $data = array(
                                ':email'			    		=>	$_POST["email"],
                                ':s_user_otp'	                =>	$_POST["otp"],
                                ':spass'                        =>	password_hash($new_password, PASSWORD_ARGON2I)
                            );
                    
                            $success = '<div class="alert alert-success">Password Change Successfully</div>';
                    
                            $object->execute($data);
                        }
                        else
                        {
                            $error = '<div class="alert alert-danger">Password Not Match</div>';
                        }
            //         }	
            //     }
                
            // }
        
        }
        else
        {
            $error = '<div class="alert alert-danger">Email Address Not Found</div>';
        }

        $output = array(
            'error'		=>	$error,
            'success'	=>	$success
        );
        echo json_encode($output);
    }



}

?>