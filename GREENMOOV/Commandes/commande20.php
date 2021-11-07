<?php 
    include_once '../dbh.inc.php';
    // récupération des fruits et légumes de la semaine 
    function getliste($conn){
        $sql = "SELECT * FROM `panier` WHERE type=20";
        $result = $conn->query($sql);
        if($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
                echo "<li>{$row['quantité']}{$row['unité']} {$row['légumes']}</li>";
            }
        }else{
            echo '0 result';
        }
    }
?>

<!-- Les pages commande10 commande20 sont principalement des formulaires envoyés à la base données comme ça les admin ont accès à l'ensemble des commandes dans 'mon espace'-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./commande.css"/> 
        <link rel="stylesheet" type="text/css" href="../main/newmain.css"/>
        <?php include("../header/header.php");?>
    </head> 
    <body>
    <h3 class="title" style="text-align:center; margin:3rem;"> Vous avez choisi le panier à 20&#x20AC</h3>
    <?php 
        if($_GET['commande']==1){
            echo "<p style='color:red; text-align:center'>Vous avez bien commandé le panier à {$_GET['panier']} &#x20AC !</p>";
        }else if($_GET['liste']==1){
            echo "<p style='color:red; text-align:center'>Liste a bien été modifié</p>";
        }
    ?> 
        <div id="container">
            <div id="validation">
                <div class="liste">
                    <ul class="panier">
                        <h3>Les légumes de la semaine</h3>
                        <?php getliste($conn)?>
                        <!-- Div caché si l'utilisateur n'est pas membre -->
                        <div class="change">
                            <form action="./include/modifliste.inc.php?panier=20" method="post" class='form'>
                                <div id='liste'>
                                    <div class="flex-row add"> 
                                        <input type="text" name="l[]" placeholder="Légumes/Fruits" class="input">
                                        <input type="text" name="q[]" placeholder="Quantité" class="input">
                                        <select name="u[]" class='input'>
                                            <option value="g">grammes</option>
                                            <option value="">pièces</option>
                                        </select>
                                    </div>
                                </div>
                                <div style='text-align:center'>
                                    <input type="submit" name="submit" value="Modifier liste de la semaine" class="input">
                                </div>
                        </form>
                        <?php if($_SESSION['statut']>=2){echo '<i class="fas fa-plus i"></i>';} ?>
                        </div>
          <!-- J'utilise souvent l'attribut value pour vérifier son statut (si admin/membre alors peut éditer)-->
                        <?php if($_SESSION['statut']>1){echo '<a class="edit"><i class="fas fa-edit"></i></a>';}?>
                    </ul>
                </div>
                <div id="selection">
                    <div id="payement">
    <!-- Vérification que l'utilisateur est bien login pour passer commande parce que même si il y a une première vérification dans le main, il peut toujours y accéder en tapant l'url-->
                    <form action="<?php if(isset($_SESSION['email'])){echo './include/commande.inc.php?panier=20';}else{echo '../login/login.php';}?>" method="post"> 
                        <p>Moyen de payement :</p>
                        <div class="choise">
                            <input type="radio" id="Lydia" value="Lydia" name="payement" checked>
                            <label for="Lydia">Lydia</label>
                        </div>
                        <div class="choise">
                            <input type="radio" id="liquide" value="liquide" name="payement">
                            <label for="liquide">Liquide</label>
                        </div>
                    </div>
                    <div id="donation">
                        <p>Souhaitez-vous faire un don de 1€ à GreenMoov afin d'aider aux frais d'association ?</p>
                        <div class="choise">
                            <input type="radio" id="oui" value="1" name="donation" checked>
                            <label for="oui">Volontiers ! J'ajoute 1€ à mon Lydia.</label>
                        </div>
                        <div class="choise"> 
                            <input type="radio" id="non" value="0" name="donation">
                            <label for="non">Non.</label>
                        </div>
                    </div>
                    <div>
                        <p>Avez-vous déjà payé ?</p>
                        <div class="choise">
                            <input type="radio" id="poui" value="1" name="p">
                            <label for="poui">Oui</label>
                        </div>
                        <div class="choise"> 
                            <input type="radio" id="pnon" value="0" name="p" checked>
                            <label for="pnon">Non</label>
                        </div>
                    </div>
                    <div>
                        <p>Commentaire : empêchements, informations de livraison, ...</p>
                        <textarea class="choise" name="comment" id="comment" cols="30" rows="5" placeholder="Ecrivez ici ..."></textarea>
                    </div>
            </div>
                <button name="submit" type="submit">Valider</button>
            </form>
            </div>
            <div id="panier">
                <img src="../images/Basket/Panier20.png" width="80%" heigt="60%">  
            </div>
        </div>
        <?php include("../footer/footer.php");?>
        <script src="./commande.js" charset="utf-8"></script>
    </body>
</html>

