<div class="blocForm" id="blocForm">
    <?= (isset($_SESSION['pseudoSession'])) ? '<form action="" method="post">' : '' ?>

        <textarea name="contenu" cols="30" rows="10"><?=(isset($_POST['contenu'])) ? $_POST['contenu'] : '' ?></textarea>
        <input type="hidden" name="id_utilisateur" value="<?=(isset($_SESSION['idSession'])) ? $_SESSION['idSession'] : '' ?>">
        <button <?= (isset($_SESSION['pseudoSession'])) ? '' : 'onclick="openConnexion()"'?> type="submit">Répondre</button>  
    <?= (isset($_SESSION['pseudoSession'])) ? '</form>' : '' ?>


</div>