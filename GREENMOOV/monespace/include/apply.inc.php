<?php
    include_once "../../dbh.inc.php";
    session_start();
    if(isset($_POST['submit'])){
        // Un admin peut changer le statut de n'importe quels utilisateurs
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $statut = $_POST['selection'];
        //On vérifie que l'utilisateur existe bien 
        $sql1 = "SELECT prenom, nom FROM users_table WHERE prenom = '$prenom' AND nom='$nom'";
        $result=$conn->query($sql1);
        $row = $result->num_rows;
        if($row==0){
            header("location: ../monespace.php?error=nouser");           
        }else{
            //Puis on update la table avec le nouveau statut
            $sql = "UPDATE users_table SET statut_id=$statut WHERE prenom = '$prenom' AND nom = '$nom'";
            if($conn->query($sql)){
                header("location: ../monespace.php?error=none");           
            }
            $conn->close();
        }
    }else{
        echo "Doesn't work";
    }