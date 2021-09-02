<?php
    class Application
    {
        public static function demarrer(){
            
            //Chemin qui contient par exemple "produit/afficher/45"
            //Si l'utilisateur a renseigné l'URL "localhost/.../produit/afficher/42"
            $chemin = $_GET['p'];
            //"produit " serait alors le CONTROLLER à utiliser 
            //"Afficher  serait L'action à effectuer (la méthode à appeler du controller)
            //"42" serait le paramètre 

            //On enlève le / à la fin de l'URL
            $chemin = rtrim($chemin,"/");

            $partieUrl= explode("/",$chemin);
            
            //On découpe L'url en plusieur partie  (La première partie sera le nom du controller, la deuxieme sera le nom de l'action (la méthode a appeler ))
            $nomController =(!empty($partieUrl[0])) ? "Controller\\".ucfirst($partieUrl[0])."Controller" : "Controller\AccueilController" ;
            $nomAction=(!empty($partieUrl[1])) ? $partieUrl[1] : "index";

            if (!method_exists($nomController, $nomAction)) {
                   $nomController= "Controller\AccueilController";
                   $nomAction="notFound";
            }      
            $settings = array_slice($partieUrl,2);
            $controller = new $nomController();
            $controller->$nomAction($settings);
            
        }
        public static function lastPage(){

            if (!isset($_SESSION['lastPage'])) {
                $_SESSION['lastPage']=[];
            }



        }



    }
    