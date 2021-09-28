<?php

class Manager
{

    // Methode qui permet la connexion à la BDD
    function connexion_bdd()
    {
        //Informations database Hôte
        $env_host = "DB_HOST";
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

    public function inscription($a)
    {
        session_start();
        $req = connexion_bdd()->prepare('SELECT * from user where mail=:mail ');
        $req->execute(array(
            'mail' => $a->getMail(),
        ));
        $res = $req->fetch();
        if ($res) {
            throw new Exception("Error utilisateur deja existant");
        }
        if ($a->getNom() != '' and $a->getPrenom() != '' and $a->getMail() != '' and $a->getMdp() != '' and $a->getProfil() != "") {
            $this->dbh = new bdd();
            $req = $this->dbh->getBase()->prepare('INSERT INTO utilisateur(nom,prenom,date_naissance,adresse,mail,username,mdp) values (:nom,:prenom,:date_naissance,:adresse,:mail,:username,:mdp)');
            $req->execute(array(
                    'nom' => $a->getNom(),
                    'prenom' => $a->getPrenom(),
                    'mail' => $a->getMail(),
                    'mdp' => $a->getMdp(),
                    'profil' => $a->getProfil()
            ));
            $res = $req->fetch();

            if ($res) {
                $_SESSION['mdp'] = $res['mdp'];
            }
        } else {
            echo 'erreur un champ est vide';
            header('Location: ../vue/inscription.php');
        }
    }
}