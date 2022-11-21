<?php
include_once('connect 2.php');
$slname = $_POST['slname'] ?? null;
if(!$slname){
    header('Location: newdash.php');
    exit;
}
$statement = $conn->prepare("UPDATE tbl_newstudent 
SET s_scholar_stat = 'Approved', s_scholarship_type = 'UNIFAST' 
WHERE slname =:slname");
$statement->bindValue(':slname', $slname);
$statement->execute();
header('Location: newdash.php');

?>