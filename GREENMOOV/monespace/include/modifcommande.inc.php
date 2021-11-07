<?php
include_once '../../dbh.inc.php';
// On modifie le statut d'une commande 
$id= $_GET['commandeid'];
$modif=$_GET['modif'];
$sql = "UPDATE orders SET statut_commande='$modif' WHERE commande_id = $id";
if($conn->query($sql)){
    $_SESSION[$key]=$element;
    header("location: ../gerercommandes.php");           
}
$conn->close();