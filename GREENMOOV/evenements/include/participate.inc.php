<?php
    session_start();
    include_once "../../dbh.inc.php";
    function nbparticipant($conn, $id, $max){
        $res = true;
        $sql = "SELECT * FROM inscription_event WHERE event_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result(); 
        if($result->num_rows<$max){
            return $res;
        }else{
            $res = false;
            return $res;
        }
    }
    //Si l'event est full -> alors il ne peut pas pas participer (2eme vérifications) on ne veut pas prendre de risques ;)
    if(nbparticipant($conn, $_GET['id'], $_GET['max'])===true){
        $id = $_GET['id'];
        $max=$_GET['max'];
        $sql = "INSERT INTO inscription_event(user_id, event_id) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $_SESSION['id'], $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("location: ../evenements.php?statut=inscrit&id=$id");
    }else{
        header("location: ../evenements.php?error=full");
    }
