<div class="flex-center"><?php include ('views/reponse/notConnect.php')?></div>
<div class="containerPost ">

    <?php foreach ($listeReponse as $reponse ):?>
        <div class="blocPostAnswer">
                <div>
                        <a href="/script_box/utilisateur/profil/<?=$reponse->getIdUtilisateur()?>"><img class="profilPicture" src="../../views/img/profil_picture/<?= $reponse->afficherProfilPicture($reponse->getIdReponse())?>" alt=""> <span><?= $reponse->afficherPseudo($reponse->getIdReponse())?></span></a>
                       
                        
                </div>
                <p><?= $reponse->getContenu()?></p>
                
                <div class="blocFormLikeDislike">
                        <?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>
                                <button   <?= (isset($_SESSION['pseudoSession'])) ? 'onclick="openAnswerForm()"' : 'onclick="openConnexion()"'?> >Répondre</button>  
                        <?= (isset($_SESSION['pseudoSession'])) ? '</form>' : '' ?>
                        <?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>
                                <button class="btn_like"  name="like" <?= (isset($_SESSION['pseudoSession'])) ? '' : 'onclick="openConnexion()"'?>>
                                <?php if(isset($_SESSION['idSession']) AND $reponse->afficherLike($_SESSION['idSession'], $reponse->getIdReponse()) AND $reponse->afficherLike($_SESSION['idSession'], $reponse->getIdReponse())['vote'] == 1){
                                        echo '<img src="../../views/img/like.svg" alt="icon like">';}
                                        else{
                                        echo '<img src="../../views/img/like_blue.svg" alt="icon like">';}?>
                                </button>  
                                <input type="hidden" name="id_reponse" value="<?=$reponse->getIdReponse()?>">
                                <input type="hidden" name="nb_like" value="<?=$reponse->getLikeReponse()?>"><span><?=$reponse->getLikeReponse()?></span>
                                <input type="hidden" name="nb_dislike" value="<?=$reponse->getDislikeReponse()?>">

                        <?= (isset($_SESSION['pseudoSession'])) ? '</form>' : '' ?><?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>
                                <button class="btn_dislike" name="dislike" <?= (isset($_SESSION['pseudoSession'])) ? '' : 'onclick="openConnexion()"'?> onclick="this.enabled='false'"><?php if(isset($_SESSION['idSession']) AND $reponse->afficherLike($_SESSION['idSession'], $reponse->getIdReponse()) AND $reponse->afficherLike($_SESSION['idSession'], $reponse->getIdReponse())['vote'] == -1){
                                        echo '<img src="../../views/img/dislike_red.svg" alt="icon like">';}
                                        else{
                                        echo '<img src="../../views/img/dislike.svg" alt="icon like">';}?></button>
                                
                                <input type="hidden" name="id_reponse" value="<?=$reponse->getIdReponse()?>">
                                <input type="hidden" name="nb_dislike" value="<?=$reponse->getDislikeReponse()?>"><span><?=$reponse->getDislikeReponse()?></span>
                                <input type="hidden" name="nb_like" value="<?=$reponse->getLikeReponse()?>">
                        <?= (isset($_SESSION['pseudoSession'])) ? '</form>' : ''; ?>
                </div>

        </div>
    <?php  endforeach;?>
</div>

