<div class="BlocTitrePost">

<h2>Sujet : <?= $commentaire->getTitre();?></h2>

</div>
<div class="blocPost" >
    <div>
        <a href="/script_box/utilisateur/profil/<?=$commentaire->getIdUtilisateur()?>"><img class="profilPicture" src="../../views/img/profil_picture/<?=$commentaire->afficherProfilPicture($commentaire->getIdCommentaire());?>" alt="">
        <span><?= $commentaire->afficherPseudo($commentaire->getIdCommentaire());?></span></a>
    </div>
    <p><?= $commentaire->getContenu();?></p>
   
    

</div>
<div class="repondre">
    <a href="#blocForm"><button>Répondre</button></a>
</div>
