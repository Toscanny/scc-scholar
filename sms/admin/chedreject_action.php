<?php

include('../class/dbcon.php');

$object = new sms;


// Search and Table
    if(isset($_POST["action"]))
    {
        if($_POST["action"] == 'fetch')
        {
            $order_column = array('scmlname', 'scfname', 'scmname', 'scmnext', 'scsaddress', 'scpemail', 'scmnum', 'scgender', 'scschstat', 'scdapply');
            /* Common Data
                +scmlname, +scfname, +scmname, +scmnum, +scmnext, +scgender, +scpemail, +scschstat		
            */
            $output = array();
            
            $main_query = "
            SELECT * FROM tbl_ched WHERE scschstat = 'Rejected'
            ";

            $search_query = '';
            
            if(isset($_POST['search']['value']))
            {
                $search_query .= 'AND (scmlname LIKE "%'.$_POST['search']['value'].'%" 
                OR scfname LIKE "%'.$_POST['search']['value'].'%" 
                OR scmname LIKE "%'.$_POST['search']['value'].'%" 
                OR scsaddress LIKE "%'.$_POST['search']['value'].'%" 
                OR scmnum LIKE "%'.$_POST['search']['value'].'%"
                OR scpemail LIKE "%'.$_POST['search']['value'].'%")';
            }

            if(isset($_POST["order"]))
            {
                $order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
            }
            else
            {
                $order_query = 'ORDER BY sched_id ASC ';
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
                        $sub_array[] = $check = '<div style="text-align: center;"><input type="checkbox" class="checkbox" value="'.$row["sched_id"].'" /></div>';
                        $sub_array[] = $row["scmlname"];
                        $sub_array[] = $row["scfname"];
                        $sub_array[] = $row["scmname"];
                        $sub_array[] = $row["scmnext"];
                        $sub_array[] = $row["scsaddress"];
                        $sub_array[] = $row["scmnum"];
                        $sub_array[] = $row["scgender"];
                        $sub_array[] = $row["scpemail"];
                        $status = '';
                        if($row["scschstat"] == 'Pending')
                        {
                            $status = '<button type="button" name="status_button" class="btn btn-warning btn-sm status_button" data-id="'.$row["sched_id"].'" data-status="'.$row["scschstat"].'">Pending</button>';
                        }
                        else if($row["scschstat"] == 'Approved')
                        {
                            $status = '<button type="button" name="status_button" class="btn btn-success btn-sm status_button" data-id="'.$row["sched_id"].'" data-status="'.$row["scschstat"].'">Approved</button>';
                        }
                        else
                        {
                            $status = '<button type="button" name="status_button" class="btn btn-danger btn-sm status_button" data-id="'.$row["sched_id"].'" data-status="'.$row["scschstat"].'">Rejected</button>';
                        }
                        $sub_array[] = $status;
                        $sub_array[] = '
                        <div align="center">
                        <button type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" data-id="'.$row["sched_id"].'"><i class="fas fa-eye"></i></button>
                        <button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id="'.$row["sched_id"].'"><i class="fas fa-edit"></i></button>
                        <button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="'.$row["sched_id"].'"><i class="fas fa-times"></i></button>
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
            ':scaemail'	=>	$_POST["scaemail"]
        );

        $object->query = "
        SELECT * FROM tbl_ched
        WHERE scaemail = :scaemail
        ";

        $object->execute($data);

        if($object->row_count() > 0)
        {
            $error = '<div class="alert alert-danger">Email Address Already Exists</div>';
        }
        else
        {
            $object->query = "
            INSERT INTO tbl_ched
            (scfname, scmname, sclname, scnext, scdbirth, scgender, sccivilstat, scpbirth, scaddress, sczcode, scschname, scsaddress,  
            scstype, schygrade, scctship, scmnum, scpemail, scdisability, scflname, scffname, scfmname, scfnext, scfstatus, scfaddress, scfoccu, 
            scfeduc, scmlname, scmfname, scmmname, scmnext, scmstatus, scmaddress, scmoccu, scmeduc, scptgross, scnsibling, scsintend, scsadd, 
            scschooltype, sccourse, sccoursestat, scdrprc, scdrprcstat, scdrbrgyin, scdrbrgyinstat, scdrpgm, scdrpgmstat, scschtype, scaemail, scapass, scgrantstat, 
            scschstat, scdapply) 
            VALUES (:scfname, :scmname, :sclname, :scnext, :scdbirth, :scgender, :sccivilstat, :scpbirth, :scaddress, :sczcode, 
            :scschname, :scsaddress, :scstype, :schygrade, :scctship, :scmnum, :scpemail, :scdisability, :scflname, :scffname, :scfmname, 
            :scfnext, :scfstatus, :scfaddress, :scfoccu, :scfeduc, :scmlname, :scmfname, :scmmname, :scmnext, :scmstatus, :scmaddress, :scmoccu, :scmeduc, 
            :scptgross, :scnsibling, :scsintend, :scsadd, :scschooltype, :sccourse, :sccoursestat, :scdrprc, :scdrprcstat, :scdrbrgyin, :scdrbrgyinstat, 
            :scdrpgm, :scdrpgmstat, 'CHED', :scaemail, :scapass, :scgrantstat, 'Pending', '$object->now')";
            
            $password_hash = password_hash($_POST["scapass"], PASSWORD_DEFAULT);

            if($error == '')
            {
                $data = array(
                    // Personal Details
                    ':scfname'					    =>	$object->clean_input($_POST["scfname"]),
                    ':scmname'					    =>	$object->clean_input($_POST["scmname"]),
                    ':sclname'					    =>	$object->clean_input($_POST["sclname"]),
                    ':scnext'					  	=>	$object->clean_input($_POST["scnext"]),
                    ':scdbirth'					  	=>	$object->clean_input($_POST["scdbirth"]),
                    ':scgender'					  	=>	$object->clean_input($_POST["scgender"]),
                    ':sccivilstat'				    =>	$object->clean_input($_POST["sccivilstat"]),
                    ':scpbirth'						=>	$object->clean_input($_POST["scpbirth"]),
                    ':scaddress'					=>	$object->clean_input($_POST["scaddress"]),
                    ':sczcode'						=>	$object->clean_input($_POST["sczcode"]),
                    ':scschname'					=>	$object->clean_input($_POST["scschname"]),
                    ':scsaddress'					=>	$object->clean_input($_POST["scsaddress"]),
                    ':scstype'						=>	$object->clean_input($_POST["scstype"]),
                    ':schygrade'					=>	$object->clean_input($_POST["schygrade"]),
                    ':scctship'						=>	$object->clean_input($_POST["scctship"]),
                    ':scmnum'					    =>	$object->clean_input($_POST["scmnum"]),
                    ':scpemail'					    =>	$object->clean_input($_POST["scpemail"]),
                    ':scdisability'					=>	$object->clean_input($_POST["scdisability"]),
                    // Family Details
                    // Father Details
                    ':scffname'				      	=>	$object->clean_input($_POST["scffname"]),
                    ':scfmname'					    =>	$object->clean_input($_POST["scfmname"]),
                    ':scflname'					    =>	$object->clean_input($_POST["scflname"]),
                    ':scfnext'			        	=>	$object->clean_input($_POST["scfnext"]),
                    ':scfstatus'			        =>	$object->clean_input($_POST["scfstatus"]),
                    ':scfaddress'					=>	$object->clean_input($_POST["scfaddress"]),
                    ':scfoccu'				      	=>	$object->clean_input($_POST["scfoccu"]),
                    ':scfeduc'					    =>	$object->clean_input($_POST["scfeduc"]),
                    // Mother Details
                    ':scmfname'				      	=>	$object->clean_input($_POST["scmfname"]),
                    ':scmmname'					    =>	$object->clean_input($_POST["scmmname"]),
                    ':scmlname'					    =>	$object->clean_input($_POST["scmlname"]),
                    ':scmnext'			        	=>	$object->clean_input($_POST["scmnext"]),
                    ':scmstatus'			        =>	$object->clean_input($_POST["scmstatus"]),
                    ':scmaddress'					=>	$object->clean_input($_POST["scmaddress"]),
                    ':scmoccu'				      	=>	$object->clean_input($_POST["scmoccu"]),
                    ':scmeduc'					    =>	$object->clean_input($_POST["scmeduc"]),
                    ':scptgross'				    =>	$object->clean_input($_POST["scptgross"]),
                    ':scnsibling'				  	=>	$object->clean_input($_POST["scnsibling"]),
                    // Education Details
                    ':scsintend'				    =>	$object->clean_input($_POST["scsintend"]),
                    ':scsadd'					    =>	$object->clean_input($_POST["scsadd"]),
                    ':scschooltype'		  			=>	$object->clean_input($_POST["scschooltype"]),
                    ':sccourse'				        =>	$object->clean_input($_POST["sccourse"]),
                    ':sccoursestat'					=>	$object->clean_input($_POST["sccoursestat"]),
                    // Requirements Details
                    ':scdrprc'				   		=>	$object->clean_input($_POST["scdrprc"]),
                    ':scdrprcstat'					=>	$object->clean_input($_POST["scdrprcstat"]),
                    ':scdrpgm'		  				=>	$object->clean_input($_POST["scdrpgm"]),
                    ':scdrpgmstat'				    =>	$object->clean_input($_POST["scdrpgmstat"]),
                    ':scdrbrgyin'				    =>	$object->clean_input($_POST["scdrbrgyin"]),
                    ':scdrbrgyinstat'				=>	$object->clean_input($_POST["scdrbrgyinstat"]),
                    // Scholarship Status Details 
                    ':scgrantstat'					=>	$object->clean_input($_POST["scgrantstat"]),
                    // Account Details
                    ':scaemail'			      		=>	$object->clean_input($_POST["scaemail"]),
                    ':scapass'				      	=>  $password_hash
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

// Single Fetch Query
    if($_POST["action"] == 'fetch_single')
    {
        $object->query = "
        SELECT * FROM tbl_ched 
        WHERE sched_id = '".$_POST["sched_id"]."'
        ";

        $result = $object->get_result();

        $data = array();

        foreach($result as $row)
        {
            // Account Details
            $data['scaemail'] = $row['scaemail'];
            $data['scapass'] = $row['scapass'];
            // Personal Details
            $data['scfname'] = $row['scfname'];
            $data['scmname'] = $row['scmname'];
            $data['sclname'] = $row['sclname'];
            $data['scnext'] = $row['scnext'];
            $data['scdbirth'] = $row['scdbirth'];
            $data['scgender'] = $row['scgender'];
            $data['sccivilstat'] = $row['sccivilstat'];
            $data['scpbirth'] = $row['scpbirth'];
            $data['scaddress'] = $row['scaddress'];
            $data['sczcode'] = $row['sczcode'];
            $data['scschname'] = $row['scschname'];
            $data['scsaddress'] = $row['scsaddress'];
            $data['scstype'] = $row['scstype'];
            $data['schygrade'] = $row['schygrade'];
            $data['scctship'] = $row['scctship'];
            $data['scmnum'] = $row['scmnum'];
            $data['scpemail'] = $row['scpemail'];
            $data['scdisability'] = $row['scdisability'];
            // Family Details
            // Father Details
            $data['scffname'] = $row['scffname'];
            $data['scfmname'] = $row['scfmname'];
            $data['scflname'] = $row['scflname'];
            $data['scfnext'] = $row['scfnext'];
            $data['scfstatus'] = $row['scfstatus'];
            $data['scfaddress'] = $row['scfaddress'];
            $data['scfoccu'] = $row['scfoccu'];
            $data['scfeduc'] = $row['scfeduc'];
            // Mother Details
            $data['scmfname'] = $row['scmfname'];
            $data['scmmname'] = $row['scmmname'];
            $data['scmlname'] = $row['scmlname'];
            $data['scmnext'] = $row['scmnext'];
            $data['scmstatus'] = $row['scmstatus'];
            $data['scmaddress'] = $row['scmaddress'];
            $data['scmoccu'] = $row['scmoccu'];
            $data['scmeduc'] = $row['scmeduc'];
            $data['scptgross'] = $row['scptgross'];
            $data['scnsibling'] = $row['scnsibling'];
            // Education Details
            $data['scsintend'] = $row['scsintend'];
            $data['scsadd'] = $row['scsadd'];
            $data['scschooltype'] = $row['scschooltype']; 
            $data['sccourse'] = $row['sccourse'];
            $data['sccoursestat'] = $row['sccoursestat']; 
            // Requirement Details
            $data['scdrprc'] = $row['scdrprc'];
            $data['scdrprcstat'] = $row['scdrprcstat'];
            $data['scdrpgm'] = $row['scdrpgm'];
            $data['scdrpgmstat'] = $row['scdrpgmstat'];
            $data['scdrbrgyin'] = $row['scdrbrgyin'];
            $data['scdrbrgyinstat'] = $row['scdrbrgyinstat'];
            // Scholar Type
            $data['scschtype'] = $row['scschtype'];
            $data['scgrantstat'] = $row['scgrantstat'];
            $data['scschstat'] = $row['scschstat'];
            $data['scdapply'] = $row['scdapply'];
        }

        echo json_encode($data);
    }

// Edit Query
    if($_POST["action"] == 'Edit')
    {
        $error = '';

        $success = '';

        $data = array(
            ':scaemail'		=>	$_POST["scaemail"],
            ':sched_id'	=>	$_POST['hidden_id']
        );

        $object->query = "
        SELECT * FROM tbl_ched 
        WHERE scaemail = :scaemail 
        AND sched_id != :sched_id
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
                UPDATE tbl_ched
                SET scaemail = :scaemail,
                scapass = :scapass,
                scfname = :scfname,
                scmname = :scmname,
                sclname = :sclname,
                scnext = :scnext,
                scdbirth = :scdbirth,
                scgender = :scgender,
                sccivilstat = :sccivilstat,
                scpbirth = :scpbirth,
                scaddress = :scaddress,
                sczcode = :sczcode,
                scschname = :scschname,
                scsaddress = :scsaddress,
                scstype = :scstype,
                schygrade = :schygrade,
                scctship = :scctship,
                scmnum = :scmnum,
                scpemail = :scpemail,
                scdisability = :scdisability,
                scffname = :scffname,
                scfmname = :scfmname,
                scflname = :scflname,
                scfnext = :scfnext,
                scfstatus = :scfstatus,
                scfaddress = :scfaddress,
                scfoccu = :scfoccu,
                scfeduc = :scfeduc,
                scmfname = :scmfname,
                scmmname = :scmmname,
                scmlname = :scmlname,
                scmnext = :scmnext,
                scmstatus = :scmstatus,
                scmaddress = :scmaddress,
                scmoccu = :scmoccu,
                scmeduc = :scmeduc,
                scptgross = :scptgross,
                scnsibling = :scnsibling,
                scsintend = :scsintend,
                scsadd = :scsadd,
                scschooltype = :scschooltype,
                sccourse = :sccourse,
                sccoursestat = :sccoursestat,
                scdrprc = :scdrprc,
                scdrprcstat = :scdrprcstat,
                scdrpgm = :scdrpgm,
                scdrpgmstat = :scdrpgmstat,
                scdrbrgyin = :scdrbrgyin,
                scdrbrgyinstat = :scdrbrgyinstat,
                scgrantstat = :scgrantstat
                WHERE sched_id = '".$_POST['hidden_id']."'
                ";

                $password_hash = password_hash($_POST["scapass"], PASSWORD_DEFAULT);

                $data = array(
                    // Personal Details
                    ':scfname'					    =>	$object->clean_input($_POST["scfname"]),
                    ':scmname'					    =>	$object->clean_input($_POST["scmname"]),
                    ':sclname'					    =>	$object->clean_input($_POST["sclname"]),
                    ':scnext'					  	=>	$object->clean_input($_POST["scnext"]),
                    ':scdbirth'					  	=>	$object->clean_input($_POST["scdbirth"]),
                    ':scgender'					  	=>	$object->clean_input($_POST["scgender"]),
                    ':sccivilstat'				    =>	$object->clean_input($_POST["sccivilstat"]),
                    ':scpbirth'						=>	$object->clean_input($_POST["scpbirth"]),
                    ':scaddress'					=>	$object->clean_input($_POST["scaddress"]),
                    ':sczcode'						=>	$object->clean_input($_POST["sczcode"]),
                    ':scschname'					=>	$object->clean_input($_POST["scschname"]),
                    ':scsaddress'					=>	$object->clean_input($_POST["scsaddress"]),
                    ':scstype'						=>	$object->clean_input($_POST["scstype"]),
                    ':schygrade'					=>	$object->clean_input($_POST["schygrade"]),
                    ':scctship'						=>	$object->clean_input($_POST["scctship"]),
                    ':scmnum'					    =>	$object->clean_input($_POST["scmnum"]),
                    ':scpemail'					    =>	$object->clean_input($_POST["scpemail"]),
                    ':scdisability'					=>	$object->clean_input($_POST["scdisability"]),
                    // Family Details
                    // Father Details
                    ':scffname'				      	=>	$object->clean_input($_POST["scffname"]),
                    ':scfmname'					    =>	$object->clean_input($_POST["scfmname"]),
                    ':scflname'					    =>	$object->clean_input($_POST["scflname"]),
                    ':scfnext'			        	=>	$object->clean_input($_POST["scfnext"]),
                    ':scfstatus'			        =>	$object->clean_input($_POST["scfstatus"]),
                    ':scfaddress'					=>	$object->clean_input($_POST["scfaddress"]),
                    ':scfoccu'				      	=>	$object->clean_input($_POST["scfoccu"]),
                    ':scfeduc'					    =>	$object->clean_input($_POST["scfeduc"]),
                    // Mother Details
                    ':scmfname'				      	=>	$object->clean_input($_POST["scmfname"]),
                    ':scmmname'					    =>	$object->clean_input($_POST["scmmname"]),
                    ':scmlname'					    =>	$object->clean_input($_POST["scmlname"]),
                    ':scmnext'			        	=>	$object->clean_input($_POST["scmnext"]),
                    ':scmstatus'			        =>	$object->clean_input($_POST["scmstatus"]),
                    ':scmaddress'					=>	$object->clean_input($_POST["scmaddress"]),
                    ':scmoccu'				      	=>	$object->clean_input($_POST["scmoccu"]),
                    ':scmeduc'					    =>	$object->clean_input($_POST["scmeduc"]),
                    ':scptgross'				    =>	$object->clean_input($_POST["scptgross"]),
                    ':scnsibling'				  	=>	$object->clean_input($_POST["scnsibling"]),
                    // Education Details
                    ':scsintend'				    =>	$object->clean_input($_POST["scsintend"]),
                    ':scsadd'					    =>	$object->clean_input($_POST["scsadd"]),
                    ':scschooltype'		  			=>	$object->clean_input($_POST["scschooltype"]),
                    ':sccourse'				        =>	$object->clean_input($_POST["sccourse"]),
                    ':sccoursestat'					=>	$object->clean_input($_POST["sccoursestat"]),
                    // Requirements Details
                    ':scdrprc'				   		=>	$object->clean_input($_POST["scdrprc"]),
                    ':scdrprcstat'					=>	$object->clean_input($_POST["scdrprcstat"]),
                    ':scdrpgm'		  				=>	$object->clean_input($_POST["scdrpgm"]),
                    ':scdrpgmstat'				    =>	$object->clean_input($_POST["scdrpgmstat"]),
                    ':scdrbrgyin'				    =>	$object->clean_input($_POST["scdrbrgyin"]),
                    ':scdrbrgyinstat'				=>	$object->clean_input($_POST["scdrbrgyinstat"]),
                    // Scholarship Status Details 
                    ':scgrantstat'					=>	$object->clean_input($_POST["scgrantstat"]),
                    // Account Details
                    ':scaemail'			      		=>	$object->clean_input($_POST["scaemail"]),
                    ':scapass'				      	=>  $password_hash
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
            ':scschstat'		=>	$_POST['next_status']
        );

        $object->query = "
        UPDATE tbl_ched
        SET scschstat = :scschstat 
        WHERE sched_id = '".$_POST["id"]."'
        ";

        $object->execute($data);

        echo '<div class="alert alert-success">Class Status change to '.$_POST['next_status'].'</div>';
    }
// Approve All Query
    if($_POST["action"] == 'approve_all')
    {
        for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
        {
        $object->query = "
            UPDATE tbl_ched 
            SET scschstat = 'Approved'
            WHERE sched_id = '".$_POST["checkbox_value"][$count]."'";

            $object->execute();
        }
        echo '<div class="alert alert-success">Selected Applicant Data Approved</div>';
    }
// Reject All Query
    if($_POST["action"] == 'reject_all')
    {
        for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
        {
        $object->query = "
            UPDATE tbl_ched 
            SET scschstat = 'Rejected'
            WHERE sched_id = '".$_POST["checkbox_value"][$count]."'";

            $object->execute();
        }
        echo '<div class="alert alert-success">Selected Applicant Data Rejected</div>';
    }
// Delete All Query
    if($_POST["action"] == 'delete_all')
    {
        for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
        {
        $object->query = "
            DELETE FROM tbl_ched 
            WHERE sched_id = '".$_POST["checkbox_value"][$count]."'";

            $object->execute();
        }
        echo '<div class="alert alert-success">Selected Applicant Data Deleted</div>';
    }

// Delete Query
    if($_POST["action"] == 'delete')
    {
        $object->query = "
        DELETE FROM tbl_ched 
        WHERE sched_id = '".$_POST["id"]."'
        ";

        $object->execute();

        echo '<div class="alert alert-success">Applicant Data Deleted</div>';
    }
    }

    ?>