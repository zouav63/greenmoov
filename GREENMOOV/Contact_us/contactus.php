<!DOCTYPE html>
<html id = "contactus">
    <head>
        <title>Nous contacter</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://kit.fontawesome.com/64d58efce2.js"></script>
        <link rel="stylesheet" href="contactus.css"/>
    </head>

    <body>
        <div class="sticky">
            <?php include_once "../header/header.php"?>
        </div>
        <div class="container">
            <h1>Nous Contacter</h1>
            <p class = "intro"> Vous souaihtez un renseignement ? <br>  
                                N'hésitez pas à nous contacter par mail ou via nos réseaux sociaux !
            </p>
            
            <form action="contactus.php" method="post" class = "formulaire">
                <div class="Prénom">
                    <input type="text" placeholder="Prénom" name="Prénom" required>
                </div>
                <div class="Nom">
                    <input type="text" placeholder="Nom" name="Nom" required>
                </div>
                <div class="telephone">
                    <input type="text" placeholder="n° de téléphone" name="Téléphone" required>
                </div>
                <div class="email">
                    <input type="email" placeholder="Adresse mail" name="Email" required>
                </div>
                <div class="message">
                    <textarea placeholder="Entrez votre message" name="Message" required></textarea>
                </div>
                <div class="envoyer">
                    <input type="submit" value="Envoyer" class = "bouton" name="bouton" />
                </div>
            </form>
            
            <?php
            if (isset($_POST['bouton']))
            {
            
                $Prénom = $_POST['Prénom'];
                $nom = $_POST['Nom'];
                $email = $_POST['Email'];
                $telephone = $_POST['Téléphone'];
                $message = $_POST['Message'];
                $to = "sitegreenmoov@gmail.com";
                $email_subject = "Demande de contact Greenmoov";
                $email_body = "Nouvelle demande de contact sur le site. \n".
                                "$Prénom $nom a écrit le message suivant :\n $message.\n".
                                "Ses coordonnées : \n".
                                "Téléphone : $telephone \n".
                                "Email : $email ";
                mail($to,$email_subject,$email_body);
                echo '<script language="Javascript">
                alert("Votre message a bien été envoyé, merci !");
                </script>';
            
            }
            ?>

            <!-- Il faut installer le dossier sendmail dans www (sur wamp ) ou htdocs (sur (mamp))
            
            modifier le php.ini : -1  voir l'image dans le dossier contactus

                                  -2 verifier que "extension=openssl" est bien activé (enlever le ; devant sinon)

            connexion au compte sur gmail : mail = sitegreenmoov@gmail.com
                                            mdp = Greenmoov2021
            -->

            <div class = "aside">
                <aside class="aside1">
                    <div class="icone">
                        <i class="fas fa-map-marked-alt"></i>
                        <span>CY Tech, Site du Parc, 95000 Cergy</span>
                    </div>
                    <div class="icone">
                        <i class="fas fa-envelope"></i>
                        <span> email@gmail.com</span>
                    </div>
                    <div class="icone">
                        <i class="fas fa-phone"></i>
                        <span>07-00-00-00-00</span>
                    </div>
                </aside>

                <aside class="aside2">
                    <p>Rejoingnez-nous sur nos réseaux pour ne manquer aucune infos !</p>
                    <div class="icone">
                        <a href="https://www.facebook.com/cygreenmoov/" target="_blank" >
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://t.me/greenmoov?fbclid=IwAR0FmDiNEUtir3B-O2oCINqRekfjt9rTkh9wEEP88_6O7IeQf_-7IUv4FMo" target="_blank" >
                            <i class="fab fa-telegram"></i>
                        </a>
                        <a href="https://www.instagram.com/green_moov/" target="_blank" >
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </aside> 
            </div>
        </div>
    </body>
</html>