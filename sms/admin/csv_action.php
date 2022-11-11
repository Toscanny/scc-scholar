<?php

include('../class/dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$object = new sms;

// Search and Table
	if(isset($_POST["action"]))
	{
		if($_POST["action"] == 'fetch')
		{
			$order_column = array('slname', 'sfname', 'smname', 'saddress', 'semail', 'scontact', 'sgender', 's_scholar_stat', 's_applied_on');
			/* Common Data
				+slname, +sfname, +smname, +sdbirth, +scontact, +sgender, +semail, +s_scholar_stat		
			*/
			$output = array();
			
			$main_query = "
			SELECT * FROM tbl_student WHERE s_scholar_stat = ''
			";

			$search_query = '';
			
			if(isset($_POST['search']['value']))
			{
				$search_query .= 'AND(slname LIKE "%'.$_POST['search']['value'].'%" '; 
				$search_query .= 'OR sfname LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR smname LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR sccourse LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR scsyrlvl LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR scontact LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR s_account_status LIKE "%'.$_POST['search']['value'].'%" ';
				$search_query .= 'OR s_scholarship_type LIKE "%'.$_POST['search']['value'].'%" )';
			}

			if(isset($_POST["order"]))
			{
				$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
			}
			else
			{
				$order_query = 'ORDER BY s_id ASC ';
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
						$sub_array[] = $check = '<div style="text-align: center;"><input type="checkbox" name="checkbox"class="checkbox" value="'.$row["s_id"].'" /></div>';
						$sub_array[] = $row["slname"];
						$sub_array[] = $row["sfname"];
						$sub_array[] = $row["smname"];
						$sub_array[] = $row["sccourse"];
						$sub_array[] = $row["scsyrlvl"];
						$sub_array[] = $row["scontact"];
						$status = '';
						if($row["s_account_status"] == 'Active')
						{
							$status = '<button type="button" name="status_button" class="btn btn-success btn-sm status_button" data-id="'.$row["s_id"].'" data-status="'.$row["s_account_status"].'">Active</button>';
						}
						if($row["s_account_status"] == 'Inactive')
						{
							$status = '<button type="button" name="status_button" class="btn btn-danger btn-sm status_button" data-id="'.$row["s_id"].'" data-status="'.$row["s_account_status"].'">Inactive</button>';
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
				<option value="">Set Count Data</option>
				<option value="ss_id">Student ID No.</option>
				<option value="slname">Last Name</option>
				<option value="sfname">First Name</option>
				<option value="smname">Middle Name</option>
				<option value="sgender">Gender</option>
				<option value="scsyrlvl">Year Level/Grade</option>
				<option value="sccourse">Course</option>
				<option value="spschname">Previous School Attended</option>
				<option value="sdbirth">Date of Birth</option>
				<option value="sfoccu">Father Occupation</option>
				<option value="sffname">Father Full Name</option>
				<option value="scontact">Contact Number</option>
				<option value="sgfname">Guardian Full Name</option>
				<option value="smfname">Mother Full Name</option>
				<option value="saddress">Address</option>
				<option value="s_scholarship_type">Student Scholarship Type</option>
				<option value="smoccu">Mother Occupation</option>
				<option value="scivilstat">Civil Status</option>
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

            $file_data = $_SESSION['file_data'];

            unset($_SESSION['file_data']);

            foreach($file_data as $row)
            {
				$seldate = date('Y-m-d', strtotime($row[$_POST["sdbirth"]])); 
				
				$data = array(

					':ss_id'	 				=>	 $row[$_POST["ss_id"]],
					':slname'	 				=>	 $row[$_POST["slname"]],
					':sdbirth'	 				=>	 $seldate

				);
				
			$object->query = "
			SELECT * FROM tbl_student	
			WHERE ss_id = :ss_id AND slname = :slname AND sdbirth = :sdbirth
			";

			$object->execute($data);
				
			if($object->row_count() == 0)
			{

				$insertdate = date('Y-m-d', strtotime($row[$_POST["sdbirth"]])); 

				$data = array(

					':ss_id'	 				=>	 $row[$_POST["ss_id"]],
					':slname'	 				=>	 $row[$_POST["slname"]],
					':sfname'	 				=>	 $row[$_POST["sfname"]],
					':smname'	 				=>	 $row[$_POST["smname"]],
					':sgender'	 				=>	 $row[$_POST["sgender"]],
					':scontact'	 				=>	 $row[$_POST["scontact"]],
					':sdbirth'	 				=>	 $insertdate,
					':saddress'	 				=>	 $row[$_POST["saddress"]],
					':scivilstat'	 			=>	 $row[$_POST["scivilstat"]],
					':sgfname'	 				=>	 $row[$_POST["sgfname"]],
					':sffname'	 				=>	 $row[$_POST["sffname"]],
					':sfoccu'	 				=>	 $row[$_POST["sfoccu"]],
					':smfname'	 				=>	 $row[$_POST["smfname"]],
					':smoccu'					=>	 $row[$_POST["smoccu"]],
					':spschname'	 			=>	 $row[$_POST["spschname"]],
					':scsyrlvl'	 				=>	 $row[$_POST["scsyrlvl"]],
					':sccourse'	 				=>	 $row[$_POST["sccourse"]],
					':s_scholarship_type'	 	=>	 $row[$_POST["s_scholarship_type"]]


				);

				$object->query = "
				INSERT INTO tbl_student 
				(ss_id, slname, sfname, smname, sgender, scontact, sdbirth,
				saddress, scivilstat, sgfname, sffname, sfoccu, smfname, smoccu,
				spschname, scsyrlvl, sccourse, s_account_status, s_scholarship_type) 
				VALUES (:ss_id, :slname, :sfname, :smname, :sgender, :scontact, :sdbirth,
				:saddress, :scivilstat, :sgfname, :sffname, :sfoccu, :smfname, :smoccu,
				:spschname, :scsyrlvl, :sccourse, 'Active', :s_scholarship_type)
				";

				$object->execute($data);

				$success = '<div class="alert alert-success">Data Imported Successfully</div>';

			}
			
		}

		$output = array(
			// 'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);
    }

// Export CSV
	if($_POST["action"] == 'exportsl_csv')
	{
		$title = array("Student ID No.", "Last Name", "First Name", "Middle Name", "Gender", "Year Level/Grade", "Course", "Previous School Attended", "Date of Birth", "Father Occupation", "Father Full Name", "Contact Number", "Guardian Full Name", "Mother Full Name", "Address", "Scholarship Type", "Mother Occupation", "Civil Status");
		$output = fopen('php://output', 'w');
		fputcsv($output, $title);			
		for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
		{

			$filename = 'reports.csv';

			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename=$filename");
			header("Pragma: no-cache");
			header("Expires: 0");
			
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
				$row[] = $rows["slname"];
				$row[] = $rows["sfname"];
				$row[] = $rows["smname"];
				$row[] = $rows["sgender"];
				$row[] = $rows["scsyrlvl"];
				$row[] = $rows["sccourse"];
				$row[] = $rows["spschname"];
				$row[] = $rows["sdbirth"];
				$row[] = $rows["sfoccu"];
				$row[] = $rows["sffname"];
				$row[] = $rows["scontact"];
				$row[] = $rows["sgfname"];
				$row[] = $rows["smfname"];
				$row[] = $rows["saddress"];
				$row[] = $rows["s_scholarship_type"];
				$row[] = $rows["smoccu"];
				$row[] = $rows["scivilstat"];

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