
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
       
        if($_POST['action'] == 'student_ched_apply')
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
                    sdbirth = :sdbirth, 
                    sgender = :sgender,
                    scivilstat = :scivilstat,
                    spbirth = :spbirth,
                    saddress = :saddress,
                    szcode = :szcode,
                    sctship = :sctship,
                    scontact = :scontact,
                    sdisability = :sdisability,
                    sffname = :sffname,
                    sflstatus = :sflstatus,
                    sfoccu = :sfoccu,
                    sfeduc = :sfeduc,
                    sfaddress = :sfaddress,
                    smfname = :smfname,
                    smlstatus = :smlstatus,
                    smoccu = :smoccu,
                    smeduc = :smeduc,
                    smaddress = :smaddress,
                    spcyincome = :spcyincome,
                    snsibling = :snsibling,
                    spschname = :spschname,
                    spsaddress = :spsaddress,
                    spstype = :spstype,
                    spsyrlvl = :spsyrlvl,
                    scsintend = :scsintend,
                    scsadd = :scsadd,
                    scschooltype = :scschooltype,
                    sccourse = :sccourse,
                    sccourseprio = :sccourseprio,
                    s_scholar_stat = 'Pending',
                    s_applied_on = :s_applied_on,
                    s_scholarship_type = 'CHED'
                    WHERE s_id = '".$_SESSION["admin_id"]."'         
                    ";

                    $data = array(
                    // Personal
                        ':sfname'				        =>	$object->clean_input($_POST["sfname"]),
                        ':smname'			            =>	$object->clean_input($_POST["smname"]),
                        ':slname'			            =>	$object->clean_input($_POST["slname"]),
                        ':snext'		                =>	$object->clean_input($_POST["snext"]),
                        ':sdbirth'				        =>	$object->clean_input($_POST["sdbirth"]),
                        ':sgender'				        =>	$object->clean_input($_POST["sgender"]),
                        ':scivilstat'			        =>	$object->clean_input($_POST["scivilstat"]),
                        ':spbirth'			            =>	$object->clean_input($_POST["spbirth"]),
                        ':saddress'				        =>	$object->clean_input($_POST["saddress"]),
                        ':szcode'			            =>	$object->clean_input($_POST["szcode"]),
                        ':sctship'			            =>	$object->clean_input($_POST["sctship"]),
                        ':scontact'				        =>	$object->clean_input($_POST["scontact"]),
                        ':sdisability'			        =>	$object->clean_input($_POST["sdisability"]),
                    // Father
                        ':sffname'			            =>	$object->clean_input($_POST["sffname"]),
                        ':sflstatus'				    =>	$object->clean_input($_POST["sflstatus"]),
                        ':sfoccu'			            =>	$object->clean_input($_POST["sfoccu"]),
                        ':sfeduc'		                =>	$object->clean_input($_POST["sfeduc"]),
                        ':sfaddress'			        =>	$object->clean_input($_POST["sfaddress"]),
                    // Mother
                        ':smfname'			            =>	$object->clean_input($_POST["smfname"]),
                        ':smlstatus'				    =>	$object->clean_input($_POST["smlstatus"]),
                        ':smoccu'			            =>	$object->clean_input($_POST["smoccu"]),
                        ':smeduc'		                =>	$object->clean_input($_POST["smeduc"]),
                        ':smaddress'			        =>	$object->clean_input($_POST["smaddress"]),
                        ':spcyincome'		            =>	$object->clean_input($_POST["spcyincome"]),
                        ':snsibling'			        =>	$object->clean_input($_POST["snsibling"]),
                    // Education
                        // Previous
                        ':spschname'			        =>	$object->clean_input($_POST["spschname"]),
                        ':spsaddress'			        =>	$object->clean_input($_POST["spsaddress"]),
                        ':spstype'		                =>	$object->clean_input($_POST["spstype"]),
                        ':spsyrlvl'				        =>	$object->clean_input($_POST["spsyrlvl"]),
                        // Current
                        ':scsintend'			        =>	$object->clean_input($_POST["scsintend"]),
                        ':scsadd'		                =>	$object->clean_input($_POST["scsadd"]),
                        ':scschooltype'			        =>	$object->clean_input($_POST["scschooltype"]),
                        ':sccourse'			            =>	$object->clean_input($_POST["sccourse"]),
                        ':sccourseprio'			        =>	$object->clean_input($_POST["sccourseprio"]),
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