<?php

include('../class/dbcon.php');

$object = new sms;


// Search and Table
	if(isset($_POST["action"]))
	{
		if($_POST["action"] == 'fetch')
		{
			$order_column = array('salname', 'safname', 'samname', 'saaddress', 'sapemail', 'sacontact', 'sagender', 'sascholarstat', 'sadapply');
			/* Common Data
				+salname, +safname, +samname, +sadbirth, +sacontact, +sagender, +sapemail, +sascholarstat		
			*/
			$output = array();
			
			$main_query = "
			SELECT * FROM tbl_acad WHERE sascholarstat = 'Approved'
			";

			$search_query = '';
			
			if(isset($_POST['search']['value']))
			{
				$search_query .= 'AND (salname LIKE "%'.$_POST['search']['value'].'%" 
				OR safname LIKE "%'.$_POST['search']['value'].'%" 
				OR samname LIKE "%'.$_POST['search']['value'].'%" 
				OR saaddress LIKE "%'.$_POST['search']['value'].'%" 
				OR sacontact LIKE "%'.$_POST['search']['value'].'%"
				OR sapemail LIKE "%'.$_POST['search']['value'].'%")';
			}

			if(isset($_POST["order"]))
			{
				$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
			}
			else
			{
				$order_query = 'ORDER BY sacad_id ASC ';
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
						$sub_array[] = $check = '<div style="text-align: center;"><input type="checkbox" class="checkbox" value="'.$row["sacad_id"].'" /></div>';
						$sub_array[] = $row["salname"];
						$sub_array[] = $row["safname"];
						$sub_array[] = $row["samname"];
						$sub_array[] = $row["saaddress"];
						$sub_array[] = $row["sacontact"];
						$sub_array[] = $row["sagender"];
						$sub_array[] = $row["sapemail"];
						$status = '';
						if($row["sascholarstat"] == 'Pending')
						{
							$status = '<button type="button" name="status_button" class="btn btn-warning btn-sm status_button" data-id="'.$row["sacad_id"].'" data-status="'.$row["sascholarstat"].'">Pending</button>';
						}
						else if($row["sascholarstat"] == 'Approved')
						{
							$status = '<button type="button" name="status_button" class="btn btn-success btn-sm status_button" data-id="'.$row["sacad_id"].'" data-status="'.$row["sascholarstat"].'">Approved</button>';
						}
						else
						{
							$status = '<button type="button" name="status_button" class="btn btn-danger btn-sm status_button" data-id="'.$row["sacad_id"].'" data-status="'.$row["sascholarstat"].'">Rejected</button>';
						}
						$sub_array[] = $status;
						$sub_array[] = '
						<div align="center">
						<button type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" data-id="'.$row["sacad_id"].'"><i class="fas fa-eye"></i></button>
						<button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id="'.$row["sacad_id"].'"><i class="fas fa-edit"></i></button>
						<button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="'.$row["sacad_id"].'"><i class="fas fa-times"></i></button>
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
// Add Query
	if($_POST["action"] == 'Add')
	{
		$error = '';

		$success = '';

		$data = array(
			':saaemail'	=>	$_POST["saaemail"]
		);

		$object->query = "
		SELECT * FROM tbl_acad
		WHERE saaemail = :saaemail
		";

		$object->execute($data);

		if($object->row_count() > 0)
		{
			$error = '<div class="alert alert-danger">Email Address Already Exists</div>';
		}
		else
		{
			$object->query = "
			INSERT INTO tbl_acad
			(safname, samname, salname, sanext, sadbirth, sactship, saaddress, sapemail, sacontact, sacourse, sagyl, sagender, sagfname, sagmname,
			saglname, sagnext, sagaddress, sagcontact, sagoccu, sagcompany, saffname, safmname, saflname, safnext, safaddress, safcontact, safoccu,
			safcompany, samfname, sammname, samlname, samnext, samaddress, samcontact, samoccu, samcompany, saspcyincome, sagwa, saraward, 
			sadawardrceive, sadsprc, sadsprcstat, sadspgm, sadspgmstat, sadspcr, sadspcrstat, sacapstype, saaemail, sapass, sagrantstat, sascholarstat, sadapply) 
			VALUES (:safname, :samname, :salname, :sanext, :sadbirth, :sactship,:saaddress, :sapemail, :sacontact, :sacourse, :sagyl, :sagender, 
			:sagfname, :sagmname, :saglname, :sagnext, :sagaddress, :sagcontact, :sagoccu, :sagcompany, :saffname, :safmname, 
			:saflname, :safnext, :safaddress, :safcontact, :safoccu, :safcompany, :samfname, :sammname, :samlname, :samnext, 
			:samaddress, :samcontact, :samoccu, :samcompany, :saspcyincome, :sagwa, :saraward, :sadawardrceive, :sadsprc, :sadsprcstat, 
			:sadspgm, :sadspgmstat, :sadspcr, :sadspcrstat, 'Academic', :saaemail, :sapass, :sagrantstat, 'Pending', '$object->now')";
			
			$password_hash = password_hash($_POST["sapass"], PASSWORD_DEFAULT);

			if($error == '')
			{
				$data = array(
					// Personal Details
                    ':safname'					    =>	$object->clean_input($_POST["safname"]),
                    ':samname'					    =>	$object->clean_input($_POST["samname"]),
                    ':salname'					    =>	$object->clean_input($_POST["salname"]),
					':sanext'					  	=>	$object->clean_input($_POST["sanext"]),
                    ':sadbirth'					  	=>	$object->clean_input($_POST["sadbirth"]),
					':sactship'				    	=>	$object->clean_input($_POST["sactship"]),
                    ':saaddress'					=>	$object->clean_input($_POST["saaddress"]),
                    ':sapemail'					    =>	$object->clean_input($_POST["sapemail"]),
                    ':sacontact'					=>	$object->clean_input($_POST["sacontact"]),
					':sacourse'						=>	$object->clean_input($_POST["sacourse"]),
					':sagyl'						=>	$object->clean_input($_POST["sagyl"]),
                    ':sagender'					  	=>	$object->clean_input($_POST["sagender"]),
					// Family Details
					// Guardian Details
					':sagfname'				      	=>	$object->clean_input($_POST["sagfname"]),
					':sagmname'				      	=>	$object->clean_input($_POST["sagmname"]),
					':saglname'			        	=>	$object->clean_input($_POST["saglname"]),
					':sagnext'			        	=>	$object->clean_input($_POST["sagnext"]),
                    ':sagaddress'					=>	$object->clean_input($_POST["sagaddress"]),
                    ':sagcontact'					=>	$object->clean_input($_POST["sagcontact"]),
                    ':sagoccu'					    =>	$object->clean_input($_POST["sagoccu"]),
                    ':sagcompany'					=>	$object->clean_input($_POST["sagcompany"]),
					// Father Details
					':saffname'				      	=>	$object->clean_input($_POST["saffname"]),
                    ':safmname'					    =>	$object->clean_input($_POST["safmname"]),
                    ':saflname'					    =>	$object->clean_input($_POST["saflname"]),
					':safnext'			        	=>	$object->clean_input($_POST["safnext"]),
                    ':safaddress'					=>	$object->clean_input($_POST["safaddress"]),
                    ':safcontact'					=>	$object->clean_input($_POST["safcontact"]),
					':safoccu'				      	=>	$object->clean_input($_POST["safoccu"]),
					':safcompany'				   	=>	$object->clean_input($_POST["safcompany"]),
					// Mother Details
					':samfname'				      	=>	$object->clean_input($_POST["samfname"]),
                    ':sammname'					    =>	$object->clean_input($_POST["sammname"]),
                    ':samlname'					    =>	$object->clean_input($_POST["samlname"]),
					':samnext'			        	=>	$object->clean_input($_POST["samnext"]),
                    ':samaddress'					=>	$object->clean_input($_POST["samaddress"]),
                    ':samcontact'					=>	$object->clean_input($_POST["samcontact"]),
					':samoccu'				      	=>	$object->clean_input($_POST["samoccu"]),
					':samcompany'				    =>	$object->clean_input($_POST["samcompany"]),
                    ':saspcyincome'				  	=>	$object->clean_input($_POST["saspcyincome"]),
					// Achievement Details
                    ':sagwa'				      	=>	$object->clean_input($_POST["sagwa"]),
                    ':saraward'					  	=>	$object->clean_input($_POST["saraward"]),
                    ':sadawardrceive'		  		=>	$object->clean_input($_POST["sadawardrceive"]),
					// Requirements Details
					':sadsprc'				    	=>	$object->clean_input($_POST["sadsprc"]),
                    ':sadsprcstat'				    =>	$object->clean_input($_POST["sadsprcstat"]),
					':sadspgm'						=>	$object->clean_input($_POST["sadspgm"]),
                    ':sadspgmstat'					=>	$object->clean_input($_POST["sadspgmstat"]),
					':sadspcr'		  				=>	$object->clean_input($_POST["sadspcr"]),
                    ':sadspcrstat'		  			=>	$object->clean_input($_POST["sadspcrstat"]),
					// Scholarship Status Details 
					':sagrantstat'					=>	$object->clean_input($_POST["sagrantstat"]),
					// Account Details
					':saaemail'			      		=>	$object->clean_input($_POST["saaemail"]),
					':sapass'				      	=>  $password_hash
 				);

				$object->execute($data);

				$success = '<div class="alert alert-success">Applicant Data Added</div>';
			}
		}

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);

	}
// Upload
	if($_POST["action"] == 'Upload')
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
				<option value="safname">First Name</option>
				<option value="salname">Last Name</option>
				<option value="sapemail">Email</option>
			</select>
		</th>
		';
		}

		$html .= '</tr>';

		$limit = 0;

		while(($row = fgetcsv($file_data)) !== FALSE)
		{
		$limit++;

		if($limit < 4)
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

		$html .= '
		</table>
		<br />
		<div align="right">
		<button type="button" name="import" id="import" class="btn btn-success" disabled>Import</button>
		</div>
		<br />
		';
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
// Import
	if($_POST["action"] == 'Import'){

		$error = '';

		$success = '';

		if($error == '')
		{
		$file_data = $_SESSION['file_data'];

		unset($_SESSION['file_data']);

		foreach($file_data as $row)
		{
		$data[] = '("'.$row[$_POST["safname"]].'", "'.$row[$_POST["salname"]].'", "'.$row[$_POST["sapemail"]].'")';
		}

		$object->query = "
		INSERT INTO tbl_acad 
		(safname, salname, sapemail) 
		VALUES ".implode(",", $data)."
		";

		$object->execute($data);

		echo 'Data Imported Successfully';

		}

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);
	}

