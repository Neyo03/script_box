<?php
namespace Dao;
use Database;

class CommentaireDao extends Dao{


   public function findAll($pagination=""){
        $table=$this->getTable();
        $utilisateur = new UtilisateurDao();
        $tableUtilisateur = $utilisateur->getTable();
        $connexion = new \Database();
        
        $req = $connexion->prepare("SELECT * FROM ".$table." LEFT JOIN utilisateur USING(id_utilisateur) LIMIT ". ($pagination-1)*3 .",3;");
        $req->execute();
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($table);
        $model_class_Utilisateur = "Model\\".ucfirst($tableUtilisateur);
        // var_dump($model_class_name);
        $allModel=[];
        $allModelUtilisateur=[];



        foreach ($result as $ligneResultat) {

            $model = $this->arrayToModel($ligneResultat);
            $allModel[]= $model;
            $modelUtilisateur = $utilisateur->arrayToModel($ligneResultat);
            $allModelUtilisateur[]= $modelUtilisateur;

        }
        // var_dump($allModel);
        $allModel[] = $allModelUtilisateur;
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

    public function paginationDao(){
        $table=$this->getTable();
        $connexion = new Database();
        $countArticle="SELECT count(*) AS nb_article FROM $table";
        $resultatCountArticle= $connexion->query($countArticle);
        $countlisteArticles = $resultatCountArticle->fetch()['nb_article'];
        $maxPage = ceil($countlisteArticles/3);
        return $maxPage;

    }




}