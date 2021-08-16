<div class="BlocTitrePost">

<h2>Sujet : <?= $commentaire->getTitre();?></h2>

</div>
<div class="blocPost" >
    <div>
        <img class="profilPicture" src="../../views/img/profil_picture/<?=$commentaire->getProfilPicture($commentaire->getIdCommentaire());?>" alt="">
        <span><?= $commentaire->getPseudo($commentaire->getIdCommentaire());?></span>
    </div>
    <p><?= $commentaire->getContenu();?></p>
   
    

</div>
<div class="repondre">
    <a href="#blocForm"><button>Répondre</button></a>
</div>