// Single Fetch Query
	if($_POST["action"] == 'fetch_single')
	{
		$object->query = "
		SELECT * FROM tbl_acad 
		WHERE sacad_id = '".$_POST["sacad_id"]."'
		";

		$result = $object->get_result();

		$data = array();

		foreach($result as $row)
		{
			// Account Details
			$data['saaemail'] = $row['saaemail'];
			$data['sapass'] = $row['sapass'];
			// Personal Details
			$data['safname'] = $row['safname'];
			$data['samname'] = $row['samname'];
			$data['salname'] = $row['salname'];
			$data['sanext'] = $row['sanext'];
			$data['sadbirth'] = $row['sadbirth'];
			$data['sactship'] = $row['sactship'];
			$data['saaddress'] = $row['saaddress'];
			$data['sapemail'] = $row['sapemail'];
			$data['sacontact'] = $row['sacontact'];
			$data['sacourse'] = $row['sacourse'];
			$data['sagyl'] = $row['sagyl'];
			$data['sagender'] = $row['sagender'];
			// Family Details
			// Guardian Details
			$data['sagfname'] = $row['sagfname'];
			$data['sagmname'] = $row['sagmname'];
			$data['saglname'] = $row['saglname'];
			$data['sagnext'] = $row['sagnext'];
			$data['sagaddress'] = $row['sagaddress'];
			$data['sagcontact'] = $row['sagcontact'];
			$data['sagoccu'] = $row['sagoccu'];
			$data['sagcompany'] = $row['sagcompany'];
			// Father Details
			$data['saffname'] = $row['saffname'];
			$data['safmname'] = $row['safmname'];
			$data['saflname'] = $row['saflname'];
			$data['safnext'] = $row['safnext'];
			$data['safaddress'] = $row['safaddress'];
			$data['safcontact'] = $row['safcontact'];
			$data['safoccu'] = $row['safoccu'];
			$data['safcompany'] = $row['safcompany'];
			// Mother Details
			$data['samfname'] = $row['samfname'];
			$data['sammname'] = $row['sammname'];
			$data['samlname'] = $row['samlname'];
			$data['samnext'] = $row['samnext'];
			$data['samaddress'] = $row['samaddress'];
			$data['samcontact'] = $row['samcontact'];
			$data['samoccu'] = $row['samoccu'];
			$data['samcompany'] = $row['samcompany'];
			$data['saspcyincome'] = $row['saspcyincome'];
			// Achievement Details
			$data['sagwa'] = $row['sagwa'];
			$data['saraward'] = $row['saraward'];
			$data['sadawardrceive'] = $row['sadawardrceive'];
			// Requirement Details
			$data['sadsprc'] = $row['sadsprc'];
			$data['sadsprcstat'] = $row['sadsprcstat'];
			$data['sadspgm'] = $row['sadspgm'];
			$data['sadspgmstat'] = $row['sadspgmstat'];
			$data['sadspcr'] = $row['sadspcr'];
			$data['sadspcrstat'] = $row['sadspcrstat'];
			// Scholar Type
			$data['sacapstype'] = $row['sacapstype'];
			$data['sagrantstat'] = $row['sagrantstat'];
			$data['sascholarstat'] = $row['sascholarstat'];
			$data['sadapply'] = $row['sadapply'];
		}

		echo json_encode($data);
	}

