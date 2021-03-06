<?php
namespace Dao;
use Database;

class UtilisateurDao extends Dao{
    public function connexionDao($pseudo){
        $sql="SELECT *
            FROM utilisateur
            WHERE (pseudo = :pseudo OR email = :pseudo)";
            $connexion = new Database();
            $requete = $connexion->prepare($sql);
            $requete->execute([":pseudo" => $pseudo ]);
            $utilisateur =  $requete->fetch();
            if ($utilisateur) {
                return $this->arrayToModel($utilisateur);
            }
    }

    public function inscriptionDao($nomUser,$prenomUser,$pseudoUser,$emailUser,$mdpUser){
        $utilisateur = new \Model\Utilisateur();
        $sql=$this->create($utilisateur);
            
        //on prépare la requête 
        $connexion = new Database();
        $requete= $connexion->prepare($sql);
        $requete->execute([
            ":nom"=> $nomUser, 
            ":prenom"=> $prenomUser,
            ":pseudo"=>$pseudoUser,
            ":email"=>$emailUser,
            ":password"=>password_hash( $mdpUser, PASSWORD_DEFAULT),
            ":id_utilisateur"=>NULL,
            ":admin"=>0,
            ":picture"=>"user.png",
            ":biographie"=>""
            
        ]);
    }


    public function verifyDoubleDao($pseudo, $email,$password){

        $sql="SELECT *
                FROM utilisateur
                WHERE pseudo = :pseudo OR email = :email AND password = :password";
                $connexion = new Database();
                $requete = $connexion->prepare($sql);
                $requete->execute([":pseudo" => $pseudo, ":email"=> $email, ":password"=> $password  ]);
                $utilisateurs =  $requete->fetchAll();

                if ($utilisateurs) {
                    foreach($utilisateurs as $user){
                        if ($user['pseudo'] == $_POST['pseudoUtilisateur']) {
                        ?>
                            <div class="blocWrongMsg"> 
                        <?php
                            echo "<p>Pseudo déjà utilisé</p>";
                        ?>
                            </div>
                        <?php
                            
                        }
                        if ($user['email'] == $_POST['emailUtilisateur']) {
                            ?>
                            <div class="blocWrongMsg"> 
                        <?php
                            echo "<p>Email déjà utilisé</p>";
                        ?>
                            </div>
                        <?php
                         }
                    }
                    return $this->arrayToModel($utilisateurs);
                }
    }
    public function findUtilisateur($pseudo){
        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM ".$table." INNER JOIN commentaire USING(id_utilisateur) WHERE pseudo ='$pseudo'");
        $req->execute();
        $result = $req->fetch();
        return $result ? $this->arrayToModel($result) : false;

    }
    public function findPseudoByIdCommentaire($id_commentaire){

        $table=$this->getTable();

        $connexion = new \Database();
        
        $req = $connexion->prepare("SELECT * FROM ".$table." LEFT JOIN commentaire USING(id_utilisateur) WHERE id_commentaire = $id_commentaire");
        $req->execute();
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($table);
        $allModel=[];

        foreach ($result as $ligneResultat) {
            $model = $this->arrayToModel($ligneResultat);
            $allModel[]= $model;
        }  

        return $allModel;

    }
    
    public function findPseudoByIdReponse($id_reponse){

        $table=$this->getTable();

        $connexion = new \Database();
        
        $req = $connexion->prepare("SELECT * FROM ".$table." INNER JOIN reponse USING(id_utilisateur) WHERE id_reponse = $id_reponse");
        $req->execute();
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($table);
        $allModel=[];

        foreach ($result as $ligneResultat) {
            $model = $this->arrayToModel($ligneResultat);
            $allModel[]= $model;
        }  

        return $allModel;

    }
    public function findPseudoDestinataireByIdUtilisateur($id_utilisateur){

        $table=$this->getTable();
        $connexion = new \Database();
        
        $req = $connexion->prepare("SELECT * FROM ".$table." WHERE id_utilisateur = $id_utilisateur ");
        $req->execute();
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($table);
        $allModel=[];

        foreach ($result as $ligneResultat) {
            $model = $this->arrayToModel($ligneResultat);
            $allModel[]= $model;
        }  

        return $allModel;

    }
    

    public function updateUtilisateurCompte($pseudo,$biographie,$prenom,$nom,$picture,$id_utilisateur){

        $table=$this->getTable();
        $connexion = new \Database();
        $sql="UPDATE `$table` SET `nom` = :nom, `prenom` = :prenom , `biographie` = :biographie , `pseudo` = :pseudo, `picture` = :picture " ." WHERE `utilisateur`.id_utilisateur = $id_utilisateur "; 
        $requete= $connexion->prepare($sql);
        $requete->execute([
            ":nom"=> $nom, 
            ":prenom"=> $prenom,
            ":pseudo"=>$pseudo,
            ":biographie"=>$biographie,
            ":picture"=>$picture
            
        ]);
        

    }
    public function findPseudoByIdMessage($id_message){

        $table=$this->getTable();

        $connexion = new \Database();
        
        $req = $connexion->prepare("SELECT * FROM ".$table." INNER JOIN message USING(id_utilisateur) WHERE id_message = ?");
        $req->execute([$id_message]);
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($table);
        $allModel=[];

        foreach ($result as $ligneResultat) {
            $model = $this->arrayToModel($ligneResultat);
            $allModel[]= $model;
        }  

        return $allModel;

    }
    public function findPseudoByIdConversation($id_conversation, $id_utilisateur=""){

        $table=$this->getTable();
        $connexion = new \Database();
        if ($id_utilisateur!="") {
            $req = $connexion->prepare("SELECT * FROM ".$table." INNER JOIN participant USING(id_utilisateur) WHERE id_conversation = ? AND id_utilisateur != ?");
            $req->execute([$id_conversation, $id_utilisateur]);
        }
        else {
            $req = $connexion->prepare("SELECT * FROM ".$table." INNER JOIN participant USING(id_utilisateur) WHERE id_conversation = ?");
            $req->execute([$id_conversation]);
        }
        
        $result = $req->fetchAll();
        $model_class_name = "Model\\".ucfirst($table);
        $allModel=[];
        foreach ($result as $ligneResultat) {
            $model = $this->arrayToModel($ligneResultat);
            $allModel[]= $model;
        }  
        return $allModel;

    }
    public function utilisateurExist($id_utilisateur){
        $table=$this->getTable();
        $connexion = new \Database();
        $req = $connexion->prepare("SELECT * FROM ".$table." WHERE id_utilisateur =?");
        $req->execute([$id_utilisateur]);
        $result = $req->fetch();
        return $result;
    }

    
    

    
    
}