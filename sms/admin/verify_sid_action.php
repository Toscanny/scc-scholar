<?php 

// register_action.php

include('../class/dbcon.php');

$object = new sms;

if(isset($_POST["action"]))
{
    if($_POST['action'] == 'sid_verify')
    {
      $error = '';
  
      $success = '';
  
      $data = array(
          ':ss_id'	=>	$_POST["ss_id"]
      );
  
      $object->query = "
      SELECT * FROM tbl_student
      WHERE ss_id = :ss_id
      ";
  
      $object->execute($data);
  
      if($object->row_count() == 0)
      {
          $error = '<div class="alert alert-danger">School ID Number Not Exists</div>';
      }
      else{
            $success = '<div class="alert alert-success">School ID Number Exists</div>';     
      }
    
  
      $output = array(
          'error'	=>	$error,
          'success'	=>	$success
      );
      echo json_encode($output);
    }
}

?>