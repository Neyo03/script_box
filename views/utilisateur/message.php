
<?php
    if (empty($listeMessage)) {
        echo "Vous n'avez aucun message...";
    }
    foreach ($listeMessage as $message ) {
    ?>
    <a href="/script_box/utilisateur/private_message/<?= $message->getIdDestinataire();?>">
        <div>

        <div>
           <img class="profilPicture" src="../views/img/profil_picture/<?= $message->afficherProfilPicture($message->getIdDestinataire());?>" alt="">  
           <?= $message->afficherPseudo($message->getIdDestinataire());?> 
        </div>
        <p><?=  substr($message->getTexte(),0,30);?>...</p>
        
        




        </div>
    </a>
    <?php
    }


?>