<?php
session_start();
include_once "../../dbh.inc.php";
if(isset($_POST['submit'])){
    $liste = array(
        "prenom" => $_POST['prenom'],
        "nom" => $_POST['nom'],
        "email" => $_POST['email'],
        "tel" => $_POST['tel'],
        "adresse" => $_POST['adresse'],
        "sexe" => $_POST['sexe'],
    );
    foreach($liste as $key => $element){
        if(!empty($element)){
            $id = $_SESSION["id"];
            $sql ="UPDATE users_table SET $key = '$element' WHERE id = $id";
            if($conn->query($sql)){
                $_SESSION[$key]=$element;
                header("location: ../monespace.php?error=none");           
            }
            $conn->close();
        }
    }
}else{
    echo 'marche pas';
}