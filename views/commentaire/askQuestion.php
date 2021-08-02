<div class="bloc Question ">

<?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>

        <input type="text" name="titre" id="">
        <textarea name="contenu" id="" cols="30" rows="10"></textarea>
        <input type="hidden" name="id_utilisateur" value="<?=(isset($_SESSION['idSession']))? $_SESSION['idSession'] : ''?>">
        <select name="id_tag" id="">
            <option value="1">Js</option>
        </select>
        <!-- Ici Il y aura accès à la table tags pour afficher et choisir 1 tags -->
        <!-- <select name="" id="">
            <option value=""></option>
        </select> -->
        <button type="submit">Envoyer</button>
<?= (isset($_SESSION['pseudoSession'])) ? '</form>' : '' ?>
</div>