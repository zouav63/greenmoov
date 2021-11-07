<?php
include_once "../../dbh.inc.php";
session_start();
if(isset($_GET['id'])){
    $event_id = $_GET['id'];
    $user_id = $_SESSION['id'];
    $sql = "DELETE FROM inscription_event WHERE user_id=$user_id AND event_id=$event_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("location: ../evenements.php?statut=desinscrit&id=$event_id");
}else{
    header("location: ../evenements.php");
}
