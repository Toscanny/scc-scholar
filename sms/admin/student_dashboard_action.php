<?php

include('../class/dbcon.php');

$object = new sms;

if(isset($_POST["action"]))
{

	if($_POST['action'] == 'student_register')
	{

		$success = '';

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
				scsyrlvl = :scsyrlvl
				WHERE s_id = '".$_SESSION["admin_id"]."'          
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
					':scsyrlvl'			            =>	$object->clean_input($_POST["scsyrlvl"])
				);

				$object->execute($data);

				$success = '<div class="alert alert-success">Student Data Added</div>';

		$output = array(
			'success'	=>	$success
		);
		echo json_encode($output);
	}
}

?>