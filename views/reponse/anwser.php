<div class="flex-center"><?php include ('views/reponse/notConnect.php')?></div>
<div class="containerPost ">

    <?php foreach ($listeReponse as $reponse ):?>
        <div class="blocPost">
                <p><?=  $reponse->getContenu()?></p>
                <?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>
                        <button   <?= (isset($_SESSION['pseudoSession'])) ? 'onclick="openAnswerForm()"' : 'onclick="openConnexion()"'?> >Répondre</button>  
                <?= (isset($_SESSION['pseudoSession'])) ? '</form>' : '' ?>
                <?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>
                        <button class="btn_like" name="like" <?= (isset($_SESSION['pseudoSession'])) ? 'onclick="addLike()"' : 'onclick="openConnexion()"'?>>Like</button>  
                        <input type="hidden" name="id_reponse" value="<?=$reponse->getIdReponse()?>">
                        <input type="hidden" name="nb_like" value="<?=$reponse->getLikeReponse()?>"><span><?=$reponse->getLikeReponse()?></span>

                <?= (isset($_SESSION['pseudoSession'])) ? '</form>' : '' ?><?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>
                        <button class="btn_dislike" name="dislike" <?= (isset($_SESSION['pseudoSession'])) ? 'onclick="addDislike()"' : 'onclick="openConnexion()"'?>>Dislike</button>
                        <input type="hidden" name="id_reponse" value="<?=$reponse->getIdReponse()?>">
                        <input type="hidden" name="nb_dislike" value="<?=$reponse->getDislikeReponse()?>"><span><?=$reponse->getDislikeReponse()?></span>
                <?= (isset($_SESSION['pseudoSession'])) ? '</form>' : '' ?>
                

        </div>
    <?php  endforeach;?>
</div>

