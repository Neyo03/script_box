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
}