<div class="blocNotConnectReponse flex-center" id="blocNotConnectReponse">
<button onclick="quitForm()">X</button>
    <h4>Vous n'êtes pas connecté(e) ?</h4>
    
    <div class="blocConnexion">
        <form action="/script_box/utilisateur/connexion" method="post">  
            <label for="pseudo">Pseudo</label><input type="text" placeholder="Pseudo / Email" name="pseudo" value="<?= ($_POST['pseudo'] ?? '' ) ?>" >
            <label for="password">Mot de passe</label><input type="password"  placeholder="Mot de passe" name="mdp" >
            <input type="submit" class="btnConnexion" value="Connexion">
            <button onclick="quitForm()" >Fermer</button>
            <a href="/script_box/utilisateur/inscription">Inscrivez-vous !</a>
        </form>
    </div>


</div>