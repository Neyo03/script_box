<?php

namespace Controller;
Use Dao\CommentaireDao;
Use Dao\UtilisateurDao;

    class CommentaireController extends Controller
    {
        public function index(){
            $dao = new CommentaireDao();
            $pagination = $_POST['pagination'] ?? 1;
            $maxPage = $this->pagination();
            $settingPage = compact(['pagination', 'maxPage']);
            $listeCommentaire = $dao->findAll($pagination);
            $setting = compact(['listeCommentaire']);

            (isset($_POST['titre'])) ? $this->ask() : '';
            (!isset($_SESSION['pseudoSession'])) ? $this->notConnect() : '';

            $this->afficherVue('forum', $setting);
            if ($maxPage>1) {
                $this->afficherVue("pagination", $settingPage);
            }
            $this->afficherVue('askQuestion', $setting);
            
        }
        public function forum(){
           $this->index();
        }
        public function showPost($settings){
            $dao = new CommentaireDao();
            $commentaire="";
            if (!empty($settings) AND is_numeric($settings[0])) {
                $commentaire = $dao->findById($settings[0]);
            }
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
                $daoTrophe= new \Dao\TropheDao();
                $countCommentaire = $dao->CountCommentaire($_SESSION['idSession']);
                $verifCount=$this->verifTrophe($countCommentaire);
                if($verifCount!=0){
                    $addTrophe=$daoTrophe->addTrophe($verifCount, $_SESSION['idSession'], $verifCount);
                }
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
        public function verifTrophe($count){

            if ($count>=1 AND $count<10) {
                $count = 1;
            }
            elseif ($count>=10 AND $count<50) {
                $count = 10;

            }
            elseif ($count>=50 AND $count<100) {
                $count = 50;

            }elseif ($count>=100 AND $count<200) {
                $count = 100;

            }elseif ($count>=200 AND $count<500) {
                $count = 200;
            }
            elseif ($count>=500 AND $count<1000) {
                $count = 500;

            }elseif ($count>=1000) {
                $count = 1000;

            }

            return $count;

        }
        // public function pagination(){
        //     $daoPage = new CommentaireDao();
        //     return $daoPage->paginationDao();
        // }





        
        
    }
    