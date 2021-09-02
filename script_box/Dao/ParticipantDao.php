<?php
namespace Dao;
use Database;

class ParticipantDao extends Dao{

    public function addParticipant($listeParticipants,$id_conversation){
        foreach ($listeParticipants as $participant) {
            $post = new \Model\Participant();
            $sql=$this->create($post);  
            //on prépare la requête 
            $connexion = new Database();
            $requete= $connexion->prepare($sql);
            $requete->execute([
                ":id_utilisateur" =>$participant,
                ":id_conversation" => $id_conversation,
            ]); 
        }  
    }
    public function utilisateurExistInConversation($id_conversation, $id_utilisateur){
        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM ".$table." WHERE id_conversation =? AND id_utilisateur = ?");
        $req->execute([$id_conversation,$id_utilisateur]);
        $result = $req->fetch();
        return $result;
    }


}