// Edit Query
	if($_POST["action"] == 'Edit')
	{
		$error = '';

		$success = '';

		$data = array(
			':saaemail'	=>	$_POST["saaemail"],
			':sacad_id'			=>	$_POST['hidden_id']
		);

		$object->query = "
		SELECT * FROM tbl_acad 
		WHERE saaemail = :saaemail 
		AND sacad_id != :sacad_id
		";

		$object->execute($data);

		if($object->row_count() > 0)
		{
			$error = '<div class="alert alert-danger">Email Address Already Exists</div>';
		}
		else
		{
				
			if($error == '')
			{
				$object->query = "
				UPDATE tbl_acad
				SET saaemail = :saaemail,
				sapass = :sapass,
				safname = :safname,
				samname = :samname,
				salname = :salname,
				sanext = :sanext,
				sadbirth = :sadbirth,
				sactship = :sactship,
				saaddress = :saaddress,
				sapemail = :sapemail,
				sacontact = :sacontact,
				sacourse = :sacourse,
				sagyl = :sagyl,
				sagender = :sagender,
				sagfname = :sagfname, 
				sagmname = :sagmname,
				saglname = :saglname,
				sagnext = :sagnext,
				sagaddress = :sagaddress,
				sagcontact = :sagcontact,
				sagoccu = :sagoccu,
				sagcompany = :sagcompany,
				saffname = :saffname,
				safmname = :safmname,
				saflname = :saflname,
				safnext = :safnext,
				safaddress = :safaddress,
				safcontact = :safcontact,
				safoccu = :safoccu,
				safcompany = :safcompany,
				samfname = :samfname,
				sammname = :sammname,
				samlname = :samlname,
				samnext = :samnext,
				samaddress = :samaddress,
				samcontact = :samcontact,
				samoccu = :samoccu,
				samcompany = :samcompany,
				saspcyincome = :saspcyincome,
				sagwa = :sagwa,
				saraward = :saraward,
				sadawardrceive = :sadawardrceive,
				sadsprc = :sadsprc,
				sadsprcstat = :sadsprcstat,
				sadspgm = :sadspgm,
				sadspgmstat = :sadspgmstat,
				sadspcr = :sadspcr,
				sadspcrstat = :sadspcrstat,
				sagrantstat = :sagrantstat
				WHERE sacad_id = '".$_POST['hidden_id']."'
				";

				$password_hash = password_hash($_POST["sapass"], PASSWORD_DEFAULT);

				$data = array(
					// Account Details
					':saaemail'			      		=>	$object->clean_input($_POST["saaemail"]),
					':sapass'				      	=>  $password_hash,
					// Personal Details
                    ':safname'					    =>	$object->clean_input($_POST["safname"]),
                    ':samname'					    =>	$object->clean_input($_POST["samname"]),
                    ':salname'					    =>	$object->clean_input($_POST["salname"]),
					':sanext'					    =>	$object->clean_input($_POST["sanext"]),
                    ':sadbirth'					  	=>	$object->clean_input($_POST["sadbirth"]),
					':sactship'				    	=>	$object->clean_input($_POST["sactship"]),
                    ':saaddress'					=>	$object->clean_input($_POST["saaddress"]),
                    ':sapemail'					    =>	$object->clean_input($_POST["sapemail"]),
                    ':sacontact'					=>	$object->clean_input($_POST["sacontact"]),
					':sacourse'						=>	$object->clean_input($_POST["sacourse"]),
					':sagyl'						=>	$object->clean_input($_POST["sagyl"]),
                    ':sagender'					  	=>	$object->clean_input($_POST["sagender"]),
					// Family Details
					// Guardian Details
					':sagfname'				      	=>	$object->clean_input($_POST["sagfname"]),
					':sagmname'				      	=>	$object->clean_input($_POST["sagmname"]),
					':saglname'			        	=>	$object->clean_input($_POST["saglname"]),
					':sagnext'			        	=>	$object->clean_input($_POST["sagnext"]),
                    ':sagaddress'					=>	$object->clean_input($_POST["sagaddress"]),
                    ':sagcontact'					=>	$object->clean_input($_POST["sagcontact"]),
                    ':sagoccu'					    =>	$object->clean_input($_POST["sagoccu"]),
                    ':sagcompany'					=>	$object->clean_input($_POST["sagcompany"]),
					// Father Details
					':saffname'				      	=>	$object->clean_input($_POST["saffname"]),
                    ':safmname'					    =>	$object->clean_input($_POST["safmname"]),
                    ':saflname'					    =>	$object->clean_input($_POST["saflname"]),
					':safnext'			        	=>	$object->clean_input($_POST["safnext"]),
                    ':safaddress'					=>	$object->clean_input($_POST["safaddress"]),
                    ':safcontact'					=>	$object->clean_input($_POST["safcontact"]),
					':safoccu'				      	=>	$object->clean_input($_POST["safoccu"]),
					':safcompany'				   	=>	$object->clean_input($_POST["safcompany"]),
					// Mother Details
					':samfname'				      	=>	$object->clean_input($_POST["samfname"]),
                    ':sammname'					    =>	$object->clean_input($_POST["sammname"]),
                    ':samlname'					    =>	$object->clean_input($_POST["samlname"]),
					':samnext'			        	=>	$object->clean_input($_POST["samnext"]),
                    ':samaddress'					=>	$object->clean_input($_POST["samaddress"]),
                    ':samcontact'					=>	$object->clean_input($_POST["samcontact"]),
					':samoccu'				      	=>	$object->clean_input($_POST["samoccu"]),
					':samcompany'				    =>	$object->clean_input($_POST["samcompany"]),
                    ':saspcyincome'				  	=>	$object->clean_input($_POST["saspcyincome"]),
					// Achievement Details
                    ':sagwa'				      	=>	$object->clean_input($_POST["sagwa"]),
                    ':saraward'					  	=>	$object->clean_input($_POST["saraward"]),
                    ':sadawardrceive'		  		=>	$object->clean_input($_POST["sadawardrceive"]),
					// Requirement Details
                    ':sadsprc'					  	=>	$object->clean_input($_POST["sadsprc"]),
                    ':sadsprcstat'					=>	$object->clean_input($_POST["sadsprcstat"]),
					':sadspgm'				    	=>	$object->clean_input($_POST["sadspgm"]),
					':sadspgmstat'					=>	$object->clean_input($_POST["sadspgmstat"]),
                    ':sadspcr'					  	=>	$object->clean_input($_POST["sadspcr"]),
					':sadspcrstat'				    =>	$object->clean_input($_POST["sadspcrstat"]),
					// Scholar Type
					':sagrantstat'				    =>	$object->clean_input($_POST["sagrantstat"])
 				);

				$object->execute($data);

				$success = '<div class="alert alert-success">Applicant Data Updated</div>';
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
			':sascholarstat'		=>	$_POST['next_status']
		);

		$object->query = "
		UPDATE tbl_acad
		SET sascholarstat = :sascholarstat 
		WHERE sacad_id = '".$_POST["id"]."'
		";

		$object->execute($data);

		echo '<div class="alert alert-success">Class Status change to '.$_POST['next_status'].'</div>';
	}

	if($_POST["action"] == 'approve_all')
	{
		for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
		{
		$object->query = "
			UPDATE tbl_acad 
			SET sascholarstat = 'Approved'
			WHERE sacad_id = '".$_POST["checkbox_value"][$count]."'";

			$object->execute();
		}
		echo '<div class="alert alert-success">Selected Applicant Data Approved</div>';
	}

	if($_POST["action"] == 'reject_all')
	{
		for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
		{
		$object->query = "
			UPDATE tbl_acad 
			SET sascholarstat = 'Rejected'
			WHERE sacad_id = '".$_POST["checkbox_value"][$count]."'";

			$object->execute();
		}
		echo '<div class="alert alert-success">Selected Applicant Data Rejected</div>';
	}

	if($_POST["action"] == 'delete_all')
	{
		for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
		{
		$object->query = "
			DELETE FROM tbl_acad 
			WHERE sacad_id = '".$_POST["checkbox_value"][$count]."'";

			$object->execute();
		}
		echo '<div class="alert alert-success">Selected Applicant Data Deleted</div>';
	}

	if($_POST["action"] == 'delete')
	{
		$object->query = "
		DELETE FROM tbl_acad 
		WHERE sacad_id = '".$_POST["id"]."'
		";

		$object->execute();

		echo '<div class="alert alert-success">Academic Applicant Data Deleted</div>';
	}
	}

	?>