<?php

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once '../../dbh.inc.php';
    require_once 'functions.php';

    // On check si un input est vide
    if(emptyInputLogin($email, $password) === true){
        header("location: ../login.php?error=empty");
    }else{
        //Sinon on le login 
        loginUser($conn, $email, $password);
    }
}else{
    header("location: ../login.php");
}

