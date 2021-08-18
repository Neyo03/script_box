<?php
session_start();
use App\Autoloader;
require 'Autoloader.php';

Autoloader::register();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="../../js/formulaire.js"></script>
    <script src="../../js/likeDislike.js"></script>
    <script src="../../js/openConnexion.js"></script>
    <script src="../../js/afficheImg.js"></script>
    

    <title>Script_box / <?= $_GET['p'] ?></title>
</head>
<body>
<header>
    <nav>
        <div class="primary-nav">
            <a href="/script_box/accueil"><img src="https://fakeimg.pl/55/" alt=""></a>
                <form action="/script_box/accueil/search" method="POST">
                    <input type="text" name="search" value="<?php if(isset($_POST['search']){ echo $_POST['search'];} else {echo'';};?>"  placeholder="Search">
                    <button class="" type="submit"><img src="" alt=""></button>
                </form>
                <div>
                    <?php 
                        if(isset($_SESSION['pseudoSession'])){  
                        ?>
                        <div>
                            <a  href="/script_box/utilisateur/compte"><img class="profilPicture" src="../../../script_box/views/img/profil_picture/<?=$_SESSION['pictureSession']?>" alt="">Mon compte
                            </a>
                        </div> 
                        <a class="" href='/script_box/utilisateur/deconnexion'>Deconnexion</a> 
                        <?php 
                        }else{
                        ?> 
                        <div>
                            <a  href="/script_box/utilisateur/connexion"><img class="profilPicture" src="../../../script_box/views/img/profil_picture/user.png" alt="">Mon compte
                            </a>
                        </div> 
                        <a class="" href='/script_box/utilisateur/connexion'>Connexion</a> <a class="" href='/script_box/utilisateur/inscription'>Inscription</a>
                        <?php
                        } 
                        ?>
                    <a class="" href="/script_box/commentaire/forum">Forum</a> 
                </div>
        </div>
    </nav>
    </header>
    <div class="container">
        <?php
        Application::demarrer();
        ?>
    </div>
</body>
</html>