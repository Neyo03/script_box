<div>

    <?php foreach ($listeSearch as $search ):?>
        <a href="/script_box/commentaire/showPost/<?= $search->getIdCommentaire();?>">
            <div class="blocSearch">
                <p><?= $search->afficherPseudo($search->getIdCommentaire())?></p>
                <h3><?= $search->getTitre()?></h3>
                <p><?= $search->getContenu()?></p>
            </div>
        </a>
    <?php  endforeach;?>


</div>