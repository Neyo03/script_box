<?php

namespace Controller;

    class AccueilController extends Controller
    {
        public function index(){
            $this->afficherVue('accueil');
        }
        public function search(){
            if (isset($_POST['search']) && $_POST['search']!="") {
                $dao = new \Dao\AccueilDao();
                $controller = new CommentaireController();
                    $pagination = $_POST['pagination'] ?? 1;
                    $maxPage=$controller->pagination();
                    $settingPage = compact(['pagination', 'maxPage']);
                    $_SESSION['searchSession'] = $_POST['search'];
                   
                $listeSearch = $dao->findSearch($_SESSION['searchSession'], $pagination);
                if ($listeSearch) {
                    $setting = compact(['listeSearch']);
                    $this->afficherVue('search', $setting);
                    if ($maxPage>0) {
                        $controller->afficherVue('pagination', $settingPage);
                    }
                    
                }
                else {
                    echo"0 résultat pour ". $_POST['search'] ."";
                }
            }
            else {
                $this->afficherVue('404');
            }





        }
        
    }
    