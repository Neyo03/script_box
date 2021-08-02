<?php
namespace Dao;
use Database;

class CommentaireDao extends Dao{


   public function findAll(){
        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM ".$table." LEFT JOIN utilisateur USING(id_utilisateur) ");
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
    public function findById($id){

        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM ".$table." LEFT JOIN utilisateur USING(id_utilisateur) WHERE id_$table =:id_$table");
        $req->execute([":id_$table" => $id]);
        $result = $req->fetch();
        return $result ? $this->arrayToModel($result) : false;

    }
    public function postAsk($titre,$contenu,$id_tag,$id_utilisateur){
    
        $post = new \Model\Commentaire();
        $sql=$this->create($post);  
        var_dump($sql);  
        //on prépare la requête 
        $connexion = new Database();
        $requete= $connexion->prepare($sql);
        $requete->execute([
            ":titre"=>$titre,
            ":contenu"=>$contenu, 
            ":image"=>NULL,
            ":id_tag"=>$id_tag,
            ":id_utilisateur"=>$id_utilisateur,
            ":id_commentaire"=>NULL,
        ]);     
        
    }




}