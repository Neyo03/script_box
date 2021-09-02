<?php
namespace Dao;
use Database;

class MessageDao extends Dao{
    public function findMessageByIdConversation($id_conversation){

        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM ". $table ." WHERE id_conversation = ? ORDER BY date_message DESC ");
        $req->execute([
            $id_conversation
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
    public function envoyerMessage($message, $id_utilisateur, $id_conversation){
        $post = new \Model\Message();
        $sql=$this->create($post);  
        //on prépare la requête 
        $connexion = new Database();
        $requete= $connexion->prepare($sql);
        $requete->execute([
            ":id_message" =>NULL,
            ":texte" => $message,
            ":id_conversation" =>$id_conversation,
            "date_message"=>date('Y-m-d H:i:s'),
            "id_utilisateur"=>$id_utilisateur
        ]);  

    }
    
}