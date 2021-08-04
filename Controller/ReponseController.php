<?php

namespace Controller;
Use Dao\CommentaireDao;
Use Dao\ReponseDao;

    class ReponseController extends Controller
    {

        public function showAnswer($id){
            $dao = new ReponseDao();
            $listeReponse = $dao->findAllReponseByIdCommentaire($id);
            $setting = compact(['listeReponse']);
            if (isset($_POST['like'])) {
                $dao->likeDao($_POST['id_reponse'], $_SESSION['idSession']);
                // $this->refresh(0);
            }
            if (isset($_POST['dislike'])) {
                $dao->dislikeDao($_POST['id_reponse'], $_SESSION['idSession']);
                // $this->refresh(0);
            }
            $this->afficherVue('anwser', $setting);
        }
        
        public function answer($settings){
            $this->afficherVue('anwserForm');
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
        }




    }