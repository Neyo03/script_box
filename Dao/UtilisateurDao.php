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
            
        //on prépare le requête 
        $connexion = new Database();
        $requete= $connexion->prepare($sql);
        $requete->execute([
            ":nom"=> $nomUser, 
            ":prenom"=> $prenomUser,
            ":pseudo"=>$pseudoUser,
            ":email"=>$emailUser,
            ":password"=>password_hash( $mdpUser, PASSWORD_DEFAULT),
            ":id_utilisateur"=>NULL,
            ":admin"=>0
            
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

    
    
}