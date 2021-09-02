<?php
namespace Dao;
use Database;

class TropheDao extends Dao{

    public function findTrophe($id_utilisateur, $limitation="", $code=""){
        $connexion = new \Database();
        $limit="";
        $and="";
        if ($limitation) {
            $limit = "LIMIT $limitation";
        }
        if ($code) {
            $and = "AND code = $code";
        }
        $req=$connexion->prepare("SELECT * FROM debloque INNER JOIN trophe using(code) WHERE id_utilisateur = $id_utilisateur $and ORDER BY code DESC $limit;");
        $req->execute();
        $result = $req->fetchAll();
        $allModel=[];

        foreach ($result as $ligneResultat) {
            $model = $this->arrayToModel($ligneResultat);
            $allModel[]= $model;
        }  

        return $allModel;

    }
    public function addTrophe($count, $id, $code){
        $trophe= $this->findTrophe($id,"", $code);
        if ($trophe==false) {
            $sql="INSERT INTO `debloque` (id_utilisateur, code) VALUES (:id_utilisateur, :code)";
            $connexion = new Database();
            $requete= $connexion->prepare($sql);
            $requete->execute([
                ":id_utilisateur"=>$id,
                ":code"=>$count, 
                
            ]);     
        }
        


    }


}


