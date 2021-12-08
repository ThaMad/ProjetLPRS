<?php


//On appelle les classes
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/attentemanager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/model/rdv.php");
$manager = new attentemanager();

//on démarre une session
session_start();

//on déclare l'objet $rdv de type rdv

if (isset($_POST['idRdv'])) {
    try {
        $rdv = new rdv(['idRdv' => $_POST['idRdv'], 'compterendu' => $_POST['compterendu']
        ]);
        //on appelle la fonction ajoutProjet
        $manager->addCompteRendu($rdv);
} catch(Exception $e){
        $_SESSION["erreurcasevide"] = $e->getMessage();
    }
}

?>