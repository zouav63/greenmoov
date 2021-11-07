<?php
session_start();
include '../dbh.inc.php';
include_once '../evenements/function.php';

function get3news($conn){
    $sql = "SELECT * FROM news ORDER BY date DESC LIMIT 3";
    $result = $conn->query($sql);
    $cmpt=1;
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){
            $id=$row['id'];
            echo "<div data-aos='zoom-in'><div id='news{$cmpt}' class='news zoom'><a href='{$row['a_link']}'><h4 class='title' style='font-size:180%; color:black'>{$row['a_titre']}</h4><img src='{$row['a_image']}'><p>{$row['a_content']}</p></a></div></div>";
            $cmpt= $cmpt + 1;
        }
  }else{
    echo "<p style='padding: 2rem; text-align:center;'>Pas d'actualité pour le moment</p>";
  }
  $result->close();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./newmain.css"/>  
    </head> 
    <body>
        <div class="sticky">
            <?php include("../header/header.php")?>
        </div>
        <div id="reseaux">
            <a href="https://www.facebook.com/cygreenmoov/?ref=page_internal"><i class="fab fa-facebook-square fa-3x" style="color:#3b5998"></i></a>
            <a href="https://t.me/s/greenmoov"><i class="fab fa-telegram-plane fa-3x" style="color:#0088cc"></i></a>
            <a href="https://www.instagram.com/green_moov/"><i class="fab fa-instagram fa-3x" style="color: transparent;background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);background: -webkit-radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);background-clip: text;-webkit-background-clip: text;"></i></a>
        </div>
        <div data-aos="fade-down" id="back">
            <img id="greenmoov" src="../images/greenmoov.png">
            <p class='title'>Votre association écologique<br><br>Des paniers bios toutes les semaines !</p>
        </div>
        <a class="ca3-scroll-down-link ca3-scroll-down-arrow" data-ca3_iconfont="ETmodules" data-ca3_icon=""></a>
        <div class="container">
            <div data-aos="fade-right" id="panier10">
                <div class="wrapper">
                    <p class="title">panier de légumes à 10&#x20AC<p>
                    <img src="../images/Basket/Panier20.png" width="80%" heigt="60%">  
                    <a href="../Commandes/commande10.php" style="text-decoration:none">Commander</a>
                </div>
            </div>
            <div data-aos="fade-left" id="panier20">
                <div class="wrapper">
                    <p class="title">panier de légumes à 20&#x20AC<p>
                    <img src="../images/Basket/Panier.png" width="80%" heigt="60%">
                    <a href="../Commandes/commande20.php" style="text-decoration:none">Commander</a>
                </div>
            </div>
                <span data-aos="fade-right" id="line1" class="line"></span>
                <span data-aos="fade-left" id="line2" class="line"></span>
            <div id="news">
                <h3 data-aos="fade-down" id="lastnews"><br><a href="#" class="title">Les dérnières news</a></h3>
                <?php get3news($conn) ?>
            </div>
            <span data-aos="fade-down" id="line3"></span>
            <div id='event'>    
                <h3 data-aos="fade-down" style="text-align:center;"><a href="#" class="title">Le prochain event</a></h3>
                <div style="margin-top:-40px;" data-aos="fade-up">
                    <?php 
                    getoneevent($conn);
                    ?>
                </div>
            </div>
            <div id="foot">
                <?php include("../footer/footer.php")?>
            </div>
        </div>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
    </body>
</html>