<?php

class Manager
{

    // Methode qui permet la connexion à la BDD
    public function connexion_bdd()
    {
        //Informations database Hôte
        $env_host = "localhost";
        putenv("$env_host=localhost");

        //Informations database Name
        $env_name = "DB_NAME";
        putenv("$env_name=projet_lprs");

        //Informations database User
        $env_user = "DB_USER";
        putenv("$env_user=root");

        //Informations database Pass
        $env_pass = "DB_PASS";
        putenv("$env_pass=");

        try {
            $bdd = new PDO('mysql:host=' . getenv($env_host) . ';dbname=' . getenv($env_name) . ';charset=utf8', getenv($env_user), getenv($env_pass));
        } catch (Exception $e) {
            die('ERREUR:' . $e->getMessage());
        }
        return $bdd;
    }

    public function inscription($user)
    {
        session_start();
        $bdd = self::connexion_bdd();
        $req = $bdd->prepare('SELECT * from user where mail=:mail ');
        $req->execute(array(
            'mail' => $user->getMail(),
        ));
        $res = $req->fetch();
        if ($res) {
            throw new Exception("Error utilisateur deja existant");
        }
        if ($user->getNom() != '' and $user->getPrenom() != '' and $user->getMail() != '' and $user->getProfil() != '' and $user->getMdp() != '' ) {
            $req = $bdd->prepare('INSERT INTO user(nom,prenom,mail,profil,mdp) values (:nom,:prenom,:mail,:profil,:mdp)');
            $req->execute(array(
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'mail' => $user->getMail(),
                'profil' => $user->getProfil(),
                'mdp' => $user->getMdp(),
            ));
            $res = $req->fetch();
            if ($res) {
                $_SESSION['mdp'] = $res['mdp'];

                return success;
            }
        } else {
            return error;
        }
    }
    public function connexion($user){
        session_start();
        $bdd = self::connexion_bdd();
        if($user->getMail() =='' and $user->getMdp() =='' ){
            throw new Exception("toutecasevide",1);
        }

        if($user->getMail() ==''){
            throw new Exception("uservide",1);
        }

        if($user->getMdp() ==''){
            throw new Exception("passwordvide",1);

        }
        $req =$bdd->prepare("SELECT mdp,mail,profil FROM user WHERE mail=:mail");
        $req->execute(array(
            'mail'=> $user->getMail()
        ));
        $res = $req->fetch();

        if(password_verify($user->getMdp(), $res['mdp']) && $res['profil']== 'admin'){
            $_SESSION['mailadmin'] = $res["mail"];
            header("Location: ../index.php");
            return success;
        }
        elseif(password_verify($user->getMdp(),$res['mdp']) && $res['profil']== 'parent'){
            $_SESSION['mailparent'] = $res["mail"];
            header("Location: ../index.php");
            return success;
        }
        elseif (password_verify($user->getMdp(),$res['mdp']) && $res['profil']== 'eleve'){
            $_SESSION['maileleve'] = $res["mail"];
            header("Location: ../index.php");
            return success;
        }
        else {
            throw new Exception("Error pendant la connexion",1);
            return error;
        }
    }


    public function deconnexion()
    {
        session_start();
        session_destroy();
        header("Location: ../index.php");
    }
}