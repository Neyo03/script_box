<?php

namespace Model;


class Vote{

    protected $id_utilisateur;
    protected $id_reponse; 
    protected $date_vote;
    protected $vote;






    /**
     * Get the value of date_vote
     */ 
    public function getDateVote()
    {
        return $this->date_vote;
    }

    /**
     * Set the value of date_vote
     *
     * @return  self
     */ 
    public function setDateVote($date_vote)
    {
        $this->date_vote = $date_vote;

        return $this;
    }

    /**
     * Get the value of vote
     */ 
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Set the value of vote
     *
     * @return  self
     */ 
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * Get the value of id_reponse
     */ 
    public function getIdReponse()
    {
        return $this->id_reponse;
    }

    /**
     * Set the value of id_reponse
     *
     * @return  self
     */ 
    public function setIdReponse($id_reponse)
    {
        $this->id_reponse = $id_reponse;

        return $this;
    }

    /**
     * Get the value of id_utilisateur
     */ 
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */ 
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }
}
    