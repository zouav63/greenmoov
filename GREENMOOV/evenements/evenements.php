<?php session_start();
include_once "../dbh.inc.php";
include_once "./function.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./evenements.css"/> 
    </head> 
    <body>
    <div class="sticky">
        <?php include("../header/header.php");?>        
    </div>
        <div class="containerE">
            <?php 
            //Si admin alors bouton créer event 
            if($_SESSION['statut']===3){
                echo '<div style="display:flex; justify-content: center;align-items: center;margin-top:90px;padding:1rem"><a href="./createevent.php" type="button" class="buttonE titleE" style="color:red; position:relative;">Créer un évènements</a></div>';
            }
            getevent($conn);
            ?>
        </div>
        <?php include("../footer/footer.php");?>
        <script src="./evenements.js" charset="utf-8"></script>
    </body>
</html>