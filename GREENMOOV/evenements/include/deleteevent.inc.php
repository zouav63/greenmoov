<?php
include_once "../../dbh.inc.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    //on prend en paramêtre url l'id de l'event (préalablement envoyé dans getevent) pour savoir de quel event il faut supprimer
    $sql = 'DELETE FROM events WHERE id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("location: ../evenements.php");
}else{
    header("location: ../evenements.php");
}

