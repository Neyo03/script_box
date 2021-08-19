<div class="blocProfil">
    <div><a href="/script_box/utilisateur/questions/<?=$_SESSION['idSession']?>">Question posées</a></div>
    <div><a href="/script_box/utilisateur/trophe/<?=$_SESSION['idSession']?>">Trophées</a></div>
    <a href="/script_box/utilisateur/compte_edit"><button>Modifier profil</button></a>
    <h4>Information Principal</h4>
    <div class="infoPrincipalCompte">
        
        <h5>Pseudo</h5>
        <p><?= $infoUser->getPseudo();?></p>
        <img class="compteProfilPicture" src="../../script_box/views/img/profil_picture/<?= $infoUser->getPicture();?>" alt="">
        <div class="blocBio">
            <h5>Biographie</h5>
            <span><?= $infoUser->getBiographie();?></span>
        </div>
        
    </div>
    <h4>Information secondaire</h4>
    <div class="infoSecondaireCompte">
    <h5>Prénom</h5> <span><?= $infoUser->getPrenom()?></span>
    <h5>Nom</h5>  <span><?= $infoUser->getNom()?></span>
    </div>  
    <a href="/script_box/utilisateur/compte_edit"><button>Modifier profil</button></a>

</div>
