<?php

namespace Model;


class Participant {

    protected $id_utilisateur;
    protected $id_conversation;





    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */ 
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    /**
     * Get the value of id_conversation
     */ 
    public function getId_conversation()
    {
        return $this->id_conversation;
    }

    /**
     * Set the value of id_conversation
     *
     * @return  self
     */ 
    public function setId_conversation($id_conversation)
    {
        $this->id_conversation = $id_conversation;

        return $this;
    }
}