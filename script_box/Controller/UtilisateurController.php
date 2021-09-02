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
        if (isset($_POST['pseudo']) OR isset($_FILES['picture']) OR isset($_POST['biographie']) OR isset($_POST['prenom']) OR isset($_POST['nom']) ) {
            if ($_POST['pseudo']!="" OR $_FILES['picture']["name"]!="" OR $_POST['biographie']!="" OR $_POST['prenom']!="" OR
            $_POST['nom']!="" ) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $biographie = htmlspecialchars($_POST['biographie']);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $picture =$_FILES['picture']["name"];
                $pictureSize = filesize($_FILES['picture']["tmp_name"]);
    

               

                if ($picture!="" AND $pictureSize<=2000000 ) {
                

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
                    echo"image invalide";
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
    public function conversation(){

        $dao = new \Dao\ConversationDao();
        $listeConversation = $dao->findConversationByIdUtilisateur($_SESSION['idSession']);
        $setting = compact(['listeConversation']);
        $this->afficherVue('conversation',$setting);

    }
    public function private_conversation($settings){
        $daoParticipant = new \Dao\ParticipantDao();
        if (!empty($settings) AND is_numeric($settings[0]) AND $daoParticipant->utilisateurExistInConversation($settings[0], $_SESSION['idSession']) ) {

            $dao = new \Dao\MessageDao();
            $daoUtilisateur = new \Dao\UtilisateurDao();
            $daoConversation = new \Dao\ConversationDao();

            $conversation = $daoConversation->findConversationByIdConversation($settings[0]);
            $listeMessage=$dao->findMessageByIdConversation($settings[0]);
            $listeUtilisateurConversation=$daoUtilisateur->findPseudoByIdConversation($settings[0]);

            $setting = compact(['listeMessage','listeUtilisateurConversation','conversation']);
            if (isset($_POST['reponseMessage'])) {
                $this->refresh(0);
            }
            $this->afficherVue('private_conversation', $setting);
            $this->repondreMessage($settings[0]);
        }
        else {
            echo"Conversation introuvable";
        }



    }
    public function private_message($settings){
        $daoUtilisateur = new \Dao\UtilisateurDao();
        if (!empty($settings) AND is_numeric($settings[0]) AND $daoUtilisateur->utilisateurExist($settings[0]) ) {

            $dao = new \Dao\ConversationDao();
            $daoParticipant= new \Dao\ParticipantDao();
            $conversation =$dao->verifConversationExist($settings[0]);
            var_dump($conversation);
            if ($conversation) {
                header("Location: /script_box/utilisateur/private_conversation/". $conversation['id_conversation']."");
            }
            else {
                $id_conversation = $settings[0] * $_SESSION['idSession'] ;
                $conversationDouble = $dao->verifyDoubleConversation($id_conversation);
                $count=0;
                if ($conversationDouble) {
                    while ($conversationDouble) {  
                        $id_conversation +=1;
                        $conversationDouble = $dao->verifyDoubleConversation($id_conversation);
                    }
                }
                    $create = $dao->createConversation($id_conversation);
                    $listeParticipants = [$settings[0], $_SESSION['idSession']];
                    $daoParticipant->addParticipant($listeParticipants,$id_conversation);
                    header("Location: /script_box/utilisateur/private_conversation/".$id_conversation."");
                    
                
            }
        }
        else {
            echo"utilisateur introuvable";
        }




    }

    public function repondreMessage($id_conversation){

        if (isset($_POST['reponseMessage']) AND $_POST['reponseMessage']!="") {
            $dao= new \Dao\MessageDao();
            $dao->envoyerMessage($_POST['reponseMessage'], $_SESSION['idSession'], $id_conversation); 
            $this->refresh(0);
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