<div class="flex-center"><?php include ('views/reponse/notConnect.php')?></div>
<div class="containerPost ">

    <?php foreach ($listeReponse as $reponse ):?>
        <div class="blocPostAnswer">
                <div>
                        <img class="profilPicture" src="../../views/img/profil_picture/<?= $reponse->getProfilPicture($reponse->getIdReponse())?>" alt="">
                        <span><?= $reponse->getPseudo($reponse->getIdReponse())?></span>
                        
                </div>
                <p><?= $reponse->getContenu()?></p>
                <div class="blocFormLikeDislike">
                        <?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>
                                <button   <?= (isset($_SESSION['pseudoSession'])) ? 'onclick="openAnswerForm()"' : 'onclick="openConnexion()"'?> >Répondre</button>  
                        <?= (isset($_SESSION['pseudoSession'])) ? '</form>' : '' ?>
                        <?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>
                                <button class="btn_like" name="like" <?= (isset($_SESSION['pseudoSession'])) ? 'onclick="addLike()"' : 'onclick="openConnexion()"'?>><img src="../../views/img/like.svg" alt="icon like"></button>  
                                <input type="hidden" name="id_reponse" value="<?=$reponse->getIdReponse()?>">
                                <input type="hidden" name="nb_like" value="<?=$reponse->getLikeReponse()?>"><span><?=$reponse->getLikeReponse()?></span>
                                <input type="hidden" name="nb_dislike" value="<?=$reponse->getDislikeReponse()?>">

                        <?= (isset($_SESSION['pseudoSession'])) ? '</form>' : '' ?><?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>
                                <button class="btn_dislike" name="dislike" <?= (isset($_SESSION['pseudoSession'])) ? 'onclick="addDislike()"' : 'onclick="openConnexion()"'?> onclick="this.enabled='false'"><img src="../../views/img/dislike.svg" alt="icon dislike"></button>
                                
                                <input type="hidden" name="id_reponse" value="<?=$reponse->getIdReponse()?>">
                                <input type="hidden" name="nb_dislike" value="<?=$reponse->getDislikeReponse()?>"><span><?=$reponse->getDislikeReponse()?></span>
                                <input type="hidden" name="nb_like" value="<?=$reponse->getLikeReponse()?>">
                        <?= (isset($_SESSION['pseudoSession'])) ? '</form>' : '' ?>
                </div>

        </div>
    <?php  endforeach;?>
</div>

