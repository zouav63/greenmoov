<?php

// partcipe et nbparticipant sont des simples requêtes SQL 
function participe($conn, $id){
    $sql = "SELECT * FROM inscription_event WHERE user_id=? AND event_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $_SESSION['id'], $id);
    $stmt->execute();
    $result = $stmt->get_result(); 
    return $result->num_rows;
}
function nbparticipant($conn, $id){
    $sql = "SELECT * FROM inscription_event WHERE event_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result(); 
    return $result->num_rows;
}
function getevent($conn){
    // Cette fonction est composé d'une requête SQL vers la table events dans le but d'afficher l'ensemble des données sélectionnées à l'aide en printant du HTML/CSS 
    // L'affichage chande en fonction du nombre de partcipant, du statut de l'utilisateur 
    $sql = "SELECT * FROM `events` ORDER BY date_heure";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) {
            $id=$row['id'];
            echo "<div class='eventE' id='$id' style='margin-top:80px'>"; 
            if($_SESSION['statut']===3){ // Si Admin
                echo "<a href='./include/deleteevent.inc.php?id=",$id,"' style='color:black;text-align:right;'><i class='fas fa-trash rightE'></i></a>";
            }
            echo "<div class='info'><h3 class='titleE' style='font-size:170%; padding:1rem 0;'>".$row['titre']."</h3><p style='padding:1rem; word-wrap:break-word;'>".$row['contenu']."</p><div class='moreinfoE'><p>Lieu : ".$row['lieu']."</p><p>Date : ".$row['date_heure']."</p><p>Prix : ".$row['prix']."</p></div></div><div class='ceE'>";
            // Si il est bien connecté
            if(isset($_SESSION['email']) && $_SESSION['statut']>1){
                // Si il participe déjà -> Se désinscrire 
                if(participe($conn, $id)>0){
                    echo "<a type='button' href='./include/retire.inc.php?id=",$id,"' class='buttonE titleE'> Se désinscrire ?</a>";
                // Si le nombre de participant à atteint le max -> Complet    
                }else if(nbparticipant($conn, $id)==$row['max_participants'] && participe($conn, $id)==0){
                    echo "<a type='button' class='buttonE titleE' style='background-color:#327e5537;'>Complet !</a>";
                //Sinon -> Tu veux participe ? 
                }else{
                    echo "<a type='button' id='participer' class='buttonE titleE' href='./include/participate.inc.php?id=",$id,"&max=",$row['max_participants'],"'> Tu veux partciper ?</a>";
                }
            }else{
                echo  '<p class="popE">Il faut devenir membre pour pouvoir participer</p>';
            }
            echo "</div><p>Nombre de participants : ".nbparticipant($conn, $id)." / ".$row['max_participants']."</p>";
            // Bouton d'inscription seulement si il est membre
            if(isset($_GET['statut'])){
                if($_GET['statut']=='inscrit' && $_GET['id']==$id){
                    echo "<p class='popE'>Tu es bien inscris à l'évent - ".$row['titre']." -</p>";
                }else if($_GET['statut']=='desinscrit' && $_GET['id']==$id){
                    echo "<p class='popE'>Tu es  désinscris à l'évent - ".$row['titre']." -</p>";
                }
            }
            echo "</div>";
        }
      }else{
        echo "<p style='padding: 2rem; text-align:center;'>Pas d'évènement en cours</p>";
      }
      $conn->close();
}
function getoneevent($conn){
    // Même principe que au dessus mais pour l'affichage de 1 event (on l'utilise dans la page principale) 
    $sql='SELECT * FROM events ORDER BY date_heure DESC LIMIT 1';
    $result = $conn->query($sql);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }else{
        $row = $result->fetch_assoc();
        $id=$row['id'];
        echo "<div class='eventE' id='$id' style='margin-top:80px'>"; 
        if($_SESSION['statut']===3){
            echo "<a href='../evenements/include/deleteevent.inc.php?id=",$id,"' style='color:black;text-align:right;'><i class='fas fa-trash rightE'></i></a>";
        }
        echo "<div class='info'><h3 class='titleE'>".$row['titre']."</h3><p style='padding:1rem; word-wrap:break-word;'>".$row['contenu']."</p><div class='moreinfoE'><p>Lieu : ".$row['lieu']."</p><p>Date : ".$row['date_heure']."</p><p>".$row['prix']." &#x20AC</p></div></div><div class='ceE'>";
        
        if(isset($_SESSION['email'])){
            if(participe($conn, $id)>0){
                echo "<a type='button' href='../evenements/include/retire.inc.php?id=",$id,"' class='buttonE titleE'> Se désinscrire ?</a>";
            }else if(nbparticipant($conn, $id)==$row['max_participants'] && participe($conn, $id)==0){
                echo "<a type='button' class='buttonE titleE' style='background-color:#327e5537;'>Complet !</a>";
            }else{
                echo "<a type='button' id='participer' class='buttonE titleE' href='../evenements/include/participate.inc.php?id=",$id,"&max=",$row['max_participants'],"'> Tu veux partciper ?</a>";
            }
        }else{
            echo  '<p class="popE">Il faut devenir membre pour pouvoir participer</p>';
        }
        echo "</div><p>Nombre de participants : ".nbparticipant($conn, $id)." / ".$row['max_participants']."</p>";
        if(isset($_GET['statut'])){
            if($_GET['statut']=='inscrit'){
                echo "<p class='popE'>Tu es bien inscris à l'évent - ".$row['titre']." -</p>";
            }else if($_GET['statut']=='desinscrit'){
                echo "<p class='popE'>Tu es  désinscris à l'évent - ".$row['titre']." -</p>";
            }
        }
        echo "</div>";
    }
    $conn->close();
}