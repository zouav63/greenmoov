
<?php 
session_start();



if(isset($_POST['submit'])){
    $user_id = $_SESSION['id'];
    $panier = $_GET['panier'];
    $payement=$_POST["payement"];
    $donation=$_POST["donation"];
    $alreadypay=$_POST["p"];
    $comment = $_POST["comment"];

    require_once '../../dbh.inc.php';
    $sql = "INSERT INTO orders (commande_date, livraison_date, panier, payement, donation, deja_paye, commentaire, statut_commande, user_id) VALUES (now(),null,?,?,?,?,?,'En cours',?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $panier, $payement, $donation, $alreadypay, $comment, $user_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("location: ../commande10.php?commande=1&panier={$panier}");

}else{
    header("location: ../Login.php?commande=0");
}