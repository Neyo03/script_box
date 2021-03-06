<?php
namespace Dao;


class Dao {

    public function getTable(){

        
        $table = substr(get_class($this),4,-3);
        $table = strtolower($table);
        return $table;

    }
    public function findAll($pagination=""){
        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM ".$table);
        $req->execute();
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($this->getTable());

        $allModel=[];


        foreach ($result as $ligneResultat) {

            $model = $this->arrayToModel($ligneResultat);
            // On ajoute les produit à la liste des produits 
            $allModel[]= $model;

        }
        return $allModel;
    }
    public function find($id_reponse, $id_utilisateur){
        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM ".$table." WHERE id_reponse = $id_reponse AND id_utilisateur = $id_utilisateur");
        $req->execute();
        $result = $req->fetch();
        return $result ? $this->arrayToModel($result) : false;
    }

    public function create($model){

        $table=$this->getTable();
        $connexion = new \Database();
        $array=$this->modelToArray($model);
        
        // echo implode(",",$array);

        $sql="INSERT INTO `$table` (". implode(",",$array).") VALUES (:". implode(",:",$array).")";
       return $sql;

    }
    public function update($model){

        $table=$this->getTable();
        $connexion = new \Database();
        $array=$this->modelToArray($model);

        $sql="UPDATE INTO `$table` (". implode(",",$array).") VALUES (:". implode(",:",$array).")";
       return $sql;

    }

    public function findById($id){
        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM ".$table." WHERE id_$table =:id_$table");
        $req->execute([":id_$table" => $id]);
        $result = $req->fetch();
        return $result ? $this->arrayToModel($result) : false;

    }

    public function deleteById($id){
        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("DELETE FROM ".$table." WHERE id_$table =:id_$table");
        $requete->execute([":id_$table"=> $id]);
    }

    public function arrayToModel($array){
        $model_class_name = "Model\\".ucfirst($this->getTable());
        
        $model = new  $model_class_name;

        foreach ($array as $colonne_name => $value) {
            $setter_name = str_replace("_"," ", $colonne_name);
            $setter_name=ucwords($setter_name);
            $setter_name=str_replace(" ","",$setter_name);
            $setter_name="set".$setter_name;
            if (method_exists($model, $setter_name)) {
                $model->$setter_name($value); 
            }
        }
        return $model;
        
    }

    public function camelToSnake($method_name){
            $base = substr($method_name,3);
            $colonne_name=strtolower($base[0]);
            for ($i=1; $i <strlen($base) ; $i++) { 
                $lettre = $base[$i];
                if(ctype_upper($lettre)){
                    $colonne_name .= "_" . strtolower($lettre);
                } else {
                    $colonne_name .=$lettre;
                }
            }
        return $colonne_name;

    }
    public function modelToArray($model){

        $array =[];

        foreach (get_class_methods(get_class($model)) as $method_name) {
            if (substr($method_name, 0,3)=='get') {
                $array[] = $this->camelToSnake($method_name);
            }
  
        }
        return $array;
    }
    public function paginationDao($id="",$search=""){
        $table=$this->getTable();
        $connexion = new \Database();
        $where="";
        $like="";
        if ($table=="reponse") {
            $where = "WHERE id_commentaire = $id";
        }
        if ($table=="commentaire" AND $id!="") {
            $where = "INNER JOIN utilisateur using(id_utilisateur) WHERE id_utilisateur = $id";
        }
        if ($search && $search!="") {
            $like = "INNER JOIN utilisateur using(id_utilisateur) WHERE contenu OR titre LIKE '%$search%'";
        }
        $count="SELECT count(*) AS page FROM $table $where $like";
        $resultatCount= $connexion->query($count);
        $countliste = $resultatCount->fetch()['page'];
        $maxPage=0;
        if ($countliste>0) {
            $maxPage = ceil($countliste/10);
        }

        
        return $maxPage;

    }

    






}