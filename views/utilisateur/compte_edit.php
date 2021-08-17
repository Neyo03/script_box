<div class="blocProfil">
    <form action="" method="post" enctype="multipart/form-data">
        <h4>Information Principal</h4>
        <div class="infoPrincipalCompte">
            <h5>Pseudo</h5>
            <input type="text" name="pseudo" value="<?= $infoUser->getPseudo();?>" id="">
            <br>
            <div class="fileinputs">
                    <input type="file" name="picture" class="file" id="imgInp" value="<?= $infoUser->getPicture();?>"/>
                    <div class="fakefile">
                        <input placeholder=" Modifier l'image" />
                        <img id="blah" src="#" alt="" />
                        <img id="blah1" class="compteProfilPicture" src="../../../script_box/views/img/profil_picture/<?= $infoUser->getPicture();?>" alt="">
                    </div>
            </div>
            
            <div class="blocBio">
                <h5>Biographie</h5>
                <textarea name="biographie" id="" cols="30" rows="5"><?= $infoUser->getBiographie();?></textarea>
            </div>
            
        </div>
        <h4>Information secondaire</h4>
        <div class="infoSecondaireCompte">
        <h5>Prénom</h5> 

        <input type="text" name="prenom" value="<?= $infoUser->getPrenom()?>" id="">

        <h5>Nom</h5>  
        <input type="text" name="nom" value="<?= $infoUser->getNom()?>" id="">
        </div>

        <button type="submit">Enregistrer</button>
    </form>  


</div>
