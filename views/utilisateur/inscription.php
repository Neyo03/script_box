<h1>Inscription</h1>

<div class="blocInscription">

    <form action="" method="post">
        <label for="nomUtilisateur"></label><input type="text" required placeholder="Nom" value="<?= ( $_POST['nomUtilisateur'] ?? '' ) ?>" name="nomUtilisateur" id="">

        <label for="prenomUtilisateur"></label><input type="text" required placeholder="Prénom"  value="<?= ( $_POST['prenomUtilisateur'] ?? '' ) ?>" name="prenomUtilisateur" id="">

        <label for="pseudoUtilisateur"></label><input type="text" required  placeholder="Pseudo" value="<?= ( $_POST['pseudoUtilisateur'] ?? '' ) ?>"  name="pseudoUtilisateur" id="">

        <label for="emailUtilisateur"></label><input type="text" required placeholder="Adresse-email"  name="emailUtilisateur" value="<?= ($_POST['emailUtilisateur']) ?? ''?>" id="">

        <label for="mdpUtilisateur"></label><input type="password" required placeholder="Mot de passe"  name="mdpUtilisateur" id="">

        <label for="verifMdpUtilisateur"></label><input type="password" required placeholder="Vérifier mot de passe"  name="verifMdpUtilisateur" id="">
        <div class="envoyer">
            <input  type="submit"  value="S'inscrire">
        </div>
    </form>   
    
</div>   