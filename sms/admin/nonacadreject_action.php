<?php

include('../class/dbcon.php');

$object = new sms;


// Search and Table
if(isset($_POST["action"]))
{
    if($_POST["action"] == 'fetch')
    {
        $order_column = array('snlname', 'snfname', 'snmname', 'snaddress', 'snpemail', 'sncontact', 'sngender', 'snascholarstat', 'snadapply');
        /* Common Data
            +snlname, +snfname, +snmname, +sncontact, +sngender, +snpemail, +snascholarstat		
        */
        $output = array();
        
        $main_query = "
        SELECT * FROM tbl_nonacad WHERE snascholarstat = 'Rejected'
        ";

        $search_query = '';
        
        if(isset($_POST['search']['value']))
        {
            $search_query .= 'AND (snlname LIKE "%'.$_POST['search']['value'].'%" 
            OR snfname LIKE "%'.$_POST['search']['value'].'%" 
            OR snmname LIKE "%'.$_POST['search']['value'].'%" 
            OR snaddress LIKE "%'.$_POST['search']['value'].'%" 
            OR sncontact LIKE "%'.$_POST['search']['value'].'%"
            OR snpemail LIKE "%'.$_POST['search']['value'].'%")';
        }

        if(isset($_POST["order"]))
        {
            $order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
        }
        else
        {
            $order_query = 'ORDER BY snacad_id ASC ';
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
                    $sub_array[] = $check = '<div style="text-align: center;"><input type="checkbox" class="checkbox" value="'.$row["snacad_id"].'" /></div>';
                    $sub_array[] = $row["snlname"];
                    $sub_array[] = $row["snfname"];
                    $sub_array[] = $row["snmname"];
                    $sub_array[] = $row["snaddress"];
                    $sub_array[] = $row["sncontact"];
                    $sub_array[] = $row["sngender"];
                    $sub_array[] = $row["snpemail"];
                    $status = '';
                    if($row["snascholarstat"] == 'Pending')
                    {
                        $status = '<button type="button" name="status_button" class="btn btn-warning btn-sm status_button" data-id="'.$row["snacad_id"].'" data-status="'.$row["snascholarstat"].'">Pending</button>';
                    }
                    else if($row["snascholarstat"] == 'Approved')
                    {
                        $status = '<button type="button" name="status_button" class="btn btn-success btn-sm status_button" data-id="'.$row["snacad_id"].'" data-status="'.$row["snascholarstat"].'">Approved</button>';
                    }
                    else
                    {
                        $status = '<button type="button" name="status_button" class="btn btn-danger btn-sm status_button" data-id="'.$row["snacad_id"].'" data-status="'.$row["snascholarstat"].'">Rejected</button>';
                    }
                    $sub_array[] = $status;
                    $sub_array[] = '
                    <div align="center">
                    <button type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" data-id="'.$row["snacad_id"].'"><i class="fas fa-eye"></i></button>
                    <button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id="'.$row["snacad_id"].'"><i class="fas fa-edit"></i></button>
                    <button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="'.$row["snacad_id"].'"><i class="fas fa-times"></i></button>
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
        ':snaemail'	=>	$_POST["snaemail"]
    );

    $object->query = "
    SELECT * FROM tbl_nonacad
    WHERE snaemail = :snaemail
    ";

    $object->execute($data);

    if($object->row_count() > 0)
    {
        $error = '<div class="alert alert-danger">Email Address Already Exists</div>';
    }
    else
    {
        $object->query = "
        INSERT INTO tbl_nonacad
        (snfname, snmname, snlname, snnext, sndbirth, snctship, snaddress, snpemail, sncontact, sngender, sncourse, snyrlvl,
        sngfname, sngmname, snglname, sngnext, sngaddress, sngcontact, sngoccu, sngcompany, snffname, snfmname, snflname, snfnext, 
        snfaddress, snfcontact, snfoccu, snfcompany, snmfname, snmmname, snmlname, snmnext, snmaddress, snmcontact, snmoccu, 
        snmcompany, snspcyincome, snrappnas, snbos, snsskills, sntwinterest, snpschatt, snpschadd, snpyrlvl, snasprc, snasprcstat, 
        snapgm, snapgmstat, sntbytpic, sntbytpicstat, snpbrgyin, snpbrgyinstat, snpscef, snpscefstat, snacapstype, snaemail, 
        snapass, sngrantstat, snascholarstat, snadapply) 
        VALUES (:snfname, :snmname, :snlname, :snnext, :sndbirth, :snctship, :snaddress, :snpemail, :sncontact, :sngender, :sncourse, :snyrlvl,  
        :sngfname, :sngmname, :snglname, :sngnext, :sngaddress, :sngcontact, :sngoccu, :sngcompany, :snffname, :snfmname, 
        :snflname, :snfnext, :snfaddress, :snfcontact, :snfoccu, :snfcompany, :snmfname, :snmmname, :snmlname, :snmnext, :snmaddress, :snmcontact, 
        :snmoccu, :snmcompany, :snspcyincome, :snrappnas, :snbos, :snsskills, :sntwinterest, :snpschatt, :snpschadd, :snpyrlvl, 
        :snasprc, :snasprcstat, :snapgm, :snapgmstat, :sntbytpic, :sntbytpicstat, :snpbrgyin, :snpbrgyinstat, 
        :snpscef, :snpscefstat, 'Non-Academic', :snaemail, :snapass, :sngrantstat, 'Pending', '$object->now')";
        
        $password_hash = password_hash($_POST["snapass"], PASSWORD_DEFAULT);

        if($error == '')
        {
            $data = array(
                // Personal Details
                ':snfname'					    =>	$object->clean_input($_POST["snfname"]),
                ':snmname'					    =>	$object->clean_input($_POST["snmname"]),
                ':snlname'					    =>	$object->clean_input($_POST["snlname"]),
                ':snnext'					  	=>	$object->clean_input($_POST["snnext"]),
                ':sndbirth'					  	=>	$object->clean_input($_POST["sndbirth"]),
                ':snctship'				    	=>	$object->clean_input($_POST["snctship"]),
                ':snaddress'					=>	$object->clean_input($_POST["snaddress"]),
                ':snpemail'					    =>	$object->clean_input($_POST["snpemail"]),
                ':sncontact'					=>	$object->clean_input($_POST["sncontact"]),
                ':sngender'					  	=>	$object->clean_input($_POST["sngender"]),
                ':sncourse'						=>	$object->clean_input($_POST["sncourse"]),
                ':snyrlvl'						=>	$object->clean_input($_POST["snyrlvl"]),
                // Family Details
                // Guardian Details
                ':sngfname'				      	=>	$object->clean_input($_POST["sngfname"]),
                ':sngmname'				      	=>	$object->clean_input($_POST["sngmname"]),
                ':snglname'			        	=>	$object->clean_input($_POST["snglname"]),
                ':sngnext'			        	=>	$object->clean_input($_POST["sngnext"]),
                ':sngaddress'					=>	$object->clean_input($_POST["sngaddress"]),
                ':sngcontact'					=>	$object->clean_input($_POST["sngcontact"]),
                ':sngoccu'					    =>	$object->clean_input($_POST["sngoccu"]),
                ':sngcompany'					=>	$object->clean_input($_POST["sngcompany"]),
                // Father Details
                ':snffname'				      	=>	$object->clean_input($_POST["snffname"]),
                ':snfmname'					    =>	$object->clean_input($_POST["snfmname"]),
                ':snflname'					    =>	$object->clean_input($_POST["snflname"]),
                ':snfnext'			        	=>	$object->clean_input($_POST["snfnext"]),
                ':snfaddress'					=>	$object->clean_input($_POST["snfaddress"]),
                ':snfcontact'					=>	$object->clean_input($_POST["snfcontact"]),
                ':snfoccu'				      	=>	$object->clean_input($_POST["snfoccu"]),
                ':snfcompany'				   	=>	$object->clean_input($_POST["snfcompany"]),
                // Mother Details
                ':snmfname'				      	=>	$object->clean_input($_POST["snmfname"]),
                ':snmmname'					    =>	$object->clean_input($_POST["snmmname"]),
                ':snmlname'					    =>	$object->clean_input($_POST["snmlname"]),
                ':snmnext'			        	=>	$object->clean_input($_POST["snmnext"]),
                ':snmaddress'					=>	$object->clean_input($_POST["snmaddress"]),
                ':snmcontact'					=>	$object->clean_input($_POST["snmcontact"]),
                ':snmoccu'				      	=>	$object->clean_input($_POST["snmoccu"]),
                ':snmcompany'				    =>	$object->clean_input($_POST["snmcompany"]),
                ':snspcyincome'				  	=>	$object->clean_input($_POST["snspcyincome"]),
                // Application Details
                ':snrappnas'				    =>	$object->clean_input($_POST["snrappnas"]),
                ':snbos'					  	=>	$object->clean_input($_POST["snbos"]),
                ':snsskills'		  			=>	$object->clean_input($_POST["snsskills"]),
                ':sntwinterest'		  			=>	$object->clean_input($_POST["sntwinterest"]),
                // Education Details
                ':snpschatt'				    =>	$object->clean_input($_POST["snpschatt"]),
                ':snpschadd'					=>	$object->clean_input($_POST["snpschadd"]),
                ':snpyrlvl'		  				=>	$object->clean_input($_POST["snpyrlvl"]),
                // Requirements Details
                ':snasprc'				   		=>	$object->clean_input($_POST["snasprc"]),
                ':snasprcstat'					=>	$object->clean_input($_POST["snasprcstat"]),
                ':snapgm'		  				=>	$object->clean_input($_POST["snapgm"]),
                ':snapgmstat'				    =>	$object->clean_input($_POST["snapgmstat"]),
                ':sntbytpic'					=>	$object->clean_input($_POST["sntbytpic"]),
                ':sntbytpicstat'		  		=>	$object->clean_input($_POST["sntbytpicstat"]),
                ':snpbrgyin'				    =>	$object->clean_input($_POST["snpbrgyin"]),
                ':snpbrgyinstat'				=>	$object->clean_input($_POST["snpbrgyinstat"]),
                ':snpscef'		  				=>	$object->clean_input($_POST["snpscef"]),
                ':snpscefstat'		  			=>	$object->clean_input($_POST["snpscefstat"]),
                // Scholarship Status Details 
                ':sngrantstat'					=>	$object->clean_input($_POST["sngrantstat"]),
                // Account Details
                ':snaemail'			      		=>	$object->clean_input($_POST["snaemail"]),
                ':snapass'				      	=>  $password_hash
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
    SELECT * FROM tbl_nonacad 
    WHERE snacad_id = '".$_POST["snacad_id"]."'
    ";

    $result = $object->get_result();

    $data = array();

    foreach($result as $row)
    {
        // Account Details
        $data['snaemail'] = $row['snaemail'];
        $data['snapass'] = $row['snapass'];
        // Personal Details
        $data['snfname'] = $row['snfname'];
        $data['snmname'] = $row['snmname'];
        $data['snlname'] = $row['snlname'];
        $data['snnext'] = $row['snnext'];
        $data['sndbirth'] = $row['sndbirth'];
        $data['snctship'] = $row['snctship'];
        $data['snaddress'] = $row['snaddress'];
        $data['snpemail'] = $row['snpemail'];
        $data['sncontact'] = $row['sncontact'];
        $data['sncourse'] = $row['sncourse'];
        $data['snyrlvl'] = $row['snyrlvl'];
        $data['sngender'] = $row['sngender'];
        // Family Details
        // Guardian Details
        $data['sngfname'] = $row['sngfname'];
        $data['sngmname'] = $row['sngmname'];
        $data['snglname'] = $row['snglname'];
        $data['sngnext'] = $row['sngnext'];
        $data['sngaddress'] = $row['sngaddress'];
        $data['sngcontact'] = $row['sngcontact'];
        $data['sngoccu'] = $row['sngoccu'];
        $data['sngcompany'] = $row['sngcompany'];
        // Father Details
        $data['snffname'] = $row['snffname'];
        $data['snfmname'] = $row['snfmname'];
        $data['snflname'] = $row['snflname'];
        $data['snfnext'] = $row['snfnext'];
        $data['snfaddress'] = $row['snfaddress'];
        $data['snfcontact'] = $row['snfcontact'];
        $data['snfoccu'] = $row['snfoccu'];
        $data['snfcompany'] = $row['snfcompany'];
        // Mother Details
        $data['snmfname'] = $row['snmfname'];
        $data['snmmname'] = $row['snmmname'];
        $data['snmlname'] = $row['snmlname'];
        $data['snmnext'] = $row['snmnext'];
        $data['snmaddress'] = $row['snmaddress'];
        $data['snmcontact'] = $row['snmcontact'];
        $data['snmoccu'] = $row['snmoccu'];
        $data['snmcompany'] = $row['snmcompany'];
        $data['snspcyincome'] = $row['snspcyincome'];
        // Application Details
        $data['snrappnas'] = $row['snrappnas'];
        $data['snbos'] = $row['snbos'];
        $data['snsskills'] = $row['snsskills'];
        $data['sntwinterest'] = $row['sntwinterest'];
        // Education Details
        $data['snpschatt'] = $row['snpschatt'];
        $data['snpschadd'] = $row['snpschadd'];
        $data['snpyrlvl'] = $row['snpyrlvl']; 
        // Requirement Details
        $data['snasprc'] = $row['snasprc'];
        $data['snasprcstat'] = $row['snasprcstat'];
        $data['snapgm'] = $row['snapgm'];
        $data['snapgmstat'] = $row['snapgmstat'];
        $data['sntbytpic'] = $row['sntbytpic'];
        $data['sntbytpicstat'] = $row['sntbytpicstat'];
        $data['snpbrgyin'] = $row['snpbrgyin'];
        $data['snpbrgyinstat'] = $row['snpbrgyinstat'];
        $data['snpscef'] = $row['snpscef'];
        $data['snpscefstat'] = $row['snpscefstat'];
        // Scholar Type
        $data['snacapstype'] = $row['snacapstype'];
        $data['sngrantstat'] = $row['sngrantstat'];
        $data['snascholarstat'] = $row['snascholarstat'];
        $data['snadapply'] = $row['snadapply'];
    }

    echo json_encode($data);
}

// Edit Query
if($_POST["action"] == 'Edit')
{
    $error = '';

    $success = '';

    $data = array(
        ':snaemail'		=>	$_POST["snaemail"],
        ':snacad_id'	=>	$_POST['hidden_id']
    );

    $object->query = "
    SELECT * FROM tbl_nonacad 
    WHERE snaemail = :snaemail 
    AND snacad_id != :snacad_id
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
            UPDATE tbl_nonacad
            SET snaemail = :snaemail,
            snapass = :snapass,
            snfname = :snfname,
            snmname = :snmname,
            snlname = :snlname,
            snnext = :snnext,
            sndbirth = :sndbirth,
            snctship = :snctship,
            snaddress = :snaddress,
            snpemail = :snpemail,
            sncontact = :sncontact,
            sncourse = :sncourse,
            snyrlvl = :snyrlvl,
            sngender = :sngender,
            sngfname = :sngfname, 
            sngmname = :sngmname,
            snglname = :snglname,
            sngnext = :sngnext,
            sngaddress = :sngaddress,
            sngcontact = :sngcontact,
            sngoccu = :sngoccu,
            sngcompany = :sngcompany,
            snffname = :snffname,
            snfmname = :snfmname,
            snflname = :snflname,
            snfnext = :snfnext,
            snfaddress = :snfaddress,
            snfcontact = :snfcontact,
            snfoccu = :snfoccu,
            snfcompany = :snfcompany,
            snmfname = :snmfname,
            snmmname = :snmmname,
            snmlname = :snmlname,
            snmnext = :snmnext,
            snmaddress = :snmaddress,
            snmcontact = :snmcontact,
            snmoccu = :snmoccu,
            snmcompany = :snmcompany,
            snspcyincome = :snspcyincome,
            snrappnas = :snrappnas,
            snbos = :snbos,
            snsskills = :snsskills,
            sntwinterest = :sntwinterest,
            snpschatt = :snpschatt,
            snpschadd = :snpschadd,
            snpyrlvl = :snpyrlvl,
            snasprc = :snasprc,
            snasprcstat = :snasprcstat,
            snapgm = :snapgm,
            snapgmstat = :snapgmstat,
            sntbytpic = :sntbytpic,
            sntbytpicstat = :sntbytpicstat,
            snpbrgyin = :snpbrgyin,
            snpbrgyinstat = :snpbrgyinstat,
            snpscef = :snpscef,
            snpscefstat = :snpscefstat,
            sngrantstat = :sngrantstat
            WHERE snacad_id = '".$_POST['hidden_id']."'
            ";

            $password_hash = password_hash($_POST["snapass"], PASSWORD_DEFAULT);

            $data = array(
                // Personal Details
                ':snfname'					    =>	$object->clean_input($_POST["snfname"]),
                ':snmname'					    =>	$object->clean_input($_POST["snmname"]),
                ':snlname'					    =>	$object->clean_input($_POST["snlname"]),
                ':snnext'					  	=>	$object->clean_input($_POST["snnext"]),
                ':sndbirth'					  	=>	$object->clean_input($_POST["sndbirth"]),
                ':snctship'				    	=>	$object->clean_input($_POST["snctship"]),
                ':snaddress'					=>	$object->clean_input($_POST["snaddress"]),
                ':snpemail'					    =>	$object->clean_input($_POST["snpemail"]),
                ':sncontact'					=>	$object->clean_input($_POST["sncontact"]),
                ':sngender'					  	=>	$object->clean_input($_POST["sngender"]),
                ':sncourse'						=>	$object->clean_input($_POST["sncourse"]),
                ':snyrlvl'						=>	$object->clean_input($_POST["snyrlvl"]),
                // Family Details
                // Guardian Details
                ':sngfname'				      	=>	$object->clean_input($_POST["sngfname"]),
                ':sngmname'				      	=>	$object->clean_input($_POST["sngmname"]),
                ':snglname'			        	=>	$object->clean_input($_POST["snglname"]),
                ':sngnext'			        	=>	$object->clean_input($_POST["sngnext"]),
                ':sngaddress'					=>	$object->clean_input($_POST["sngaddress"]),
                ':sngcontact'					=>	$object->clean_input($_POST["sngcontact"]),
                ':sngoccu'					    =>	$object->clean_input($_POST["sngoccu"]),
                ':sngcompany'					=>	$object->clean_input($_POST["sngcompany"]),
                // Father Details
                ':snffname'				      	=>	$object->clean_input($_POST["snffname"]),
                ':snfmname'					    =>	$object->clean_input($_POST["snfmname"]),
                ':snflname'					    =>	$object->clean_input($_POST["snflname"]),
                ':snfnext'			        	=>	$object->clean_input($_POST["snfnext"]),
                ':snfaddress'					=>	$object->clean_input($_POST["snfaddress"]),
                ':snfcontact'					=>	$object->clean_input($_POST["snfcontact"]),
                ':snfoccu'				      	=>	$object->clean_input($_POST["snfoccu"]),
                ':snfcompany'				   	=>	$object->clean_input($_POST["snfcompany"]),
                // Mother Details
                ':snmfname'				      	=>	$object->clean_input($_POST["snmfname"]),
                ':snmmname'					    =>	$object->clean_input($_POST["snmmname"]),
                ':snmlname'					    =>	$object->clean_input($_POST["snmlname"]),
                ':snmnext'			        	=>	$object->clean_input($_POST["snmnext"]),
                ':snmaddress'					=>	$object->clean_input($_POST["snmaddress"]),
                ':snmcontact'					=>	$object->clean_input($_POST["snmcontact"]),
                ':snmoccu'				      	=>	$object->clean_input($_POST["snmoccu"]),
                ':snmcompany'				    =>	$object->clean_input($_POST["snmcompany"]),
                ':snspcyincome'				  	=>	$object->clean_input($_POST["snspcyincome"]),
                // Application Details
                ':snrappnas'				    =>	$object->clean_input($_POST["snrappnas"]),
                ':snbos'					  	=>	$object->clean_input($_POST["snbos"]),
                ':snsskills'		  			=>	$object->clean_input($_POST["snsskills"]),
                ':sntwinterest'		  			=>	$object->clean_input($_POST["sntwinterest"]),
                // Education Details
                ':snpschatt'				    =>	$object->clean_input($_POST["snpschatt"]),
                ':snpschadd'					=>	$object->clean_input($_POST["snpschadd"]),
                ':snpyrlvl'		  				=>	$object->clean_input($_POST["snpyrlvl"]),
                // Requirements Details
                ':snasprc'				   		=>	$object->clean_input($_POST["snasprc"]),
                ':snasprcstat'					=>	$object->clean_input($_POST["snasprcstat"]),
                ':snapgm'		  				=>	$object->clean_input($_POST["snapgm"]),
                ':snapgmstat'				    =>	$object->clean_input($_POST["snapgmstat"]),
                ':sntbytpic'					=>	$object->clean_input($_POST["sntbytpic"]),
                ':sntbytpicstat'		  		=>	$object->clean_input($_POST["sntbytpicstat"]),
                ':snpbrgyin'				    =>	$object->clean_input($_POST["snpbrgyin"]),
                ':snpbrgyinstat'				=>	$object->clean_input($_POST["snpbrgyinstat"]),
                ':snpscef'		  				=>	$object->clean_input($_POST["snpscef"]),
                ':snpscefstat'		  			=>	$object->clean_input($_POST["snpscefstat"]),
                // Scholarship Status Details 
                ':sngrantstat'					=>	$object->clean_input($_POST["sngrantstat"]),
                // Account Details
                ':snaemail'			      		=>	$object->clean_input($_POST["snaemail"]),
                ':snapass'				      	=>  $password_hash
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
        ':snascholarstat'		=>	$_POST['next_status']
    );

    $object->query = "
    UPDATE tbl_nonacad
    SET snascholarstat = :snascholarstat 
    WHERE snacad_id = '".$_POST["id"]."'
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
        UPDATE tbl_nonacad 
        SET snascholarstat = 'Approved'
        WHERE snacad_id = '".$_POST["checkbox_value"][$count]."'";

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
        UPDATE tbl_nonacad 
        SET snascholarstat = 'Rejected'
        WHERE snacad_id = '".$_POST["checkbox_value"][$count]."'";

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
        DELETE FROM tbl_nonacad 
        WHERE snacad_id = '".$_POST["checkbox_value"][$count]."'";

        $object->execute();
    }
    echo '<div class="alert alert-success">Selected Applicant Data Deleted</div>';
}

// Delete Query
if($_POST["action"] == 'delete')
{
    $object->query = "
    DELETE FROM tbl_nonacad 
    WHERE snacad_id = '".$_POST["id"]."'
    ";

    $object->execute();

    echo '<div class="alert alert-success">Non-Academic Applicant Data Deleted</div>';
}
}

?>