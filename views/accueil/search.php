<div>

    
        
   
    <?php foreach ($listeSearch as $search ):?>
        <div class="blocCom">
            <a href="/script_box/commentaire/showPost/<?= $search->getIdCommentaire();?>" class="blocPost">

                <h3><?= $search->getTitre()?></h3>
                <p><?= $search->getContenu()?></p>
            </a>
        </div>
    <?php  endforeach;?>


</div>