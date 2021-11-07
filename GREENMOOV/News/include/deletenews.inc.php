<?php
include_once "../../dbh.inc.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'DELETE FROM news WHERE id=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("location: ../news.php");
}else{
    header("location: ../news.php");
}

