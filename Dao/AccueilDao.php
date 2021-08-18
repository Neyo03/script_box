<?php
namespace Dao;
use Database;

class AccueilDao extends Dao{


    public function findSearch($search,$pagination){

        $commentaire = new commentaireDao(); 
        $table=$commentaire->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM commentaire WHERE titre LIKE :titre OR contenu LIKE :contenu ORDER BY id_commentaire DESC LIMIT ". ($pagination-1)*10 .",10;");
        $req->execute([

            ":titre"=>'%'. $search .'%',
            ":contenu"=>'%'. $search .'%'



        ]);
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($table);

        $allModel=[];


        foreach ($result as $ligneResultat) {

            $model = $commentaire->arrayToModel($ligneResultat);
            // On ajoute les produit à la liste des produits 
            $allModel[]= $model;

        }
        return $allModel;



    }









}