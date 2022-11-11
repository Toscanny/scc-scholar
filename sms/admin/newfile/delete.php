<?php
include_once('connect 2.php');
$lname = $_POST['slname'] ?? null;
if(!$lname){
    header('Location: newdash.php');
    exit;
}
$statement = $conn->prepare("DELETE FROM tbl_student WHERE slname =:slname");
$statement->bindValue(':slname', $slname);
$statement->execute();
header('Location: newdash.php');

?>