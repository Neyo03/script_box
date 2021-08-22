<?php

namespace Model;


class Messagerie {

    protected $id_messagerie;
    protected $id_destinataire;
    protected $texte;
    protected $date_messagerie;
    protected $id_utilisateur;



    public function afficherPseudo($id_utilisateur){
        $dao = new \Dao\UtilisateurDao();
        $listeUtilisateur = $dao->findPseudoDestinataireByIdUtilisateur($id_utilisateur);
        $model="";
        foreach ($listeUtilisateur as $utilisateur) {
            $model = $utilisateur;
        }
        return  $model->getPseudo();
    }
    public function afficherProfilPicture($id_utilisateur){
        $dao = new \Dao\UtilisateurDao();
        $listeUtilisateur = $dao->findPseudoDestinataireByIdUtilisateur($id_utilisateur);

        $model="";
        foreach ($listeUtilisateur as $utilisateur) {
            $model = $utilisateur;
        }
        return  $model->getPicture();
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
     * Get the value of date_messagerie
     */ 
    public function getDateMessagerie()
    {
        return $this->date_messagerie;
    }

    /**
     * Set the value of date_messagerie
     *
     * @return  self
     */ 
    public function setDateMessagerie($date_messagerie)
    {
        $this->date_messagerie = $date_messagerie;

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
     * Get the value of id_destinataire
     */ 
    public function getIdDestinataire()
    {
        return $this->id_destinataire;
    }

    /**
     * Set the value of id_destinataire
     *
     * @return  self
     */ 
    public function setIdDestinataire($id_destinataire)
    {
        $this->id_destinataire = $id_destinataire;

        return $this;
    }

    /**
     * Get the value of id_messagerie
     */ 
    public function getIdMessagerie()
    {
        return $this->id_messagerie;
    }

    /**
     * Set the value of id_messagerie
     *
     * @return  self
     */ 
    public function setIdMessagerie($id_messagerie)
    {
        $this->id_messagerie = $id_messagerie;

        return $this;
    }
}