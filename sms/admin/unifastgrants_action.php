<?php

    include('../class/dbcon.php');

    $object = new sms;


// Search and Table
    if(isset($_POST["action"]))
    {
        if($_POST["action"] == 'fetch')
        {
            $order_column = array('suslname', 'susfname', 'susmname', 'susgender', 'suscontact', 'susaddress', 'suspemail', 'susschstat', 'susdapply');
            /* Common Data
                +suslname, +susfname, +susmname, +suscontact, +susgender, +suspemail, +susschstat		
            */
            $output = array();
            
            $main_query = "
            SELECT * FROM tbl_unifast WHERE susschstat = 'Approved'
            ";

            $search_query = '';
            
            if(isset($_POST['search']['value']))
            {
                $search_query .= 'AND (suslname LIKE "%'.$_POST['search']['value'].'%" 
                OR susfname LIKE "%'.$_POST['search']['value'].'%" 
                OR susmname LIKE "%'.$_POST['search']['value'].'%" 
                OR susaddress LIKE "%'.$_POST['search']['value'].'%" 
                OR suscontact LIKE "%'.$_POST['search']['value'].'%"
                OR suspemail LIKE "%'.$_POST['search']['value'].'%")';
            }

            if(isset($_POST["order"]))
            {
                $order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
            }
            else
            {
                $order_query = 'ORDER BY sunifast_id ASC ';
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
                        $sub_array[] = $check = '<div style="text-align: center;"><input type="checkbox" class="checkbox" value="'.$row["sunifast_id"].'" /></div>';
                        $sub_array[] = $row["suslname"];
                        $sub_array[] = $row["susfname"];
                        $sub_array[] = $row["susmname"];
                        $sub_array[] = $row["susaddress"];
                        $sub_array[] = $row["suscontact"];
                        $sub_array[] = $row["susgender"];
                        $sub_array[] = $row["suspemail"];
                        $status = '';
                        if($row["susschstat"] == 'Pending')
                        {
                            $status = '<button type="button" name="status_button" class="btn btn-warning btn-sm status_button" data-id="'.$row["sunifast_id"].'" data-status="'.$row["susschstat"].'">Pending</button>';
                        }
                        else if($row["susschstat"] == 'Approved')
                        {
                            $status = '<button type="button" name="status_button" class="btn btn-success btn-sm status_button" data-id="'.$row["sunifast_id"].'" data-status="'.$row["susschstat"].'">Approved</button>';
                        }
                        else
                        {
                            $status = '<button type="button" name="status_button" class="btn btn-danger btn-sm status_button" data-id="'.$row["sunifast_id"].'" data-status="'.$row["susschstat"].'">Rejected</button>';
                        }
                        $sub_array[] = $status;
                        $sub_array[] = '
                        <div align="center">
                        <button type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" data-id="'.$row["sunifast_id"].'"><i class="fas fa-eye"></i></button>
                        <button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id="'.$row["sunifast_id"].'"><i class="fas fa-edit"></i></button>
                        <button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="'.$row["sunifast_id"].'"><i class="fas fa-times"></i></button>
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
            ':susaemail'	=>	$_POST["susaemail"]
        );

        $object->query = "
        SELECT * FROM tbl_unifast
        WHERE susaemail = :susaemail
        ";

        $object->execute($data);

        if($object->row_count() > 0)
        {
            $error = '<div class="alert alert-danger">Email Address Already Exists</div>';
        }
        else
        {
            $object->query = "
            INSERT INTO tbl_unifast
            (sustudent_id, suslname, susfname, susmname, susnext, susgender, susdbirth, suscontact, susaddress, susspattended, suscp, 
            susyl, suspemail, susflname, susffname, susfmname, susfnext, susmlname, susmfname, susmmname, susmnext, susdswd, sushci, 
            susdid, susdfilled, sudrpic, sudrpicstat, sudrpsa, sudrpsastat, sudrobr, sudrobrstat, sustype, susaemail, susapass, 
            susgrantstat, susschstat, susdapply) 
            VALUES (:sustudent_id, :suslname, :susfname, :susmname, :susnext, :susgender, :susdbirth, :suscontact, :susaddress, :susspattended, 
            :suscp, :susyl, :suspemail, :susflname, :susffname, :susfmname, :susfnext, :susmlname, :susmfname, :susmmname, :susmnext, :susdswd, 
            :sushci, :susdid, :susdfilled, :sudrpic, :sudrpicstat, :sudrpsa, :sudrpsastat, :sudrobr, :sudrobrstat, 'Unifast', :susaemail, :susapass, 
            :susgrantstat, 'Pending', '$object->now')";
            
            $password_hash = password_hash($_POST["susapass"], PASSWORD_DEFAULT);

            if($error == '')
            {
                $data = array(
                    // Personal Details
                    ':sustudent_id'					=>	$object->clean_input($_POST["sustudent_id"]),
                    ':suslname'					    =>	$object->clean_input($_POST["suslname"]),
                    ':susfname'					    =>	$object->clean_input($_POST["susfname"]),
                    ':susmname'					    =>	$object->clean_input($_POST["susmname"]),
                    ':susnext'					  	=>	$object->clean_input($_POST["susnext"]),
                    ':susgender'					=>	$object->clean_input($_POST["susgender"]),
                    ':susdbirth'					=>	$object->clean_input($_POST["susdbirth"]),
                    ':suscontact'					=>	$object->clean_input($_POST["suscontact"]),
                    ':susaddress'					=>	$object->clean_input($_POST["susaddress"]),
                    ':susspattended'				=>	$object->clean_input($_POST["susspattended"]),
                    ':suscp'					    =>	$object->clean_input($_POST["suscp"]),
                    ':susyl'				        =>	$object->clean_input($_POST["susyl"]),
                    ':suspemail'				    =>	$object->clean_input($_POST["suspemail"]),
                    // Family Details
                    // Father Details
                    ':susflname'					=>	$object->clean_input($_POST["susflname"]),
                    ':susffname'				    =>	$object->clean_input($_POST["susffname"]),
                    ':susfmname'					=>	$object->clean_input($_POST["susfmname"]),
                    ':susfnext'			        	=>	$object->clean_input($_POST["susfnext"]),
                    // Mother Details
                    ':susmlname'					=>	$object->clean_input($_POST["susmlname"]),
                    ':susmfname'				    =>	$object->clean_input($_POST["susmfname"]),
                    ':susmmname'				    =>	$object->clean_input($_POST["susmmname"]),
                    ':susmnext'			        	=>	$object->clean_input($_POST["susmnext"]),
                    // Other Details
                    ':susdswd'				        =>	$object->clean_input($_POST["susdswd"]),
                    ':sushci'					  	=>	$object->clean_input($_POST["sushci"]),
                    ':susdid'		  			    =>	$object->clean_input($_POST["susdid"]),
                    ':susdfilled'		  			=>	$object->clean_input($_POST["susdfilled"]),
                    // Requirements Details
                    ':sudrpic'				   		=>	$object->clean_input($_POST["sudrpic"]),
                    ':sudrpicstat'					=>	$object->clean_input($_POST["sudrpicstat"]),
                    ':sudrpsa'		  				=>	$object->clean_input($_POST["sudrpsa"]),
                    ':sudrpsastat'				    =>	$object->clean_input($_POST["sudrpsastat"]),
                    ':sudrobr'					    =>	$object->clean_input($_POST["sudrobr"]),
                    ':sudrobrstat'		  		    =>	$object->clean_input($_POST["sudrobrstat"]),
                    // Scholarship Status Details 
                    ':susgrantstat'					=>	$object->clean_input($_POST["susgrantstat"]),
                    // Account Details
                    ':susaemail'			      	=>	$object->clean_input($_POST["susaemail"]),
                    ':susapass'				      	=>  $password_hash
                );

                $object->execute($data);

                $success = '<div class="alert alert-success">Applicant Added</div>';
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
        SELECT * FROM tbl_unifast
        WHERE sunifast_id = '".$_POST["sunifast_id"]."'
        ";

        $result = $object->get_result();

        $data = array();

        foreach($result as $row)
        {
        // Account Details
            $data['susaemail'] = $row['susaemail'];
            $data['susapass'] = $row['susapass'];
        // Personal Details
            $data['sustudent_id'] = $row['sustudent_id'];
            $data['susfname'] = $row['susfname'];
            $data['susmname'] = $row['susmname'];
            $data['suslname'] = $row['suslname'];
            $data['susnext'] = $row['susnext'];
            $data['susgender'] = $row['susgender'];
            $data['susdbirth'] = $row['susdbirth'];
            $data['suscontact'] = $row['suscontact'];
            $data['susaddress'] = $row['susaddress'];
            $data['susspattended'] = $row['susspattended'];
            $data['suscp'] = $row['suscp'];
            $data['susyl'] = $row['susyl'];
            $data['suspemail'] = $row['suspemail'];
        // Family Details
            // Father Details
            $data['susffname'] = $row['susffname'];
            $data['susfmname'] = $row['susfmname'];
            $data['susflname'] = $row['susflname'];
            $data['susfnext'] = $row['susfnext'];
            // Mother Details
            $data['susmfname'] = $row['susmfname'];
            $data['susmmname'] = $row['susmmname'];
            $data['susmlname'] = $row['susmlname'];
            $data['susmnext'] = $row['susmnext'];
            // Other Details
            $data['susdswd'] = $row['susdswd'];
            $data['sushci'] = $row['sushci'];
            $data['susdid'] = $row['susdid'];
            $data['susdfilled'] = $row['susdfilled'];
        // Requirement Details
            $data['sudrpic'] = $row['sudrpic'];
            $data['sudrpicstat'] = $row['sudrpicstat'];
            $data['sudrpsa'] = $row['sudrpsa'];
            $data['sudrpsastat'] = $row['sudrpsastat'];
            $data['sudrobr'] = $row['sudrobr'];
            $data['sudrobrstat'] = $row['sudrobrstat'];
        // Scholar Type
            $data['sustype'] = $row['sustype'];
            $data['susgrantstat'] = $row['susgrantstat'];
            $data['susschstat'] = $row['susschstat'];
            $data['susdapply'] = $row['susdapply'];
        }

        echo json_encode($data);
    }

// Edit Query
    if($_POST["action"] == 'Edit')
    {
        $error = '';

        $success = '';

        $data = array(
            ':susaemail'	=>	$_POST["susaemail"],
            ':sunifast_id'	=>	$_POST['hidden_id']
        );

        $object->query = "
        SELECT * FROM tbl_unifast 
        WHERE susaemail = :susaemail 
        AND sunifast_id != :sunifast_id
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
                UPDATE tbl_unifast
                SET sustudent_id = :sustudent_id,
                susaemail = :susaemail,
                susapass = :susapass,
                susfname = :susfname,
                susmname = :susmname,
                suslname = :suslname,
                susnext = :susnext,
                susgender = :susgender,
                susdbirth = :susdbirth,
                suscontact = :suscontact,
                susaddress = :susaddress,
                susspattended = :susspattended,
                suscp = :suscp,
                susyl = :susyl,
                suspemail = :suspemail,
                susffname = :susffname, 
                susfmname = :susfmname,
                susflname = :susflname,
                susfnext = :susfnext,
                susmfname = :susmfname,
                susmmname = :susmmname,
                susmlname = :susmlname,
                susmnext = :susmnext,
                susdswd = :susdswd,
                sushci = :sushci,
                susdid = :susdid,
                susdfilled = :susdfilled,
                sudrpsa = :sudrpsa,
                sudrpsastat = :sudrpsastat,
                sudrpic = :sudrpic,
                sudrpicstat = :sudrpicstat,
                sudrobr = :sudrobr,
                sudrobrstat = :sudrobrstat,
                susgrantstat = :susgrantstat
                WHERE sunifast_id = '".$_POST['hidden_id']."'
                ";

                $password_hash = password_hash($_POST["susapass"], PASSWORD_DEFAULT);

                $data = array(
                    // Personal Details
                    ':sustudent_id'					=>	$object->clean_input($_POST["sustudent_id"]),
                    ':suslname'					    =>	$object->clean_input($_POST["suslname"]),
                    ':susfname'					    =>	$object->clean_input($_POST["susfname"]),
                    ':susmname'					    =>	$object->clean_input($_POST["susmname"]),
                    ':susnext'					  	=>	$object->clean_input($_POST["susnext"]),
                    ':susgender'					=>	$object->clean_input($_POST["susgender"]),
                    ':susdbirth'					=>	$object->clean_input($_POST["susdbirth"]),
                    ':suscontact'					=>	$object->clean_input($_POST["suscontact"]),
                    ':susaddress'					=>	$object->clean_input($_POST["susaddress"]),
                    ':susspattended'				=>	$object->clean_input($_POST["susspattended"]),
                    ':suscp'					    =>	$object->clean_input($_POST["suscp"]),
                    ':susyl'				        =>	$object->clean_input($_POST["susyl"]),
                    ':suspemail'				    =>	$object->clean_input($_POST["suspemail"]),
                    // Family Details
                    // Father Details
                    ':susflname'					=>	$object->clean_input($_POST["susflname"]),
                    ':susffname'				    =>	$object->clean_input($_POST["susffname"]),
                    ':susfmname'					=>	$object->clean_input($_POST["susfmname"]),
                    ':susfnext'			        	=>	$object->clean_input($_POST["susfnext"]),
                    // Mother Details
                    ':susmlname'					=>	$object->clean_input($_POST["susmlname"]),
                    ':susmfname'				    =>	$object->clean_input($_POST["susmfname"]),
                    ':susmmname'				    =>	$object->clean_input($_POST["susmmname"]),
                    ':susmnext'			        	=>	$object->clean_input($_POST["susmnext"]),
                    // Other Details
                    ':susdswd'				        =>	$object->clean_input($_POST["susdswd"]),
                    ':sushci'					  	=>	$object->clean_input($_POST["sushci"]),
                    ':susdid'		  			    =>	$object->clean_input($_POST["susdid"]),
                    ':susdfilled'		  			=>	$object->clean_input($_POST["susdfilled"]),
                    // Requirements Details
                    ':sudrpic'				   		=>	$object->clean_input($_POST["sudrpic"]),
                    ':sudrpicstat'					=>	$object->clean_input($_POST["sudrpicstat"]),
                    ':sudrpsa'		  				=>	$object->clean_input($_POST["sudrpsa"]),
                    ':sudrpsastat'				    =>	$object->clean_input($_POST["sudrpsastat"]),
                    ':sudrobr'					    =>	$object->clean_input($_POST["sudrobr"]),
                    ':sudrobrstat'		  		    =>	$object->clean_input($_POST["sudrobrstat"]),
                    // Scholarship Status Details 
                    ':susgrantstat'					=>	$object->clean_input($_POST["susgrantstat"]),
                    // Account Details
                    ':susaemail'			      	=>	$object->clean_input($_POST["susaemail"]),
                    ':susapass'				      	=>  $password_hash
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
            ':susschstat'		=>	$_POST['next_status']
        );

        $object->query = "
        UPDATE tbl_unifast
        SET susschstat = :susschstat 
        WHERE sunifast_id = '".$_POST["id"]."'
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
            UPDATE tbl_unifast 
            SET susschstat = 'Approved'
            WHERE sunifast_id = '".$_POST["checkbox_value"][$count]."'";

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
            UPDATE tbl_unifast 
            SET susschstat = 'Rejected'
            WHERE sunifast_id = '".$_POST["checkbox_value"][$count]."'";

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
            DELETE FROM tbl_unifast 
            WHERE sunifast_id = '".$_POST["checkbox_value"][$count]."'";

            $object->execute();
        }
        echo '<div class="alert alert-success">Selected Applicant Data Deleted</div>';
    }

// Delete Query
    if($_POST["action"] == 'delete')
    {
        $object->query = "
        DELETE FROM tbl_unifast 
        WHERE sunifast_id = '".$_POST["id"]."'
        ";

        $object->execute();

        echo '<div class="alert alert-success">Applicant Data Deleted</div>';
    }
    }

    ?>