<?php
namespace Controller;
use Database;
use Dao\UtilisateurDao;



class UtilisateurController extends Controller{

    public function index(){

        $dao = new UtilisateurDao();
        $infoUser=  $dao->findById($_SESSION['idSession']);
        $setting = compact(['infoUser']);
        $this->afficherVue('compte', $setting);


    }
    public function compte(){
        $this->index();
    }
    public function profil($settings){

        $dao = new UtilisateurDao();
        $infoUser=  $dao->findById($settings[0]);
        $setting = compact(['infoUser']);
        $this->afficherVue('profil',$setting);
    }
    public function questions($settings){
        $dao = new \Dao\CommentaireDao();
        $commentaireUser = $dao->findCommentaireByIdUtilisateur($settings[0]);
        $setting =compact(['commentaireUser']);
        $this->afficherVue('question',$setting);



    }
    public function compte_edit(){
        $dao = new UtilisateurDao();
        var_dump($_FILES['picture']['name']);
        if (isset($_POST['pseudo']) OR isset($_FILES['picture']) OR isset($_POST['biographie']) OR isset($_POST['prenom']) OR isset($_POST['nom']) ) {
            if ($_POST['pseudo']!="" OR $_FILES['picture']!="" OR $_POST['biographie']!="" OR $_POST['prenom']!="" OR
            $_POST['nom']!="" ) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $biographie = htmlspecialchars($_POST['biographie']);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $picture =$_FILES['picture']['name'];
                var_dump($_FILES['picture']['name']);

                $update = $dao->updateUtilisateurCompte($pseudo,$biographie,$prenom,$nom,$picture,$_SESSION['idSession']);
                if ($update) {
                    echo "Une erreur est survenue";
                    
                }
                else {
                    echo "Votre Compte a bien été modifié";
                }
            }
            else {
                echo '<div>Vous devez remplir tous les champs</div>';
            }
        }
        $infoUser=  $dao->findById($_SESSION['idSession']);
        $setting = compact(['infoUser']);
        (!isset($_SESSION['pseudoSession'])) ? $this->redirect('404'): $this->afficherVue('compte_edit',$setting);
       


    }
    public function afficherUtilisateur(){

        $dao =new UtilisateurDao();
        $listeUtilisateur = $dao ->findAll();
        $setting = compact(['listeUtilisateur']);

        $this->afficherVue('listeUtilisateur', $setting);
        
    }
    public function connexion(){

        (isset($_SESSION['pseudoSession'])) ? $this->redirect('404'): $this->afficherVue('connexion') ;


        if (isset($_POST["pseudo"])) {
            if ($_POST["pseudo"]!="" && $_POST["mdp"]!="" ) {
                $dao = new UtilisateurDao;
                $utilisateur=$dao->connexionDao($_POST["pseudo"]);

                if ($utilisateur &&password_verify($_POST["mdp"], $utilisateur->getPassword()) ) {
                    
                    $_SESSION['pseudoSession'] = $utilisateur->getPseudo();
                    $_SESSION['idSession'] = $utilisateur->getIdUtilisateur();
                    $_SESSION['pictureSession'] = $utilisateur->getPicture();
                    if ($utilisateur->getAdmin()==true) {
                        $_SESSION['adminSession'] =$utilisateur->getAdmin();;
                    }
                    
                    $this->redirect('commentaire');
                    
                }
            }
            else {
                echo"Veuillez remplir tous les champs";
            }
            
        }

    }
    public function deconnexion(){

        session_destroy();
        $this->redirect('accueil');
        

    }

    public function inscription(){

        (isset($_SESSION['pseudoSession'])) ? $this->redirect('404'): $this->afficherVue('inscription');

        if (isset($_POST['pseudoUtilisateur'])) {
            $dao = new UtilisateurDao;
            $utilisateurs=$dao->verifyDoubleDao($_POST["pseudoUtilisateur"],$_POST['emailUtilisateur'], $_POST['mdpUtilisateur']);
            if ($utilisateurs) {
                echo "<div>Information(s) déjà utilisée(s)</div>";
            }else{
                
                $nomUser= htmlspecialchars($_POST['nomUtilisateur']);
                $prenomUser= htmlspecialchars($_POST['prenomUtilisateur']);
                $pseudoUser= htmlspecialchars($_POST['pseudoUtilisateur']);
                $emailUser= $this->verifEmail(htmlspecialchars($_POST['emailUtilisateur']));
                $mdpUser= htmlspecialchars($_POST['mdpUtilisateur']);
        
                if ($nomUser=="" ||$prenomUser=="" || $pseudoUser=="" ||$mdpUser==""|| $emailUser=="" ) {
                    if ($emailUser=="") {
                        echo "<p>Email incorrecte</p>";
                    }
                    else {
                        echo "<p>Vous devez remplir tous les champs. ";
                    }
                    
                }
                else {
                    if ($mdpUser!=$_POST['verifMdpUtilisateur']) {
                        ?>
                        <div class="blocWrongMsg"> 
                        <?php
                        echo "<p> Veuillez entrer deux mots de passe identique</p>";
                        ?>
                        </div>
                        <?php
                    }
                    else {
                        if ($nomUser!="") {
                            //contenu de la requete SQL 
                
                            $dao->inscriptionDao($nomUser,$prenomUser,$pseudoUser,$emailUser,$mdpUser);
                            
                        } 
                        echo"Vous vous êtes bien inscrit";
                    //    $this->refresh(1);
                    //    $this->redirect('accueil');
                    
                        
                    }
                }
            }
    }






    }

    
}