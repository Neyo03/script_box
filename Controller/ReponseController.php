<?php

namespace Controller;
Use Dao\CommentaireDao;
Use Dao\ReponseDao;

    class ReponseController extends Controller
    {

        public function showAnswer($settings){

            $dao = new ReponseDao();
            if (isset($_POST['like'])) {
                $dao->likeDao();
                $this->refresh(0);
            }
            if (isset($_POST['dislike'])) {
                $dao->dislikeDao();
                $this->refresh(0);
            }
            $listeReponse = $dao->findAllReponseByIdCommentaire($settings[0]);
            $setting = compact(['listeReponse']);
            $this->afficherVue('anwser', $setting);
            
            
        }
        public function answer($settings){
            $this->afficherVue('anwserForm');
            if (isset($_POST['contenu'])) {
                $dao= new ReponseDao;
                $contenu= htmlspecialchars($_POST['contenu']);
                $id_utilisateur = htmlspecialchars($_POST['id_utilisateur']);
                $id_commentaire = $settings;
                if ($contenu != '' && $id_utilisateur != '' && $id_commentaire!='') {
                    $dao->postAnswer($contenu, $id_utilisateur, $id_commentaire);

                }
            }
        }




    }