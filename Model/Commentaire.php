<?php

namespace Model;


class Commentaire {


    protected $id_commentaire;
    protected $titre;
    protected $contenu;
    protected $image;
    protected $id_tag;
    protected $id_utilisateur;

    public function getPseudo($id_commentaire){
        $model = new Utilisateur();
        $dao = new \Dao\UtilisateurDao();
        $listeUtilisateur = $dao->findPseudoByIdCommentaire($id_commentaire);
        $model="";
        foreach ($listeUtilisateur as $utilisateur) {
            $model = $utilisateur;
        }
        return $utilisateur->getPseudo();
    }
    public function getProfilPicture($id_commentaire){
        $model = new Utilisateur();
        $dao = new \Dao\UtilisateurDao();
        $listeUtilisateur = $dao->findPseudoByIdCommentaire($id_commentaire);
        $model="";
        foreach ($listeUtilisateur as $utilisateur) {
            $model = $utilisateur;
        }
        return $utilisateur->getPicture();
    }
    public function getCount($id_commentaire){

        $dao = new \Dao\ReponseDao();
    
        $countReponse = $dao->countReponseByCommentaire($id_commentaire);
        
        return  $countReponse[0];
    
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
     * Get the value of id_tag
     */ 
    public function getIdTag()
    {
        return $this->id_tag;
    }

    /**
     * Set the value of id_tag
     *
     * @return  self
     */ 
    public function setIdTag($id_tag)
    {
        $this->id_tag = $id_tag;

        return $this;
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
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

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
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
    