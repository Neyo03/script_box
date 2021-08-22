<?php
namespace Dao;
use Database;

class MessagerieDao extends Dao{


    public function findMessageDestinataire($id_utilisateur, $id_destinataire){

        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT  * FROM ".$table." INNER JOIN utilisateur USING (id_utilisateur) WHERE (id_utilisateur = $id_utilisateur AND id_destinataire = $id_destinataire) OR (id_utilisateur =$id_destinataire  AND id_destinataire = $id_utilisateur)  ORDER BY date_messagerie ASC ");
        $req->execute();
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($this->getTable());

        $allModel=[];


        foreach ($result as $ligneResultat) {

            $model = $this->arrayToModel($ligneResultat);
            // On ajoute les produit à la liste des produits 
            $allModel[]= $model;

        }
        return $allModel;

    }
     
    public function findDestinataireByIdUtilisateur($id_utilisateur){


        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT DISTINCT * FROM ".$table." INNER JOIN utilisateur USING (id_utilisateur) WHERE id_utilisateur = $id_utilisateur GROUP BY id_destinataire ORDER BY date_messagerie DESC");
        $req->execute();
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($this->getTable());
        $allModel=[];
        foreach ($result as $ligneResultat) {

            $model = $this->arrayToModel($ligneResultat);
            // On ajoute les produit à la liste des produits 
            $allModel[]= $model;

        }
        return $allModel;

    }

    public function findPseudoDestinataire($id_destinataire){

        $utilisateur = new UtilisateurDao();
        $connexion = new \Database();
        
        $req = $connexion->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = $id_destinataire ");
        $req->execute();
        $result = $req->fetch();
        return $result ? $this->arrayToModel($result) : false;


    }

    public function repondreMessage($texte,$id_utilisateur,$id_destinataire){

        $messagerie = new \Model\Messagerie();
        $sql=$this->create($messagerie);
        
            
        //on prépare la requête 
        $connexion = new Database();
        $requete= $connexion->prepare($sql);
        $requete->execute([
            ":texte"=>$texte, 
            ":id_utilisateur"=>$id_utilisateur,
            ":id_destinataire"=>$id_destinataire,
            ":date_messagerie"=>date('Y-m-d H:i:s'),
            "id_messagerie"=>NULL
            
        ]);
       




    }







}