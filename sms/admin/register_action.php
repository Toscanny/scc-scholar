<?php 

// register_action.php

include('../class/dbcon.php');
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';

$object = new sms;

if(isset($_POST["action"]))
{
    if($_POST['action'] == 'ssid_verify')
    {
      $error = '';
  
      $success = '';
  
      $data = array(
          ':vss_id'	    =>	$_POST["vss_id"],
          ':vslname'	=>	$_POST["vslname"],
          ':vsdbirth'	=>	$_POST["vsdbirth"]
      );
  
      $object->query = "
      SELECT * FROM tbl_student
      WHERE ss_id = :vss_id AND slname = :vslname AND sdbirth = :vsdbirth
      ";
  
      $object->execute($data);
  
      if($object->row_count() > 0)
      {
        $success = '<div class="alert alert-success">School Data Exists</div>';
      }
      else
      {
        $error = '<div class="alert alert-danger">School Data Not Exists</div>';
      }
    
      $output = array(
          'error'	=>	$error,
          'success'	=>	$success
      );
      
      echo json_encode($output);
    }

    if($_POST['action'] == 'student_register')
    {
        $error = '';

        $success = '';

        $pass = '';

        $data = array(
            ':semail'	=>	$_POST["semail"]
        );

        $object->query = "
        SELECT * FROM tbl_student
        WHERE semail = :semail AND s_email_verify = 'Yes'
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
            SET semail = :semail,
            spass = :spass, 
            s_added_on = :s_added_on,
            s_verification_code = :s_verification_code,
            s_email_verify = :s_email_verify
            WHERE ss_id = '".$_POST["vss_id"]."'          
            ";

            // Generate Verifcation Code
            $s_verification_code = md5(uniqid());
            // Generate Random Password
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
            $password = substr( str_shuffle( $chars ), 0, 8 );

            $hash = password_hash($password, PASSWORD_ARGON2I);

            $data = array(
                ':semail'				        =>	$_POST["semail"],
                ':spass'				        =>	$hash,
                ':s_added_on'				    =>	$object->now,
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
                    $mail->addAddress($_POST["semail"]);            
                    $mail->addReplyTo('unswaa20@gmail.com');
                    $mail->WordWrap = 50;

                    //Content
                    $mail->isHTML(true);                                  
                    $mail->Subject = 'Verification code for Verify Your Email Address';
                    $message_body = '
                    <p>For verify your email address, Please click on this <a href="'.$object->base_url.'admin/register_verify.php?code='.$s_verification_code.'"><b>link</b></a>.</p>
                    <p>Input this information to login.</p>
                    <p>Username: '.$_POST["semail"].'</p>
                    <p>Password: '.$password.'</p>
                    <p>Sincerely,</p>
                    <p>Unswaa20</p>
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

}

?>