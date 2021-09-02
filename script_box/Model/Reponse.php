<?php

namespace Model;


class Reponse{

    protected $id_reponse;
    protected $contenu;
    protected $id_utilisateur;
    protected $id_commentaire;
    protected $like_reponse;
    protected $dislike_reponse;


    public function afficherPseudo($id_reponse){
        $dao = new \Dao\UtilisateurDao();
        $listeUtilisateur = $dao->findPseudoByIdReponse($id_reponse);
        $model="";
        foreach ($listeUtilisateur as $utilisateur) {
            $model = $utilisateur;
        }
        return  $model->getPseudo();
    }
    public function afficherProfilPicture($id_reponse){
        $dao = new \Dao\UtilisateurDao();
        $listeUtilisateur = $dao->findPseudoByIdReponse($id_reponse);

        $model="";
        foreach ($listeUtilisateur as $utilisateur) {
            $model = $utilisateur;
        }
        return  $model->getPicture();
    }
    public function afficherLike($id_utilisateur, $id_reponse){

        $dao = new \Dao\VoteDao();
        $listeVote = $dao->findVote($id_utilisateur,$id_reponse);
        $model="";
        foreach ($listeVote as $vote) {
            $model = $vote;
        }
        
        return $model;
    }
    

    /**
     * Get the value of id_commentaire
     */ 
    public function getIdCommentaire()
    {
        return $this->id_commentaire;
    }

    /**
     * Set the value of id_commentaire
     *
     * @return  self
     */ 
    public function setIdCommentaire($id_commentaire)
    {
        $this->id_commentaire = $id_commentaire;

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
     * Get the value of contenu
     */ 
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     *
     * @return  self
     */ 
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

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
     * Get the value of like_reponse
     */ 
    public function getLikeReponse()
    {
        return $this->like_reponse;
    }

    /**
     * Set the value of like_reponse
     *
     * @return  self
     */ 
    public function setLikeReponse($like_reponse)
    {
        $this->like_reponse = $like_reponse;

        return $this;
    }

    /**
     * Get the value of dislike_reponse
     */ 
    public function getDislikeReponse()
    {
        return $this->dislike_reponse;
    }

    /**
     * Set the value of dislike_reponse
     *
     * @return  self
     */ 
    public function setDislikeReponse($dislike_reponse)
    {
        $this->dislike_reponse = $dislike_reponse;

        return $this;
    }
}