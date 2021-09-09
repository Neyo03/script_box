<?php

namespace Model;


class Message {

    protected $id_message;
    protected $texte;
    protected $date_message;
    protected $id_utilisateur;
    protected $id_conversation;

    


    public function afficherPseudo($id_messsage){
        $dao = new \Dao\UtilisateurDao();
        $listeUtilisateur = $dao->findPseudoByIdMessage($id_messsage);

        $model="";
        foreach ($listeUtilisateur as $utilisateur) {
            $model = $utilisateur;
        }
        return $model->getPseudo();
    }

    public function afficherProfilPicture($id_messsage){

        $dao = new \Dao\UtilisateurDao();
        $listeUtilisateur = $dao->findPseudoByIdMessage($id_messsage);
        $model="";
        foreach ($listeUtilisateur as $utilisateur) {
            $model = $utilisateur;
        }
        
        return $model->getPicture();
    }

    /**
     * Get the value of id_messsage
     */ 
    public function getIdMessage()
    {
        return $this->id_messsage;
    }

    /**
     * Set the value of id_messsage
     *
     * @return  self
     */ 
    public function setIdMessage($id_messsage)
    {
        $this->id_messsage = $id_messsage;

        return $this;
    }

    /**
     * Get the value of date_messsage
     */ 
    public function getDateMessage()
    {
        return $this->date_messsage;
    }

    /**
     * Set the value of date_messsage
     *
     * @return  self
     */ 
    public function setDateMessage($date_messsage)
    {
        $this->date_messsage = $date_messsage;

        return $this;
    }

    /**
     * Get the value of texte
     */ 
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set the value of texte
     *
     * @return  self
     */ 
    public function setTexte($texte)
    {
        $this->texte = $texte;

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

    /**
     * Get the value of id_conversation
     */ 
    public function getIdConversation()
    {
        return $this->id_conversation;
    }

    /**
     * Set the value of id_conversation
     *
     * @return  self
     */ 
    public function setIdConversation($id_conversation)
    {
        $this->id_conversation = $id_conversation;

        return $this;
    }
}