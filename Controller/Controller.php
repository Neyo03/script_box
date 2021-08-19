<?php


namespace Controller ;

class Controller {

    public function getFolder(){

        //Récupére le nom du dossier racine
        return $folder =substr(__DIR__,16,10);
        echo $folder;
    }
    public function afficherVue($file, $setting=[]){
        extract($setting);
        $folder=substr(get_class($this),11,-10);
        include('views/'.$folder."/".$file.'.php');
    }
    public function notConnect(){
        $this->afficherVue('notConnect');
    }
    public function notFound(){
        $this->afficherVue('404');
    }
    public function redirect($arg){

        if (is_string($arg)) {
            header('Location: /'.$this->getFolder().'/'.$arg);
        }
        return false;
        
    }
    public function refresh($arg){

        if (is_numeric($arg)) {
            header('Refresh:'.$arg.'');
        }
        return false;
        
    }
    public function verifEmail($email){

        if (strstr($email, '@')&& strstr($email, '.')) {
            return strtolower($email);
        }
        return false;

    }
    
    public function pagination($id_commentaire="",$search=""){
        $controller= $this->getController();
        $dao = new $controller;
        return $dao->paginationDao($id_commentaire,$search);
    }
    public function getController(){
        $controller = substr(get_class($this),11,-10);
        $controller = "\\Dao\\".$controller."Dao";
        return $controller;

    }







}
