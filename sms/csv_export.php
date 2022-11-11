<?php

include('class/dbcon.php');

$object = new sms;
			//Setup the filename that our CSV will have when it is downloaded.
			$filename = 'reports.csv';

			//Set the Content-Type and Content-Disposition headers to force the download.
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename=$filename");
			header("Pragma: no-cache");
			header("Expires: 0");
			
			$object->query = "
			SELECT * FROM tbl_student
			WHERE s_scholar_stat = ''
			";

			$object->execute();
			$result = $object->get_result();

			$content = array();
			$title = array("Student ID", "First Name", "Middle Initial", "Last Name", "Date of Birth", "Account Status");
			foreach ($result as $rows) {
				$row = array();
				$row[] = $rows["ss_id"];
				$row[] = $rows["sfname"];
				$row[] = $rows["smname"];
				$row[] = $rows["slname"];
				$row[] = $rows["sdbirth"];
				$row[] = $rows["s_account_status"];
				
				$content[] = $row;
				
			}
			$output = fopen('php://output', 'w');
			fputcsv($output, $title);
			foreach ($content as $con) {
				fputcsv($output, $con);
			}
			fclose($output);
?>