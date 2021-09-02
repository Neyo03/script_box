<?php
namespace Dao;
use Database;

class VoteDao extends Dao{

    public function vote($id_reponse,$id_utilisateur,$vote){
    $vote_model = new \Model\Vote();
    $sql = $this->create($vote_model);
    $connexion = new Database();
    $requete= $connexion->prepare($sql);
    $requete->execute([
        ":id_reponse"=>$id_reponse,
        ":id_utilisateur"=>$id_utilisateur,
        ":date_vote"=>date('Y-m-d H:i:s'),
        ":vote"=>$vote,
    ]);
    }
    public function deleteLike($id_reponse, $id_utilisateur){
        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("DELETE FROM ".$table." WHERE id_reponse =:id_reponse AND id_utilisateur = :id_utilisateur");
        $req->execute(
        [
            ":id_reponse"=> $id_reponse,
            ":id_utilisateur"=>$id_utilisateur
        ]);
    }
    public function findVote($id_utilisateur,$id_reponse){

        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->query("SELECT * FROM ".$table." WHERE id_utilisateur = $id_utilisateur AND id_reponse= $id_reponse");
        $result = $req->fetchAll();
        return $result;


    }
}

