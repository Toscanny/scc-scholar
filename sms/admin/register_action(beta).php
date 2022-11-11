<?php 

// register_action.php

include('../class/dbcon.php');

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
  
      if($object->row_count() == 0)
      {
          $error = '<div class="alert alert-danger">School Data Not Exists</div>';
      }
      else{

          if($error == ''){

            $success = '<div class="alert alert-success">School Data Exists</div>';
        
          } 
      }
    
  
      $output = array(
          'error'	=>	$error,
          'success'	=>	$success
      );
      
      echo json_encode($output);
    }

    if($_POST["action"] == 'fetch_single')
    {
        $object->query = "
        SELECT * FROM tbl_student
        WHERE ss_id = '".$_POST["vss_id"]."'
        ";

        $result = $object->get_result();

        $data = array();

        foreach($result as $row)
        {
            $data['vss_id'] = $row['ss_id'];
            $data['sfname'] = $row['sfname'];
            $data['smname'] = $row['smname'];
            $data['slname'] = $row['slname'];
            $data['snext'] = $row['snext'];
            $data['sdbirth'] = $row['sdbirth'];
            $data['sgender'] = $row['sgender'];
            $data['saddress'] = $row['saddress'];
            $data['szcode'] = $row['szcode'];
            $data['scontact'] = $row['scontact'];
            $data['semail'] = $row['semail'];
            $data['sctship'] = $row['sctship'];
            $data['scivilstat'] = $row['scivilstat'];
            $data['sdisability'] = $row['sdisability'];
            $data['s4psno'] = $row['s4psno'];
            $data['spwdid'] = $row['spwdid'];
            $data['srappsship'] = $row['srappsship'];
            $data['sgfname'] = $row['sgfname'];
            $data['sgmname'] = $row['sgmname'];
            $data['sglname'] = $row['sglname'];
            $data['sgnext'] = $row['sgnext'];
            $data['sglstatus'] = $row['sglstatus'];
            $data['sgeduc'] = $row['sgeduc'];
            $data['sgcontact'] = $row['sgcontact'];
            $data['sgaddress'] = $row['sgaddress'];
            $data['sgoccu'] = $row['sgoccu'];
            $data['sgcompany'] = $row['sgcompany'];
            $data['sffname'] = $row['sffname'];
            $data['sfmname'] = $row['sfmname'];
            $data['sflname'] = $row['sflname'];
            $data['sfnext'] = $row['sfnext'];
            $data['sflstatus'] = $row['sflstatus'];
            $data['sfaddress'] = $row['sfaddress'];
            $data['sfeduc'] = $row['sfeduc'];
            $data['sfcontact'] = $row['sfcontact'];
            $data['sfoccu'] = $row['sfoccu'];
            $data['sfcompany'] = $row['sfcompany'];
            $data['smfname'] = $row['smfname'];
            $data['smmname'] = $row['smmname'];
            $data['smlname'] = $row['smlname'];
            $data['smnext'] = $row['smnext'];
            $data['smlstatus'] = $row['smlstatus'];
            $data['smaddress'] = $row['smaddress'];
            $data['smeduc'] = $row['smeduc'];
            $data['smcontact'] = $row['smcontact'];
            $data['smoccu'] = $row['smoccu'];
            $data['smcompany'] = $row['smcompany'];
            $data['snsibling'] = $row['snsibling'];
            $data['spcyincome'] = $row['spcyincome'];
            $data['spschname'] = $row['spschname'];
            $data['spsaddress'] = $row['spsaddress'];
            $data['spstype'] = $row['spstype'];
            $data['spscourse'] = $row['spscourse'];
            $data['spsyrlvl'] = $row['spsyrlvl'];
            $data['scsintend'] = $row['scsintend'];
            $data['scsadd'] = $row['scsadd'];
            $data['scschooltype'] = $row['scschooltype'];
            $data['sccourse'] = $row['sccourse'];
            $data['sccourseprio'] = $row['sccourseprio'];
            $data['scsyrlvl'] = $row['scsyrlvl'];
        }

        echo json_encode($data);
    }


   if($_POST['action'] == 'student_register')
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
            $error = '<div class="alert alert-danger">Email Already Exists</div>';
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
                szcode = :szcode,
                scontact = :scontact,
                semail = :semail,
                sctship = :sctship,
                scivilstat = :scivilstat,
                sdisability = :sdisability,
                s4psno = :s4psno,
                spwdid = :spwdid,
                srappsship = :srappsship,
                sgfname = :sgfname,
                sgmname = :sgmname,
                sglname = :sglname,
                sgnext = :sgnext,
                sglstatus = :sglstatus,
                sgaddress = :sgaddress,
                sgeduc = :sgeduc,
                sgcontact = :sgcontact,
                sgoccu = :sgoccu,
                sgcompany = :sgcompany,
                sffname = :sffname,
                sfmname = :sfmname,
                sflname = :sflname,
                sfnext = :sfnext,
                sflstatus = :sflstatus,
                sfaddress = :sfaddress,
                sfeduc = :sfeduc,
                sfcontact = :sfcontact,
                sfoccu = :sfoccu,
                sfcompany = :sfcompany,
                smfname = :smfname,
                smmname = :smmname,
                smlname = :smlname,
                smnext = :smnext,
                smlstatus = :smlstatus,
                smaddress = :smaddress,
                smeduc = :smeduc,
                smcontact = :smcontact,
                smoccu = :smoccu,
                smcompany = :smcompany,
                snsibling = :snsibling,
                spcyincome = :spcyincome,
                spschname = :spschname,
                spsaddress = :spsaddress,
                spstype = :spstype,
                spscourse = :spscourse,
                spsyrlvl = :spsyrlvl,
                scsintend = :scsintend,
                scsadd = :scsadd,
                scschooltype = :scschooltype,
                sccourse = :sccourse,
                sccourseprio = :sccourseprio,
                scsyrlvl = :scsyrlvl,
                spass = :spass,
                student_added_on = :student_added_on
                WHERE ss_id = '".$_POST["vss_id"]."'          
                ";

                $data = array(
                    ':sfname'				        =>	$object->clean_input($_POST["sfname"]),
                    ':smname'			            =>	$object->clean_input($_POST["smname"]),
                    ':slname'			            =>	$object->clean_input($_POST["slname"]),
                    ':snext'		                =>	$object->clean_input($_POST["snext"]),
                    ':sdbirth'				        =>	$object->clean_input($_POST["sdbirth"]),
                    ':sgender'				        =>	$object->clean_input($_POST["sgender"]),
                    ':saddress'				        =>	$object->clean_input($_POST["saddress"]),
                    ':szcode'		                =>	$object->clean_input($_POST["szcode"]),
                    ':scontact'				        =>	$object->clean_input($_POST["scontact"]),
                    ':semail'			            =>	$object->clean_input($_POST["semail"]),
                    ':sctship'			            =>	$object->clean_input($_POST["sctship"]),
                    ':scivilstat'		            =>	$object->clean_input($_POST["scivilstat"]),
                    ':sdisability'		            =>	$object->clean_input($_POST["sdisability"]),
                    ':s4psno'			            =>	$object->clean_input($_POST["s4psno"]),
                    ':spwdid'			            =>	$object->clean_input($_POST["spwdid"]),
                    ':srappsship'		            =>	$object->clean_input($_POST["srappsship"]),
                    ':sgfname'		                =>	$object->clean_input($_POST["sgfname"]),
                    ':sgmname'				        =>	$object->clean_input($_POST["sgmname"]),
                    ':sglname'			            =>	$object->clean_input($_POST["sglname"]),
                    ':sgnext'			            =>	$object->clean_input($_POST["sgnext"]),
                    ':sglstatus'		            =>	$object->clean_input($_POST["sglstatus"]),
                    ':sgaddress'			        =>	$object->clean_input($_POST["sgaddress"]),
                    ':sgeduc'				        =>	$object->clean_input($_POST["sgeduc"]),
                    ':sgcontact'			        =>	$object->clean_input($_POST["sgcontact"]),
                    ':sgoccu'		                =>	$object->clean_input($_POST["sgoccu"]),
                    ':sgcompany'			        =>	$object->clean_input($_POST["sgcompany"]),
                    ':sffname'			            =>	$object->clean_input($_POST["sffname"]),
                    ':sfmname'			            =>	$object->clean_input($_POST["sfmname"]),
                    ':sflname'		                =>	$object->clean_input($_POST["sflname"]),
                    ':sfnext'				        =>	$object->clean_input($_POST["sfnext"]),
                    ':sflstatus'			        =>	$object->clean_input($_POST["sflstatus"]),
                    ':sfaddress'			        =>	$object->clean_input($_POST["sfaddress"]),
                    ':sfeduc'		                =>	$object->clean_input($_POST["sfeduc"]),
                    ':sfcontact'		            =>	$object->clean_input($_POST["sfcontact"]),
                    ':sfoccu'			            =>	$object->clean_input($_POST["sfoccu"]),
                    ':sfcompany'			        =>	$object->clean_input($_POST["sfcompany"]),
                    ':smfname'			            =>	$object->clean_input($_POST["smfname"]),
                    ':smmname'			            =>	$object->clean_input($_POST["smmname"]),
                    ':smlname'		                =>	$object->clean_input($_POST["smlname"]),
                    ':smnext'				        =>	$object->clean_input($_POST["smnext"]),
                    ':smlstatus'			        =>	$object->clean_input($_POST["smlstatus"]),
                    ':smaddress'			        =>	$object->clean_input($_POST["smaddress"]),
                    ':smeduc'		                =>	$object->clean_input($_POST["smeduc"]),
                    ':smcontact'		            =>	$object->clean_input($_POST["smcontact"]),
                    ':smoccu'			            =>	$object->clean_input($_POST["smoccu"]),
                    ':smcompany'			        =>	$object->clean_input($_POST["smcompany"]),
                    ':snsibling'			        =>	$object->clean_input($_POST["snsibling"]),
                    ':spcyincome'			        =>	$object->clean_input($_POST["spcyincome"]),
                    ':spschname'			        =>	$object->clean_input($_POST["spschname"]),
                    ':spsaddress'			        =>	$object->clean_input($_POST["spsaddress"]),
                    ':spstype'		                =>	$object->clean_input($_POST["spstype"]),
                    ':spscourse'	                =>	$object->clean_input($_POST["spscourse"]),
                    ':spsyrlvl'			            =>	$object->clean_input($_POST["spsyrlvl"]),
                    ':scsintend'			        =>	$object->clean_input($_POST["scsintend"]),
                    ':scsadd'		                =>	$object->clean_input($_POST["scsadd"]),
                    ':scschooltype'	                =>	$object->clean_input($_POST["scschooltype"]),
                    ':sccourse'			            =>	$object->clean_input($_POST["sccourse"]),
                    ':sccourseprio'			        =>	$object->clean_input($_POST["sccourseprio"]),
                    ':scsyrlvl'			            =>	$object->clean_input($_POST["scsyrlvl"]),
                    ':spass'			            =>	$object->clean_input($_POST["spass"]),
                    ':student_added_on'				=>	$object->now
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

?>