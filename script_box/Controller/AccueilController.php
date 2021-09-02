<?php

namespace Controller;

    class AccueilController extends Controller
    {
        public function index(){
            $this->afficherVue('accueil');
        }
        public function search(){
            $dao = new \Dao\AccueilDao();
            $controller = new CommentaireController();
            
            if (isset($_POST['search']) && $_POST['search']!="" ) {
                $_SESSION['searchSession'] = $_POST['search'];
            }
            if (isset( $_SESSION['searchSession'])) {
                
                $pagination = $_POST['pagination'] ?? 1;
                $listeSearch = $dao->findSearch($_SESSION['searchSession'], $pagination);
                $listeSearchUtilisateur = $dao->findSearchUtilisateur($_SESSION['searchSession'], $pagination);
               
                $maxPage=$controller->pagination("",$_SESSION['searchSession']);
                $settingPage = compact(['pagination', 'maxPage']);
                if ($listeSearch OR $listeSearchUtilisateur) {
                    $setting = compact(['listeSearch','listeSearchUtilisateur']);
                    if ($maxPage>1) {
                        $controller->afficherVue('pagination', $settingPage);
                    }
                    $this->afficherVue('search', $setting);
                    
                }
                else {
                    echo"0 résultat pour ". $_SESSION['searchSession'] ."";
                }
            }
            // else {
            //     $this->afficherVue('404');
            // }





        }
        
    }
    