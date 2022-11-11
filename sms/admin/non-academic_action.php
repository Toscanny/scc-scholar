
<?php 

// academic_action.php

include('../class/dbcon.php');

$object = new sms;

$object->query = "
  SELECT * FROM tbl_student
  WHERE s_id = '".$_SESSION["admin_id"]."'
  ";

$result = $object->get_result();
    
if(isset($_POST["action"]))
{
    foreach($result as $row)
    {
        
        if($_POST['action'] == 'student_nonacad_apply')
        {
          $error = '';

          $success = '';

          $data = array(

            ':slname'	 				=>	 $_POST["slname"],
            ':sdbirth'	 			=>	 $_POST["sdbirth"]
  
          );

          $object->query = "
          SELECT * FROM tbl_student
          WHERE slname = :slname AND sdbirth = :sdbirth AND s_scholar_stat != ''
          ";

          $object->execute($data);

          if($object->row_count() > 0)
          {
            $error = '<div class="alert alert-danger">You already Applied. If you have concern, Please Contact Admin</div>';
          }
          else
          {
            if($error == '')
            {

              $object->query = "
                UPDATE tbl_student 
                SET sfname = :sfname, 
                smname = :smname, 
                slname = :slname,
                snext = :snext, 
                sdbirth = :sdbirth, 
                sgender = :sgender,
                saddress = :saddress,
                scontact = :scontact,
                sctship = :sctship,
                sgfname = :sgfname,
                sgaddress = :sgaddress,
                sgcontact = :sgcontact,
                sgoccu = :sgoccu,
                sgcompany = :sgcompany,
                sffname = :sffname,
                sfaddress = :sfaddress,
                sfcontact = :sfcontact,
                sfoccu = :sfoccu,
                sfcompany = :sfcompany,
                smfname = :smfname,
                smaddress = :smaddress,
                smcontact = :smcontact,
                smoccu = :smoccu,
                smcompany = :smcompany,
                spcyincome = :spcyincome,
                srappnas = :srappnas,
                sbos = :sbos,
                ssskills = :ssskills,
                stwinterest = :stwinterest,
                spschname = :spschname,
                spsaddress = :spsaddress,
                spsyrlvl = :spsyrlvl,
                s_scholar_stat = 'Pending',
                s_applied_on = :s_applied_on,
                s_scholarship_type = 'Non-Academic'
                WHERE s_id = '".$_SESSION["admin_id"]."'         
                ";

                $data = array(
                  ':sfname'				          =>	$object->clean_input($_POST["sfname"]),
                  ':smname'			            =>	$object->clean_input($_POST["smname"]),
                  ':slname'			            =>	$object->clean_input($_POST["slname"]),
                  ':snext'		              =>	$object->clean_input($_POST["snext"]),
                  ':sdbirth'				        =>	$object->clean_input($_POST["sdbirth"]),
                  ':sgender'				        =>	$object->clean_input($_POST["sgender"]),
                  ':sctship'			          =>	$object->clean_input($_POST["sctship"]),
                  ':saddress'				        =>	$object->clean_input($_POST["saddress"]),
                  ':scontact'				        =>	$object->clean_input($_POST["scontact"]),
                  ':sgfname'		            =>	$object->clean_input($_POST["sgfname"]),
                  ':sgaddress'			        =>	$object->clean_input($_POST["sgaddress"]),
                  ':sgcontact'			        =>	$object->clean_input($_POST["sgcontact"]),
                  ':sgoccu'		              =>	$object->clean_input($_POST["sgoccu"]),
                  ':sgcompany'			        =>	$object->clean_input($_POST["sgcompany"]),
                  ':sffname'			          =>	$object->clean_input($_POST["sffname"]),
                  ':sfaddress'			        =>	$object->clean_input($_POST["sfaddress"]),
                  ':sfcontact'		          =>	$object->clean_input($_POST["sfcontact"]),
                  ':sfoccu'			            =>	$object->clean_input($_POST["sfoccu"]),
                  ':sfcompany'			        =>	$object->clean_input($_POST["sfcompany"]),
                  ':smfname'			          =>	$object->clean_input($_POST["smfname"]),
                  ':smaddress'			        =>	$object->clean_input($_POST["smaddress"]),
                  ':smcontact'		          =>	$object->clean_input($_POST["smcontact"]),
                  ':smoccu'			            =>	$object->clean_input($_POST["smoccu"]),
                  ':smcompany'			        =>	$object->clean_input($_POST["smcompany"]),
                  ':spcyincome'			        =>	$object->clean_input($_POST["spcyincome"]),
                  ':srappnas'			          =>	$object->clean_input($_POST["srappnas"]),
                  ':sbos'			              =>	$object->clean_input($_POST["sbos"]),
                  ':ssskills'			          =>	$object->clean_input($_POST["ssskills"]),
                  ':stwinterest'			      =>	$object->clean_input($_POST["stwinterest"]),
                  ':spschname'			        =>	$object->clean_input($_POST["spschname"]),
                  ':spsaddress'			        =>	$object->clean_input($_POST["spsaddress"]),
                  ':spsyrlvl'			          =>	$object->clean_input($_POST["spsyrlvl"]),
                  ':s_applied_on'				    =>	$object->now
              );

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
    }
}
?>