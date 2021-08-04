<?php
namespace Controller;
use Database;
use Dao\UtilisateurDao;



class UtilisateurController extends Controller{

    public function index(){
        $this->afficherVue('compte');
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