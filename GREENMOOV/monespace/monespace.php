
<?php 
    session_start();
    require_once '../dbh.inc.php';
     
    function getusercommandes($conn, $id){
        $sql = "SELECT * FROM `orders` WHERE user_id=$id ORDER BY commande_date DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
            if($row["donation"]==1){
                $donation="Oui";
            }else{ 
                $donation="Non";
            }
              echo "<ul><li>Date: ".$row["commande_date"]."</li><li>id : " . $row["commande_id"]. "</li><li>Moyen de payement :  " . $row["payement"]."</li><li>Type de panier :  " . $row["panier"]."€</li><li>Donation :  ".$donation."</li></ul><br>";
            }
          }else{
            echo "0 results";
          }
          $conn->close();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./monespace.css"/> 
        <link rel="stylesheet" type="text/css" href="../main/newmain.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    </head> 
    <body>
        <?php include("../header/header.php");?>
        <form action="./include/modify.inc.php" method="post">
        <div id="container">
            <div class="contain" id="mesinfos">
                <h3 id="title">Mes informations :</h3>
                <p class="align">Prénom :</p>
                <div class="info"><?php echo $_SESSION['prenom']?></div>
                <div class="in-line" style="display: flex; flex-direction:row;"><a class="edit"><i class="fas fa-edit"></i></a><div class="unactive" style="margin-left:2rem;"><input placeholder="modifier" name="prenom"><button type="submit" name="submit">Modifier</button></div></div>
                <p class="align">Nom : </p>
                <div class="info"><?php echo $_SESSION['nom']?></div>
                <div class="in-line" style="display: flex; flex-direction:row;"><a class="edit"><i class="fas fa-edit"></i></a><div class="unactive" style="margin-left:2rem;"><input placeholder="modifier" name="nom"><button type="submit" name="submit">Modifier</button></div></div>
                <p class="align">Adresse Email : </p>
                <div class="info"><?php echo $_SESSION['email']?></div>
                <div class="in-line" style="display: flex; flex-direction:row;"><a class="edit"><i class="fas fa-edit"></i></a><div class="unactive" style="margin-left:2rem;"><input placeholder="modifier" name="email"><button type="submit" name="submit">Modifier</button></div></div>
                <p class="align">Numéro de tel : </p>
                <div class="info"> <?php echo $_SESSION['tel']?></div>
                <div class="in-line" style="display: flex; flex-direction:row;"><a class="edit"><i class="fas fa-edit"></i></a><div class="unactive" style="margin-left:2rem;"><input placeholder="modifier" name="tel"><button type="submit" name="submit">Modifier</button></div></div>
                <p class="align">Statut : </p>
                <div class="info"><?php if($_SESSION['statut']==1){
                    echo "<p class='align' id='statut'>Visiteur</p>";
                }else if($_SESSION['statut']==2){
                    echo "<p class='align' id='statut'>Adhérent</p>";
                }else if($_SESSION['statut']==3){
                    echo "<p class='align' id='statut'>Admin</p>";
                }?></div><a></a>
                <p class="align">Adresse :</p>
                <div class="info"><?php if(isset($_SESSION['adresse'])){
                    echo $_SESSION['adresse'];}else{
                    echo '?';}?></div>
                <div class="in-line" style="display: flex; flex-direction:row;"><a class="edit"><i class="fas fa-edit"></i></a><div class="unactive" style="margin-left:2rem;"><input placeholder="modifier" name="adresse"><button type="submit" name="submit">Modifier</button></div></div>
                <p class="align">Sexe :</p>
                <div class="info"><?php if(isset($_SESSION['sexe'])){
                    echo $_SESSION['sexe'];}else{
                    echo '?';}?></div>
                <div class="in-line" style="display: flex; flex-direction:row;"><a class="edit"><i class="fas fa-edit"></i></a><div class="unactive" style="margin-left:2rem;"><input placeholder="modifier" name="sexe"><button type="submit" name="submit">Modifier</button></div></div>
            </div>
            </form>
            <div class="contain" id="mescommandes">
                <h3 id="title">Mes commandes :</h3>
                <?php 
                getusercommandes($conn, $_SESSION["id"]);
                ?>
            </div>
            <!-- On utilise value pour avoir le statut de l'utilisateur dans le JS (si il n'est pas alors on cache ce div avec jquery -->
            <div class="contain" id="admin" value ="<?php echo $_SESSION['statut']?>" >
            <h3 id="title">Mon espace membre :</h3>
                <form action="./include/apply.inc.php" method="post" id="changestat" value="<?php echo $_SESSION['statut']?>">
                    <input class="padding" name="nom" type="text" id="Qprenom" placeholder="Nom">
                    <input class="padding" name="prenom" type="text" id="Qnom" placeholder="Prénom">
                    <select class="padding" name="selection">
                        <option value="1">Visiteur</option>
                        <option value="2">Adhérent</option>
                        <option value="3">Admin</option>
                    </select>
                    <button type="submit" name="submit">Appliquer</button>
                    <?php if($_GET["error"]==none){
                            echo "<br><p class='result'>Statut bien changé !</p>";
                        }else if($_GET["error"]==nouser){
                            echo "<br><p class='result'>Aucun utilisateur correspondant</p>";
                        }
                        ?>
                </form>
                <div id='gerercommande'>
                    <a type='button' class='btn' href="./gerercommandes.php">Gérer les commandes</a>
                </div>
        </div>       
        <?php include("../footer/footer.php");?>
        <script src="./monespace.js" charset="utf-8"></script>
    </body>
</html>