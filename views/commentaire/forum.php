
<div class="containerPost ">

    <?php foreach ($listeCommentaire as $commentaire ):?>
        
        <a href="/script_box/commentaire/showPost/<?= $commentaire->getIdCommentaire();?>" class="blocPost">

            <h3><?= $commentaire->getTitre()?></h3>
            <p><?= $commentaire->getContenu()?></p>
           

    </a>
    <?php endforeach;?>
</div>


