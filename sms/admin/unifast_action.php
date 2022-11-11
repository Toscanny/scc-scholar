
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
       
        if($_POST['action'] == 'student_unifast_apply')
        {
            $error = '';

            $success = '';
    
            $data = array(

            ':slname'	 			=>	 $_POST["slname"],
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
                    sgender = :sgender,
                    sdbirth = :sdbirth, 
                    scontact = :scontact,
                    saddress = :saddress,
                    spschname = :spschname,
                    spscourse = :spscourse,
                    spsyrlvl = :spsyrlvl,
                    sffname = :sffname,
                    smfname = :smfname,
                    s4psno = :s4psno,
                    spcyincome = :spcyincome,
                    spwdid = :spwdid,
                    ssdfile = :ssdfile,
                    s_scholar_stat = 'Pending',
                    s_grant_stat = 'New',
                    s_applied_on = :s_applied_on,
                    s_scholarship_type = 'UNIFAST'
                    WHERE s_id = '".$_SESSION["admin_id"]."'         
                    ";

                    $data = array(
                        ':sfname'				        =>	$object->clean_input($_POST["sfname"]),
                        ':smname'			            =>	$object->clean_input($_POST["smname"]),
                        ':slname'			            =>	$object->clean_input($_POST["slname"]),
                        ':snext'		                =>	$object->clean_input($_POST["snext"]),
                        ':sgender'				        =>	$object->clean_input($_POST["sgender"]),
                        ':sdbirth'				        =>	$object->clean_input($_POST["sdbirth"]),
                        ':scontact'				        =>	$object->clean_input($_POST["scontact"]),
                        ':saddress'				        =>	$object->clean_input($_POST["saddress"]),
                        ':spschname'				    =>	$object->clean_input($_POST["spschname"]),
                        ':spscourse'				    =>	$object->clean_input($_POST["saddress"]),
                        ':spsyrlvl'				        =>	$object->clean_input($_POST["spsyrlvl"]),
                        ':sffname'			            =>	$object->clean_input($_POST["sffname"]),
                        ':smfname'			            =>	$object->clean_input($_POST["smfname"]),
                        ':s4psno'			            =>	$object->clean_input($_POST["s4psno"]),
                        ':spcyincome'			        =>	$object->clean_input($_POST["spcyincome"]),
                        ':spwdid'		                =>	$object->clean_input($_POST["spwdid"]),
                        ':ssdfile'			            =>	$object->clean_input($_POST["ssdfile"]),
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