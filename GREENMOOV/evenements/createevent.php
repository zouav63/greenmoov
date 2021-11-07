<?php session_start()?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../evenements/evenements.css"/> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>  
    <?php include("../header/header.php");?>  
    <!-- Utilisation de value pour avoir le statut de l'utilisateur dans le JS -->
    <div class="container" value='<?php echo $_SESSION['statut']?>'>
        <form action="./include/createnews.inc.php" method="post">
            <input type="text" name="titre" placeholder="Titre de l'event" class="inputE">
            <input type="text" name="content" placeholder="Contenu de l'event" class="inputE">
            <div class="flex-rowE">
                <input type="text" name="lieu" placeholder="Lieu de l'event" class="inputE">
                <input type="datetime-local" name="date" placeholder="Date de l'event" class="inputE">
                <input type="text" name="prix" placeholder="Prix de participation" class="inputE">
                <input type="time" name="time" placeholder="Durée de participation" class="inputE">
                <input type="number" name="nb" placeholder="Nombre maximal de participants" class="inputE">
            </div>
            <input type="submit" name="submit" value="Créer l'évènement" class="inputE">
            <?php if($_GET['error']=='empty'){
                echo '<p style=red>Renseignez tous les champs</p>';
            }
            ?>
        </form>
    </div>      
    <?php include("../footer/footer.php");?>        
</body> 
<script>
    //2ème vérification rapide du statut de l'utilisateur ( Car il aurait pu passer par l'url pour arriver à cette page)
    if(document.querySelector('.container').getAttribute('value')<2){
        $('.container').hide();
    }
</script>
</html>