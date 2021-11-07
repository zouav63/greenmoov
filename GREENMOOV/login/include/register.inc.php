<?php
if(isset($_POST['submit'])){
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $tel = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['Cpassword'];

    require_once '../../dbh.inc.php';
    require_once 'functions.php';

    // On check si l'inscription est valide
    // Si il y a un input vide -> redirection 
    if(emptyInputRegister($prenom, $nom, $email, $password, $cpassword)==true){
        header("location: ../Login.php?error=empty");
        exit();
    }
    // On check la validité du prenom/nom
    if(invalidUsername($prenom)==true || invalidUsername($nom)==true){
        header("location: ../Login.php?error=invalidname");
        exit();
    }
    // Check de l'email
    if(invalidEmail($email)==true){
        header("location: ../Login.php?error=invalidemail");
        exit();
    }  
    // Check si password = confirm password 
    if($password!==$cpassword){
        header("location: ../Login.php?error=invalidpassword");
        exit();
    }
    // Si l'utilisateur est valide, on le créé 
    createUser($conn, $prenom, $nom, $email, $tel, $password);
}else{
    header("location: ../Login.php");
}