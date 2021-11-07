<?php
include_once '../../dbh.inc.php';
if(isset($_POST['submit'])){
    $l=$_POST['l'];
    $q=$_POST['q'];
    $u=$_POST['u'];
    $panier=$_GET['panier'];
    $sql="DELETE FROM `panier` WHERE type=$panier";
    if($conn->query($sql)){
        foreach($l as $key=>$leg){
            $sql1="INSERT INTO `panier`(légumes, quantité, unité, type) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql1);
            $stmt->bind_param("ssss", $l[$key], $q[$key], $u[$key], $panier);
            $stmt->execute();
            $stmt->close();
        }
        header('location: ../commande'.$panier.'.php?liste=1');
        $conn->close();
    }
}else{
    header('location: ../commande'.$panier.'.php');
}