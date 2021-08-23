<?php
namespace Controller;
use Database;
use Dao\UtilisateurDao;



class UtilisateurController extends Controller{

    public function index(){

        if (isset($_SESSION['idSession'])) {
            $dao = new UtilisateurDao();
            $daoTrophe = new \Dao\TropheDao();
            $listeTrophe = $daoTrophe->findTrophe($_SESSION['idSession'], 3);
            $infoUser=  $dao->findById($_SESSION['idSession']);
            $setting = compact(['infoUser','listeTrophe']);
            $this->afficherVue('compte', $setting);
        }
        else {
            $this->redirect('404');

        }
        


    }
    public function compte(){
        $this->index();
    }
    public function profil($settings){
        if (!empty($settings)AND is_numeric($settings[0])) {
            $dao = new UtilisateurDao();
            $daoTrophe = new \Dao\TropheDao();
            $infoUser=  $dao->findById($settings[0]);
            $listeTrophe = $daoTrophe->findTrophe($settings[0], 3);
            $setting = compact(['infoUser','listeTrophe']);
            $this->afficherVue('profil',$setting);
        }
        else {
            echo"Page Introuvable";
        }
        
    }
    public function questions($settings){
        if (!empty($settings) AND is_numeric($settings[0])) {
            $controller = new CommentaireController();
            $dao = new \Dao\CommentaireDao();
            $pagination = $_POST['pagination'] ?? 1;
            $maxPage = $controller->pagination($settings[0]);
            $settingPage = compact(['pagination', 'maxPage']);
            $commentaireUser = $dao->findCommentaireByIdUtilisateur($settings[0], $pagination);
            $setting =compact(['commentaireUser']);
            if ($maxPage>1) {
                $controller->afficherVue("pagination", $settingPage);
            }
            $this->afficherVue('question',$setting);
            
        }
        else {
            echo"Page Introuvable";
        }

    }

    public function trophe($settings){
        if (!empty($settings)AND is_numeric($settings[0])) {

            $dao = new \Dao\TropheDao();
            $listeTrophe = $dao->findTrophe($settings[0]);
            $setting = compact(['listeTrophe']);
            $this->afficherVue('trophe',$setting);

        }
        else {
            echo "Page Introuvable";
        }



    }
    public function compte_edit(){
        $dao = new UtilisateurDao();
        if (isset($_POST['pseudo']) OR isset($_FILES['picture']['name']) OR isset($_POST['biographie']) OR isset($_POST['prenom']) OR isset($_POST['nom']) ) {
            if ($_POST['pseudo']!="" OR $_FILES['picture']['name']!="" OR $_POST['biographie']!="" OR $_POST['prenom']!="" OR
            $_POST['nom']!="" ) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $biographie = htmlspecialchars($_POST['biographie']);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $picture =$_FILES['picture']['name'];
                

                $update = $dao->updateUtilisateurCompte($pseudo,$biographie,$prenom,$nom,$picture,$_SESSION['idSession']);
                if ($update) {
                    echo "Une erreur est survenue";
                    
                }
                else {
                    echo "Votre Compte a bien été modifié";
                    $_SESSION['pictureSession'] = $picture;
                    $this->refresh(0);
                }
            }
            else {
                echo '<div>Vous devez remplir tous les champs</div>';
            }
        }
        if (isset($_SESSION['pseudoSession'])) {
            $infoUser=  $dao->findById($_SESSION['idSession']);
            $setting = compact(['infoUser']);
            $this->afficherVue('compte_edit',$setting);
        }
        else {
             $this->redirect('404');
        }
       


    }
    public function message(){

        if(isset($_SESSION['pseudoSession'])){
            $dao = new \Dao\MessagerieDao();
            $listeMessage = $dao->findDestinataireByIdUtilisateur($_SESSION['idSession']);
            $setting = compact(['listeMessage']);
            $this->afficherVue('message',$setting); 
        }else {
            $this->redirect('404');
        } 
        


    }
    public function private_message($settings){

        if (!empty($settings) AND is_numeric($settings[0]) AND $settings[0]!=$_SESSION['idSession']) {
        
            if(isset($_SESSION['pseudoSession'])  ){
                $dao = new \Dao\MessagerieDao();
                $listeMessageDestinataire = $dao->findMessageDestinataire($_SESSION['idSession'], $settings[0]);
                $destinataire = $dao->findPseudoDestinataire($settings[0]);
                $setting = compact(['listeMessageDestinataire','destinataire']);
                $this->afficherVue('private_message',$setting); 
                $this->repondreMessage($settings[0]);
                if (isset($_POST['reponseMessage'])) {
                    $this->refresh(0);
                }
                    
 
            }else {
                $this->redirect('404');
            } 
        }
        else {
            echo"Page Introuvable";
        }
    
    }

    public function repondreMessage($id){

        if (isset($_POST['reponseMessage']) AND $_POST['reponseMessage']!="") {
            $dao= new \Dao\MessagerieDao();
            $dao->repondreMessage($_POST['reponseMessage'], $_SESSION['idSession'], $id);
            
        }
        $this->afficherVue('repondreMessage');




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
                else {
                    echo"Mot de passe ou Pseudo incorrecte";
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