<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="./news.css"/> 
</head>
<body>
    <?php include("../header/header.php");?>  
    <div class="container_n">
        <form action="./include/createnews.inc.php" method="post" class="input_n">
            <input type="text" name="titre" placeholder="Titre de l'actu" class="input_n">
            <input type="text" name="stitre" placeholder="Sous titre de l'actu" class="input_n">
            <input type="text" name="a_titre" placeholder="Titre de l'article" class="input_n">
            <input type="text" name="a_content" placeholder="Contenu de l'article" class="input_n">
            <input type="text" name="a_link" placeholder="Lien de l'article" class="input_n">
            <input type="text" name="a_image" placeholder="Lien de l'image" class="input_n">
            <?php if($_GET['error']=='empty'){
                echo '<p style=red>Renseignez tous les champs</p>';
            }
            ?>
            <input type="submit" name="submit" value="Créer l'évènement" class="input_n">
        </form>
    </div>      
    <?php include("../footer/footer.php");?>   
</body>
</html>