<a href="#nouveauSujet"><button>NOUVEAU SUJET</button></a>
<div class="containerPost ">
    <div class="blocTitrePost">
        <span>Sujet </></span>
        <span>Auteur</span>
        <span>Nb. Réponse </></span>
    </div>

    <?php foreach ($listeCommentaire as $commentaire ):?>
        <div class="blocCom">
            <a href="/script_box/commentaire/showPost/<?= $commentaire->getIdCommentaire();?>" class="blocPost">
                <h3><?= substr($commentaire->getTitre(),0,10)?>...</h3>
            </a>
        </div>
    <?php endforeach;?>
    
</div>


