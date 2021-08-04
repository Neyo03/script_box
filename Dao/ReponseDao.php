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
    
    public function likeDao($id_reponse, $id_utilisateur){
        $dao = new VoteDao;
        $find = $dao->find($id_reponse,$id_utilisateur); 
        $like = $this->findById($_POST['id_reponse']); 
        if ($find && $find->getVote() && $find->getIdReponse()== $id_reponse ) {
            if ($find->getVote()=="1") {
                $dao->deleteLike($id_reponse,$id_utilisateur);
                $this->updateLike("-1");
            }
            else if($find->getVote()=="-1") {
                $dao->deleteLike($id_reponse,$id_utilisateur);
                $dao->vote($id_reponse, $id_utilisateur, '1');
                $this->updateLike("+1",$find); 

            }
            header("Refresh: 0"); 
            
        }
        else if ($find==false) {
            $dao->vote($id_reponse, $id_utilisateur, '1');
            $this->updateLike("+1");
        }
        header("Refresh: 0"); 
        
    }

    public function dislikeDao($id_reponse, $id_utilisateur){
        $dao = new VoteDao;
        $find = $dao->find($id_reponse,$id_utilisateur);
        $like = $this->findById($_POST['id_reponse']); 
        if ($find && $find->getVote() && $find->getIdReponse()== $id_reponse  ) {
            if ($find->getVote()=="-1") {
                $dao->deleteLike($id_reponse,$id_utilisateur);
                $this->updateDisLike("-1");  
            }
            else if ($find->getVote()=="1") {
                $dao->deleteLike($id_reponse,$id_utilisateur);
                $dao->vote($id_reponse, $id_utilisateur, '-1');
                $this->updateDisLike("+1", $find); 
            }
            header("Refresh: 0"); 
            
        }
        else if ($find==false) {
            $dao->vote($id_reponse, $id_utilisateur, '-1');
            $this->updateDisLike("+1");
   
        }  
        header("Refresh: 0"); 

    }

    public function updateCount(){






    }
    public function updateLike($operator, $bool=""){
        if(isset($_POST['id_reponse'])){
            $like = new \Model\Reponse();
            $table=$this->getTable();
            $connexion = new \Database();
            $id_reponse = $_POST['id_reponse'];
            $former_vote = "";
            if ($bool==true) {
                $former_vote = ", `dislike_reponse` = dislike_reponse-1";
            }
            $sql="UPDATE `$table` SET `like_reponse` = :like_reponse $former_vote WHERE `reponse`.`id_reponse` = $id_reponse";
            if (isset($_POST['like']) && $sql==true) {
                $nbLike=$_POST['nb_like'];
                $requete= $connexion->prepare($sql);
                if ($operator=="-1") {
                    $requete->execute([
                        ":like_reponse"=>$nbLike-1
                    ]);
                }
                else if($operator=="+1") {
                    $requete->execute([
                        ":like_reponse"=>$nbLike+1
                    ]);
                }
               
            }
        }
    } 
    
    public function updateDisLike($operator, $bool=""){
        if(isset($_POST['id_reponse'])){
            $like = new \Model\Reponse();
            $table=$this->getTable();
            $connexion = new \Database();
            $id_reponse = $_POST['id_reponse'];
            $former_vote = "";
            if ($bool==true) {
                $former_vote = ", `like_reponse` = like_reponse-1";
            }
            $sql="UPDATE `$table` SET `dislike_reponse` = :dislike_reponse $former_vote WHERE `reponse`.`id_reponse` = $id_reponse";
            if (isset($_POST['dislike']) && $sql==true) {
                $nbDisLike=$_POST['nb_dislike'];
                $requete= $connexion->prepare($sql);
                if ($operator=="-1") {
                    $requete->execute([
                        ":dislike_reponse"=>$nbDisLike-1
                    ]);
                }
                elseif ($operator=="+1") {
                    $requete->execute([
                        ":dislike_reponse"=>$nbDisLike+1
                    ]);
                }
                
            }
        } 
    }

  







}