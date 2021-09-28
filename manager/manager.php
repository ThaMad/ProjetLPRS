<?php

class Manager{

    // Methode qui permet la connexion à la BDD
    function connexion_bdd()
    {
        //Informations database Hôte
        $env_host = "DB_HOST";
        putenv("$env_host=localhost:8889");

        //Informations database Name
        $env_name = "DB_NAME";
        putenv("$env_name=projet_lprs");

        //Informations database User
        $env_user = "DB_USER";
        putenv("$env_user=root");

        //Informations database Pass
        $env_pass = "DB_PASS";
        putenv("$env_pass=root");


        try
        {
            $bdd = new PDO( 'mysql:host='.getenv($env_host).';dbname='.getenv($env_name).';charset=utf8',getenv($env_user),getenv($env_pass));
        }
        catch(Exception $e)
        {
            die('ERREUR:'.$e->getMessage());
        }
        return $bdd;

}




}