<?php
if(isset($_POST['submit'])){
    $titre=$_POST['titre'];
    $content=$_POST['content'];
    $lieu=$_POST['lieu'];
    $datetime=$_POST['date'];
    $prix=$_POST['prix'];
    $time=$_POST['time'];
    $effectifmax=$_POST['nb'];   

    include_once "../../dbh.inc.php";
    // Simple requête SQL avec les informations inscrites dans le form 
    $sql = "INSERT INTO events(date_heure, durée, titre, contenu, lieu, max_participants, prix) VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $datetime, $time, $titre, $content, $lieu, $effectifmax, $prix);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("location: ../evenements.php");
}else{
    header("location: ../createevent.php");
}
