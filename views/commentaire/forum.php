<a href="#nouveauSujet"><button>NOUVEAU SUJET</button></a>
<div class="containerPost ">
    <div class="blocTitrePost">
        <span>Sujet </></span>
        <span>Auteur</span>
        <span>Nb. Réponse </></span>
    </div>

    <?php 
        foreach ($listeCommentaire as $commentaire ):?>
        <a href="/script_box/commentaire/showPost/<?= $commentaire->getIdCommentaire();?>">
            <div class="blocCom">
                   
                    <h3><?= substr($commentaire->getTitre(),0,30);?>...</h3>
                    <p><?= $commentaire->afficherPseudo($commentaire->getIdCommentaire())?></p>
                    <p><?= $commentaire->afficherCount($commentaire->getIdCommentaire())?></p>
                
                    
            </div>
        </a>

    <?php endforeach;?>
 

    
</div>


