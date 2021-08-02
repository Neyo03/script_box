<?php
namespace Dao;
use Database;

class ReponseDao extends Dao{


    public function findAllReponseByIdCommentaire($id){
        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT reponse.contenu, reponse.id_reponse, reponse.id_utilisateur, reponse.id_commentaire, reponse.like_reponse,reponse.dislike_reponse FROM ".$table." INNER JOIN commentaire USING (id_commentaire) WHERE reponse.id_commentaire = :id_commentaire ORDER BY like_reponse DESC");
        $req->execute([

            ":id_commentaire"=>$id

        ]);
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

    public function postAnswer($contenu, $id_utilisateur, $id_commentaire){

        $post = new \Model\Reponse();
        $sql=$this->create($post);
        
            
        //on prépare la requête 
        $connexion = new Database();
        $requete= $connexion->prepare($sql);
        $requete->execute([
            ":contenu"=> $contenu, 
            ":id_reponse"=>NULL,
            ":id_utilisateur"=> $id_utilisateur,
            ":id_commentaire"=>$id_commentaire,
            ":like_reponse"=>0,
            ":dislike_reponse"=>0
        ]);
        



    }
    public function updateLike($model){

       
        if(isset($_POST['id_reponse'])){
            $like = new \Model\Reponse();
            $table=$this->getTable();
            $connexion = new \Database();
            $id_reponse = $_POST['id_reponse'];
            $sql="UPDATE `$table` SET `like_reponse` = :like_reponse WHERE `reponse`.`id_reponse` = $id_reponse";
            return $sql;
        } 
    }
    public function updateDisLike($model){

       
        if(isset($_POST['id_reponse'])){
            $like = new \Model\Reponse();
            $table=$this->getTable();
            $connexion = new \Database();
            $id_reponse = $_POST['id_reponse'];
            $sql="UPDATE `$table` SET `dislike_reponse` = :dislike_reponse WHERE `reponse`.`id_reponse` = $id_reponse";
            return $sql;
        } 
    }

    public function likeDao(){

        $like = new \Model\Reponse();
        $sql=$this->updateLike($like); 
        if (isset($_POST['like']) && $sql==true) {
            //on prépare la requête 
            if (isset($_POST['nb_like'])) {
                $nbLike=$_POST['nb_like'];
                echo $like->getLikeReponse();
                $connexion = new Database();
                $requete= $connexion->prepare($sql);
                $requete->execute([
                    ":like_reponse"=>$nbLike+1
                ]);
            }
       
        }

    }
    public function dislikeDao(){

        $like = new \Model\Reponse();
        $sql=$this->updateDisLike($like); 
        if (isset($_POST['dislike']) && $sql==true) {
            //on prépare la requête 
            if (isset($_POST['nb_dislike'])) {
                $nbDisLike=$_POST['nb_dislike'];
                echo $like->getLikeReponse();
                $connexion = new Database();
                $requete= $connexion->prepare($sql);
                $requete->execute([
                    ":dislike_reponse"=>$nbDisLike+1
                ]);
            }
       
        }

    }







}