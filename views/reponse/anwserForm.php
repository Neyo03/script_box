<div class="blocFormAnswer" id="blocForm">
    <?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>

        <textarea name="contenu" placeholder="Pour que les discussions restent agréables, nous vous remercions de rester poli en toutes circonstances. En postant sur nos espaces, vous vous engagez à en respecter la charte d'utilisation. Tout message discriminatoire ou incitant à la haine sera supprimé et son auteur sanctionné." cols="30" rows="10"><?=(isset($_POST['contenu'])) ? $_POST['contenu'] : '' ?></textarea>
        <input type="hidden" name="id_utilisateur" value="<?=(isset($_SESSION['idSession'])) ? $_SESSION['idSession'] : '' ?>">
        <button <?= (isset($_SESSION['pseudoSession'])) ? '' : 'onclick="openConnexion()"'?> type="submit">Répondre</button>  
    <?= (isset($_SESSION['pseudoSession'])) ? '</form>' : '' ?>


</div>