<?php
namespace Dao;
use Database;

class CommentaireDao extends Dao{


   public function findAll($pagination=""){
        $table=$this->getTable();
        $utilisateur = new UtilisateurDao();
        $tableUtilisateur = $utilisateur->getTable();
        $connexion = new \Database();
        
        $req = $connexion->prepare("SELECT * FROM ".$table." LEFT JOIN utilisateur USING(id_utilisateur) ORDER BY id_commentaire DESC LIMIT ". ($pagination-1)*10 .",10;");
        $req->execute();
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($table);
        $allModel=[];

        foreach ($result as $ligneResultat) {
            $model = $this->arrayToModel($ligneResultat);
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


    public function findCommentaireByIdUtilisateur($id_utilisateur, $pagination){
        $utilisateur = new UtilisateurDao();
        $table=$this->getTable();
        $tableUtilisateur = $utilisateur->getTable();
        $connexion = new \Database();
        
        $req = $connexion->prepare("SELECT * FROM $table WHERE id_utilisateur = $id_utilisateur ORDER BY id_commentaire DESC LIMIT ". ($pagination-1)*10 .",10;");
        $req->execute();
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($table);
        $allModel=[];

        foreach ($result as $ligneResultat) {
            $model = $this->arrayToModel($ligneResultat);
            $allModel[]= $model;
        }  

        return $allModel;
    }
    public function countCommentaire($id){

            
        $table=$this->getTable();
        $connexion = new \Database();
        $where="";
        if ($table=="commentaire" AND $id!="") {
            $where = "WHERE id_utilisateur = $id";
        }
        $count="SELECT count(*) AS commentaire FROM $table $where";
        $resultatCount= $connexion->query($count);
        $countliste = $resultatCount->fetch()['commentaire'];

        return $countliste;
    }

    





}