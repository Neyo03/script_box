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
    <script src="/script_box/js/openConnexion.js"></script>
    <script src="/script_box/js/afficherProfil.js"></script>

    

    <title>Script_box / <?= $_GET['p'] ?></title>
</head>
<body>
<header>
    <nav>
        <div class="primary-nav">
            <a href="/script_box/accueil"><img src="https://fakeimg.pl/55/" alt=""></a>
                <form action="/script_box/accueil/search" method="POST">
                    <input type="text" name="search" value=" <?= (isset($_POST['search'])) ? $_POST['search'] :''; ?>"  placeholder="Search">
                    <button class="" type="submit"><img src="" alt=""></button>
                </form>
                <a class="" href="/script_box/commentaire/forum">Forum</a> 
                <div class="bloc-profil">
                    <?php 
                        if(isset($_SESSION['pseudoSession'])){  
                        ?>
                            <a  href="/script_box/utilisateur/conversation"><img class="paperPlaneMessage"src="/script_box/views/img/paper-plane.png" alt="">
                            </a>
                            <div class="menu-deroulant-profil">
                                <img id="" class="profilPicture" onclick="openProfil()" src="/script_box/views/img/profil_picture/<?=$_SESSION['pictureSession']?>" alt="">
                                <div id="contenu-menu-deroulant" style="display: none" class="contenu-menu-deroulant">
                                    <a  href="/script_box/utilisateur/compte">Profil</a>
                                    <a class="" href='/script_box/utilisateur/deconnexion'>Deconnexion</a> 
                                </div> 
                            </div>
                            
                        
                            <?php 
                            }else{
                            ?> 
                            
                            <div>
                                <a class="" href='/script_box/utilisateur/connexion'>Connexion</a> <a class="" href='/script_box/utilisateur/inscription'>Inscription</a>
                                <a  href="/script_box/utilisateur/connexion">Mon compte<img class="profilPicture" src="../../../script_box/views/img/profil_picture/user.png" alt="">
                                </a>
                            </div> 
                            
                    <?php
                        } 
                    ?>
                    
                </div>
        </div>
    </nav>
    </header>
    <div class="container">
        <a href=""></a>
        <?php
            Application::demarrer();
        ?>
       
    </div>
</body>
</html>