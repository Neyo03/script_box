<?php
namespace Dao;
use Database;

class TropheDao extends Dao{

    public function findTrophe($id_utilisateur){
        $connexion = new \Database();
        $req=$connexion->prepare("SELECT * FROM debloque INNER JOIN trophe using(code) WHERE id_utilisateur = $id_utilisateur;");
        $req->execute();
        $result = $req->fetchAll();
        $allModel=[];

        foreach ($result as $ligneResultat) {
            $model = $this->arrayToModel($ligneResultat);
            $allModel[]= $model;
        }  

        return $allModel;


    }


}


