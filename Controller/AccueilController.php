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
                $listeSearch = $dao->findSearch($_POST['search']);
                if ($listeSearch) {
                    $setting = compact(['listeSearch']);
                    $this->afficherVue('search', $setting);
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
    