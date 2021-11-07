<?php

function emptyInputRegister($prenom, $nom, $email, $password, $cpassword){
    $result; 
    // On utilise simplement la fonction empty de php pour savoir si c'est le string est 'vide'
    if(empty($prenom) || empty($nom) || empty($email) || empty($password) || empty($cpassword)){
        $result=true;
    }else{
        $result=false; 
    }
    return $result;
}

function emptyInputLogin($email, $password){
    $result; 
    // Pareil pour le login
    if(empty($email) || empty($password)){
        $result=true;
    }else{
        $result=false; 
    }
    return $result;
}

function invalidUsername($username){
    $result;
    // On veut savoir si le nom/prénom présente des chiffres, si oui alors invalide 
    if(!preg_match('#[0-9]#', $username)){
        $result=false;
    }else{
        $result=true;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    // utilisation de fonction php pour savoir si le mail est valide
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result=false;
    }else{
        $result=true;
    }
    return $result;
}
function idExist($conn, $email){
    // Simple requête sql pour savoir si l'utilisateur existe déjà
    $sql = "SELECT * FROM users_table WHERE email = ?";
    $stmt = $conn->prepare($sql); //statment
    if(!$conn->prepare($sql)){
        header("location: ../Login.php?error=stmtfailed");
        exit();  
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $resultdata = $stmt->get_result();
    if($row = $resultdata->fetch_assoc()){
        return $row;
    }else{
        $result = false;
        return $result;
    }
    $stmt->close();
}

// On créer l'utilisateur en l'insérant dans la base de donnée 
function createUser($conn, $prenom, $nom, $email, $tel, $password){
    $statut_id = 1;
    $sql = "INSERT INTO users_table (prenom, nom, email, tel, password, statut_id, date) VALUES (?,?,?,?,?,?,now())";
    $stmt = $conn->prepare($sql);
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("ssssss", $prenom, $nom, $email, $tel, $hashedpassword, $statut_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("location: ../login.php");
}

function loginUser($conn, $email, $password){
    $user = idExist($conn, $email, $password); 
    // On récupére l'utilisateur (si il existe)
    if($user === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    // On récupére le password crypté 
    $Hpassword = $user["password"];
    // Puis on check à l'aide de password_verify si les deux correspondent (celui dans la bd et celui entré)
    if(password_verify($password, $Hpassword) === false){
        header("location: ../login.php?error=wrongpassword");
        exit();
    }else if (password_verify($password, $Hpassword) === true){
        session_start();
        // On met en place la session avec toutes les informations sur l'utilisateur dont on aura potentiellement besoin durant sa visite sur le site 
        $_SESSION["email"] = $user["email"];
        $_SESSION["prenom"] = $user["prenom"];
        $_SESSION["nom"] = $user["nom"];
        $_SESSION["statut"] = $user["statut_id"];
        $_SESSION["tel"] = $user["tel"];
        $_SESSION["id"] = $user["id"];
        $_SESSION["sexe"] = $user["sexe"];
        $_SESSION["adresse"] = $user["adresse"];
        header("location: ../../main/newmain.php");
        exit();
    }
}