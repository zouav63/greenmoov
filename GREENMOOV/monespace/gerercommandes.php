<?php
include_once '../dbh.inc.php';
function getcommandes($conn){
    $sql = "SELECT orders.commande_id, users_table.prenom, users_table.nom, users_table.adresse, users_table.tel, users_table.statut_id, orders.commande_date, orders.payement, orders.panier, orders.donation, orders.commentaire, orders.statut_commande FROM users_table INNER JOIN orders ON orders.user_id=users_table.id ORDER BY orders.statut_commande";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) {
            // Check si livré ou non (changement d'affichage)
            if($row['statut_commande']=='Livré'){
                echo "<tr><td>".$row['commande_id']."</td><td>".$row['prenom']."</td><td>".$row['nom']."</td><td>".$row['adresse']."</td><td>".$row['tel']."</td><td>".$row['statut_id']."</td><td>".$row['commande_date']."</td><td>".$row['payement']."</td><td>".$row['panier']."</td><td>".$row['donation']."</td><td>".$row['commentaire']."</td><td>".$row['statut_commande']."</td><td><a href='./include/modifcommande.inc.php?commandeid={$row['commande_id']}&modif=En cours'><i class='fas fa-times fa-2x' style='color:red'></i></td></tr>";
            }else if($row['statut_commande']=='En cours'){
                echo "<tr><td>".$row['commande_id']."</td><td>".$row['prenom']."</td><td>".$row['nom']."</td><td>".$row['adresse']."</td><td>".$row['tel']."</td><td>".$row['statut_id']."</td><td>".$row['commande_date']."</td><td>".$row['payement']."</td><td>".$row['panier']."</td><td>".$row['donation']."</td><td>".$row['commentaire']."</td><td>".$row['statut_commande']."</td><td><a href='./include/modifcommande.inc.php?commandeid={$row['commande_id']}&modif=Livré'><i class='fas fa-check fa-2x' style='color:green'></i></td></tr>";
            }
        }
      }else{
        echo "0 results";
      }
      $conn->close();
}
?>
<!-- Chaque commande son énuméré dans un tableau intéractif pour que les membres puissent avoir accès aux statut des commandes en direct (plus simple pour la livraison) -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./monespace.css"/> 
    <title>Gérer les commandes</title>
</head>
<body>
    <?php include('../header/header.php')?>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Commande ID</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Tel</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Payement</th>
                <th>Panier</th>
                <th>Donation</th>
                <th>Commentaire</th>
                <th>Statut Commande</th>
                <th></th>
            </tr>
        </thead>    
        <tbody>
            <?php getcommandes($conn);?>
        </tbody>
    </table>
</body>
</html>

