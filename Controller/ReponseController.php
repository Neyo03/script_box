<?php

namespace Controller;
Use Dao\CommentaireDao;
Use Dao\ReponseDao;
Use Dao\VoteDao;


    class ReponseController extends Controller
    {

        public function showAnswer($id){
            $controller = new CommentaireController();
            $dao = new ReponseDao();
            $pagination = $_POST['pagination'] ?? 1;

            $maxPage=$this->pagination($id);
            $listeReponse = $dao->findAllReponseByIdCommentaire($id, $pagination);
            $setting = compact(['listeReponse']);
            $settingPage = compact(['pagination', 'maxPage']);
            if (isset($_POST['like'])) {
                $dao->likeDao($_POST['id_reponse'], $_SESSION['idSession']);
                $this->refresh(0);
            }
            if (isset($_POST['dislike'])) {
                $dao->dislikeDao($_POST['id_reponse'], $_SESSION['idSession']);
                $this->refresh(0);
            }
            $this->afficherVue('anwser', $setting);
            if ($maxPage>1) {
                $controller->afficherVue('pagination', $settingPage);
            }
            
        }
        
        public function answer($settings){
            
            if (isset($_POST['contenu'])){

                $dao= new ReponseDao;
                $contenu= htmlspecialchars($_POST['contenu']);
                $id_utilisateur = htmlspecialchars($_POST['id_utilisateur']);
                $id_commentaire = $settings;
                if ($contenu != '' && $id_utilisateur != '' && $id_commentaire!='') {
                    $dao->postAnswer($contenu, $id_utilisateur, $id_commentaire);
                    
                }
                else{
                    echo "Veillez remplir tous les champs";
                }
            }
            $this->afficherVue('anwserForm');
        }




    }