<?php
include_once('connect 2.php');
$slname = $_POST['slname'] ?? null;
if(!$slname){
    header('Location: newdash.php');
    exit;
}
$statement = $conn->prepare("DELETE FROM tbl_newstudent WHERE slname =:slname");
$statement->bindValue(':slname', $slname);
$statement->execute();
header('Location: newdash.php');

?>