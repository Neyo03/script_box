<?php

namespace Model;


class Conversation {

protected $id_conversation;
protected $nom_conversation;
protected $image_conversation;

public function afficherProfilPicture($id_conversation, $id_utilisateur){

    $dao = new \Dao\UtilisateurDao();
    $listeUtilisateur = $dao->findPseudoByIdConversation($id_conversation,$id_utilisateur);
    $model="";
    foreach ($listeUtilisateur as $utilisateur) {
        $model = $utilisateur;
    }
    return $model->getPicture();
}
public function afficherPseudo($id_conversation, $id_utilisateur){

    $dao = new \Dao\UtilisateurDao();
    $listeUtilisateur = $dao->findPseudoByIdConversation($id_conversation,$id_utilisateur);
    $model="";
    foreach ($listeUtilisateur as $utilisateur) {
        $model = $utilisateur;
    }
    return $model->getPseudo();
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

/**
 * Get the value of nom_conversation
 */ 
public function getNomConversation()
{
return $this->nom_conversation;
}

/**
 * Set the value of nom_conversation
 *
 * @return  self
 */ 
public function setNomConversation($nom_conversation)
{
$this->nom_conversation = $nom_conversation;

return $this;
}

/**
 * Get the value of image_conversation
 */ 
public function getImageConversation()
{
return $this->image_conversation;
}

/**
 * Set the value of image_conversation
 *
 * @return  self
 */ 
public function setImageConversation($image_conversation)
{
$this->image_conversation = $image_conversation;

return $this;
}
}
