<?php
include_once "../../dbh.inc.php";
if(isset($_POST['submit'])){
    $titre=$_POST['titre'];
    $stitre=$_POST['stitre'];
    $a_titre=$_POST['a_titre'];
    $a_content=$_POST['a_content'];
    $a_link=$_POST['a_link'];
    $a_image=$_POST['a_image'];

    $sql = "INSERT INTO news(titre, sous_titre, a_link, a_titre, a_content, a_image, date) VALUES (?,?,?,?,?,?,now())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $titre, $stitre, $a_link, $a_titre, $a_content, $a_image);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("location: ../news.php");
}else{
    header("location: ../news.php");
}
