<?php

namespace Controller;
Use Dao\CommentaireDao;
Use Dao\UtilisateurDao;

    class CommentaireController extends Controller
    {
        public function index(){
            $dao = new CommentaireDao();
            $daoUtilisateur = new UtilisateurDao();

            $pagination = $_POST['pagination'] ?? 1;
            $maxPage = $this->pagination();
            $settingPage = compact(['pagination', 'maxPage']);
            $listeCommentaire = $dao->findAll($pagination);
            $setting = compact(['listeCommentaire']);

            (isset($_POST['titre'])) ? $this->ask() : '';
            (!isset($_SESSION['pseudoSession'])) ? $this->notConnect() : '';

            $this->afficherVue('forum', $setting);
            $this->afficherVue("pagination", $settingPage);
            $this->afficherVue('askQuestion', $setting);
            
        }
        public function forum(){
           $this->index();
        }
        public function showPost($settings){

            $dao = new CommentaireDao();
            $commentaire = $dao->findById($settings[0]);
            if($commentaire){
                $setting = compact(['commentaire']);
                $this->afficherVue('showPost', $setting);
                $reponse = new ReponseController;
                $reponse->showAnswer($settings[0]);
                $reponse->answer($settings[0]);
               
            }
            else {
                echo'Page introuvable';
            }
        }
        public function ask(){
            if (isset($_POST['titre'])) {
                $dao=new CommentaireDao;
                $titre=htmlspecialchars($_POST['titre']);
                $contenu=htmlspecialchars($_POST['contenu']);
                $id_tag=htmlspecialchars($_POST['id_tag']);
                $id_utilisateur=htmlspecialchars($_POST['id_utilisateur']);
                if ($contenu != '' && $id_utilisateur != '' && $titre !='' && $id_tag!='') {
                    $dao->postAsk($titre,$contenu,$id_tag,$id_utilisateur);
                    $this->refresh(0);
                }
                else{
                    echo"Veillez remplir tous les champs";


                }
            }
            
        }
        public function pagination(){
            $daoPage = new CommentaireDao();
            return $daoPage->paginationDao();
        }
        // public function showUtilisateur(){

            

        // }



        
        
    }
    