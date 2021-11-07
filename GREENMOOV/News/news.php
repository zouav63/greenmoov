<?php 
    session_start();
    include_once '../dbh.inc.php';

    function getnews($conn){
        $sql = "SELECT * FROM news ORDER BY date";
        $result = $conn->query($sql);
        if($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
                $id=$row['id'];
                echo "<div class='news_n'>";
                if($_SESSION['statut']===3){
                    echo "<a href='./include/deletenews.inc.php?id=",$id,"' class='' style='color:black;'><i class='fas fa-trash trash_n'></i></a>";
                }
                    echo "<div class='intro_n'><h2>{$row['titre']}</h2><p>{$row['sous_titre']}</p></div>";
                    echo "<div class='content_n'><a href='".$row['a_link']."' style='text-decoration:none;'><h1 class='content-titre_n'>{$row['a_titre']}</h1><div class='content-a_n'><p class='content-para_n'>{$row['a_content']}</p><img class='image_n' src='".$row['a_image']."'></div></a></div>";
                    echo "";
                echo "</div>";
            }
      }else{
        echo "<p style='padding: 2rem; text-align:center;'>Pas d'actualité pour le moment</p>";
      }
      $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="./news.css"/> 
</head>
<body>
    <?php include("../header/header.php");?>
    <section id="section">
    <div class="contain_news">
        <?php 
        if($_SESSION['statut']>1){
            echo '<a href="./createnews.php" class="button_n">Créer un article</a>';
        }
        getnews($conn);
        ?>
    </div>
    </section>
    <?php include("../footer/footer.php");?>
    <script src="./news.js"></script>
</body>
</html>