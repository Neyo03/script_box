<div class="blocQuestion" id="nouveauSujet">

<?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>

        <input type="text" name="titre" id="">
        <textarea name="contenu" id="" placeholder="Pour que les discussions restent agréables, nous vous remercions de rester poli en toutes circonstances. En postant sur nos espaces, vous vous engagez à en respecter la charte d'utilisation. Tout message discriminatoire ou incitant à la haine sera supprimé et son auteur sanctionné." cols="30" rows="10"></textarea>
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