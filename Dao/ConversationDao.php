<?php
namespace Dao;
use Database;

class ConversationDao extends Dao{

    public function findConversationByIdUtilisateur($id_utilisateur){

            $table=$this->getTable();
            $utilisateur = new UtilisateurDao();
            $connexion = new \Database();
            $req = $connexion->prepare("SELECT * FROM ".$table." INNER JOIN participant USING(id_conversation) WHERE id_utilisateur = ? ORDER BY id_conversation DESC ");
            $req->execute([
                $id_utilisateur
            ]);
            $result = $req->fetchAll();
            $model_class_name = "Model\\".ucfirst($table);
            $allModel=[];
    
            foreach ($result as $ligneResultat) {
                $model = $this->arrayToModel($ligneResultat);
                $allModel[]= $model;
            }  
          
            return $allModel;
    }
    public function findConversationByIdConversation($id_conversation){

        $table=$this->getTable();
        $utilisateur = new UtilisateurDao();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM ".$table." INNER JOIN participant USING(id_conversation) WHERE id_conversation = ?");
        $req->execute([
            $id_conversation
        ]);
        $result = $req->fetch();
        return $result ? $this->arrayToModel($result) : false;

        foreach ($result as $ligneResultat) {
            $model = $this->arrayToModel($ligneResultat);
            $allModel[]= $model;
        }  
      
        return $allModel;
    }

    public function verifConversationExist($id_utilisateur, $id_destinataire=""){

        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM participant WHERE id_utilisateur = ?");
        $req->execute([
            $id_utilisateur
        ]);
        $result = $req->fetchAll();
        
        if ($result) {
            foreach ($result as $key) {
                $req1 = $connexion->prepare("SELECT * FROM participant WHERE id_conversation = ? AND id_utilisateur = ? ");
                $req1->execute(
                    [
                        $key['id_conversation'],
                        $_SESSION['idSession']

                    ]
                );
                $result = $req1->fetch();     
            }
            
        }
        
        return $result;
    }

    public function createConversation($id_conversation){
        
        $post = new \Model\Conversation();
        $sql=$this->create($post);  
        //on prépare la requête 
        $connexion = new Database();
        $requete= $connexion->prepare($sql);
        $requete->execute([
            ":image_conversation" =>"",
            ":nom_conversation" => "",
            ":id_conversation" =>$id_conversation
        ]);  
        
        

    }
    public function verifyDoubleConversation($id_conversation){
        $table=$this->getTable();
        $sql="SELECT *
                FROM ". $table ." WHERE id_conversation = ?";

                $connexion = new Database();
                $requete = $connexion->prepare($sql);
                $requete->execute([$id_conversation]);
                $conversation = $requete->fetch();
                return $conversation;
            
            
    }
    











}