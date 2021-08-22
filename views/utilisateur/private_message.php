<?php
$class="";
?>
    <div class="profilMessage">
        <a href="/script_box/utilisateur/profil/<?=$destinataire->getIdUtilisateur()?>"><img class="profilPicture" src="../../views/img/profil_picture/<?= $destinataire->afficherProfilPicture($destinataire->getIdUtilisateur())?>" alt=""><span><?= $destinataire->afficherPseudo($destinataire->getIdUtilisateur())?></span></a>
        
    </div>
    <div class="blocPrivateMessage">
<?php
            foreach ($listeMessageDestinataire as $messageDestinataire ) {
                if ($_SESSION['idSession']==$messageDestinataire->getIdUtilisateur()) {
                   ?>
                        <div class="blocUtilisateur" >
                            <p><?=$messageDestinataire->getTexte()?></p>
                        </div>
                   <?php
                }
                else {
                   ?>

                   <div class="blocDestinataire" >

                        <div>
                            <a href="/script_box/utilisateur/profil/<?=$messageDestinataire->getIdUtilisateur()?>"><img class="profilPictureMsg" src="../../views/img/profil_picture/<?= $messageDestinataire->afficherProfilPicture($messageDestinataire->getIdUtilisateur());?>" alt="">  
                            <span><?= $messageDestinataire->afficherPseudo($messageDestinataire->getIdUtilisateur());?> </span></a>
                           
                        </div>
                        <p><?=$messageDestinataire->getTexte()?></p>
                
        
                    </div>
            <?php
                }
        ?>
        
        <?php
        }
?>
        </div>

   
    

    