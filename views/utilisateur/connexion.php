<h1>Se connecter</h1>

<div class="blocConnexion">
<form action="" method="post">  
    <input type="text" placeholder="Pseudo / Email" name="pseudo" value="<?= ($_POST['pseudo'] ?? '' ) ?>" id="">
    <input type="password"  placeholder="Mot de passe" name="mdp" id="">
    <input type="submit" class="btnConnexion" value="Connexion">
</form>
</div>
