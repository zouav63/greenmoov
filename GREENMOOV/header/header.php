<?php
    session_start();
?>

<link rel="stylesheet" type="text/css" href="../header/header.css" />    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
<header role="header">
    <nav class="menu">
        <div class="m-left" id="logo">
            <a href=""><img src="../images/Greenmoov.png" width="100%" height="100%"></a>
        </div>
        <div class="m-right">
            <a href="../main/newmain.php" class="m-a"><i class="fas fa-home"></i> Home</a>
            <a href="../news/news.php" class="m-a"><i class="fas fa-newspaper"></i> News</a>
            <a href="../evenements/evenements.php" class="m-a"><i class="fas fa-calendar-alt"></i> Events</a>
            <a href="../Contact_us/contactus.php" class="m-a"><i class="fas fa-envelope"></i> Contact us</a>
            <?php 
                if(isset($_SESSION["email"])){
                    echo "<a href='../login/include/logout.inc.php' class='m-a m-login'><i class='fas fa-sign-out-alt'></i> Log out</a>";                    
                    echo "<a id='profile' class='m-a' href='../monespace/monespace.php'><i class='fas fa-user'></i>  ".$_SESSION['prenom']."</a>";
                }else{
                    echo '<a id="login" class="m-a m-login" href="../login/login.php"><i class="fas fa-sign-in-alt"></i> login</a>';
                }
            ?>
        </div>
        <div class="m-nav-toggle">
            <span class="m-toggle-icon"></span>
        </div>
    </nav>
</header>
<script src="../header/header.js"></script>