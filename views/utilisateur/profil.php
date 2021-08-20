<div class="blocProfil">
    <div><a href="/script_box/utilisateur/questions/<?=$infoUser->getIdUtilisateur()?>">Question posées</a></div>
    <div><a href="/script_box/utilisateur/trophe/<?=$infoUser->getIdUtilisateur()?>">Trophées</a></div>
    <h4>Information Principal</h4>
    <div class="infoPrincipalCompte">
        <h5>Dernier Trophées</h5>
        <div class="blocLastAllTrophe">
            <?php if(empty($listeTrophe)){

                echo "Vide...";

            };?>
            <?php foreach ($listeTrophe as $trophe):?>
                <div class="blocLastTrophe">
                    <img src="../../views/img/trophe/<?= $trophe->getImage(); ?>" alt="">
                    <span><?= $trophe->getNom(); ?></span>
                </div>
            <?php endforeach?>
        </div>
        <h5>Pseudo</h5>
        <p><?= $infoUser->getPseudo();?></p>
        <img class="compteProfilPicture" src="/script_box/views/img/profil_picture/<?= $infoUser->getPicture();?>" alt="">
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
</div>