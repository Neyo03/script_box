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

    <?php foreach ($listeSearchUtilisateur as $searchUtilisateur ):?>
        <div>
            <a href="/script_box/utilisateur/private_message/<?= $searchUtilisateur->getIdUtilisateur();?>">
                <div class="blocSearch">
                    <img class="profilPicture" src="../../script_box/views/img/profil_picture/<?= $searchUtilisateur->getPicture();?>" alt="">
                    <p><?= $searchUtilisateur->getPseudo()?></p>
                    <p><?= $searchUtilisateur->getBiographie()?></p>
                </div>
            </a>
        </div>
    <?php  endforeach;?>


</div>