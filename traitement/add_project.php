<?php


//On appelle les classes
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/attentemanager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/model/projeted.php");
$manager = new attentemanager();
//on démarre une session
session_start();
//on déclare l'objet $projet de type projeted
$projet = new projeted(['libelle' => $_POST['libelle'],
    'cours' => $_POST['cours'],
    'classe'=> $_POST['classe'],
    'prof' => $_POST['profid'],
    'date' => $_POST['date'],]);
//on appelle la fonction ajoutProjet
$manager->ajoutProjet($projet);


?>