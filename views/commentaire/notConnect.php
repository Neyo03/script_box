<div class="blocNotConnect" id="blocNotConnect">

    <h4>Vous n'êtes pas connecté(e) ?</h4>
    <div class="blocConnexion">
    <form action="/script_box/utilisateur/connexion" method="post">  
        <input type="text" placeholder="Pseudo / Email" name="pseudo" value="<?= ($_POST['pseudo'] ?? '' ) ?>" >
        <input type="password"  placeholder="Mot de passe" name="mdp" >
        <input type="submit" class="btnConnexion" value="Connexion">
    </form>
    </div>


</div>