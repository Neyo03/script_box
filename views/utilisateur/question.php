

<?php foreach($commentaireUser as $commentaire):?>
   
        <div class="blocPost" >
        <a href="/script_box/commentaire/showPost/<?= $commentaire->getIdCommentaire()?>">
            <div class="BlocTitrePost">
                <h2>Sujet : <?= $commentaire->getTitre();?></h2>
            </div>
            <div>
                <img class="profilPicture" src="../../views/img/profil_picture/<?=$commentaire->afficherProfilPicture($commentaire->getIdCommentaire());?>" alt="">
                <span><?= $commentaire->afficherPseudo($commentaire->getIdCommentaire());?></span>
                
            </div>
            <p><?= $commentaire->getContenu();?></p>
            <p>Réponses: <?= $commentaire->afficherCount($commentaire->getIdCommentaire())?></p>
        </a>
        </div>
    

<?php endforeach?>