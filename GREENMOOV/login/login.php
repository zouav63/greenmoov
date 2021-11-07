<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./login.css"/> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    </head> 
    <body>
        <div class="element">
        <h3><a id="log" class="active">Sign in</a></h3>
        <h3><a id="reg" class="inactive" style="cursor:pointer">Register</a></h3>
        <form action="./include/login.inc.php" method="post" id="login"> 
                    <div id="input"> 
                        <input type="text" name="email" placeholder="Email">
                        <input type="password" name="password" placeholder="password" style="margin-top:2rem;">
                    </div>
                    <div id="Lbutton">
                            <button type="submit" name="submit">Log in</button>
                    </div>
                <div id="forgot">
                <?php 
                // Récupération des erreurs
            if (isset($_GET["error"])){
                if($_GET["error"] == "empty"){
                    echo "<p style='color:red;'>Remplissez tous les champs</p>";
                }else if($_GET["error"] == "wronglogin"){
                    echo "<p style='color:red;'>Login invalide</p>";
                }else if($_GET["error"] == "invalidname"){
                    echo "<p style='color:red;'>Nom invalide</p>";
                }else if($_GET["error"] == "invalidemail"){
                    echo "<p style='color:red;'>Email invalide</p>";
                }else if($_GET["error"] == "wrongpassword"){
                    echo "<p style='color:red;'>Mot de passe invalide</p>";
                }
            }
        ?>                        
        </div>
        </form>
        <form action="./include/register.inc.php" method="post" id="register"> 
                    <input id="prenom" type="text" name="prenom" placeholder="Prénom">            
                    <input id="nom" type="text" name="nom" placeholder="Nom">
                    <input id="email" type="text" name="email" placeholder="Email">
                    <input id="phone" type="text" name="phone" placeholder="Téléphone">
                    <input id="password" type="password" name="password" placeholder="password">
                    <input id="Cpasword" type="password" name="Cpassword" placeholder="Confirm password">
                    <div id="Rbutton">
                        <button type="submit" name="submit">Register</button>
                    </div>
            </div>
        </form>
        <script src="login.js" charset="utf-8"></script>
    </body>
</html>

