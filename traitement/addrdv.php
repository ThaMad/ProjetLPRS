<?php


//On appelle les classes
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/attentemanager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/model/rdv.php");
$manager = new attentemanager();

//on démarre une session
session_start();
$datetime=$_POST['jour'].' '.$_POST['heure'].':00';

//on déclare l'objet $rdv de type rdv

$rdv = new rdv(['professeur' => $_POST['profid'],
    'parent' => $_POST['parentid'],
    'libelle'=>$_POST['libelle'],
    'horaire'=>$datetime
]);

//on appelle la fonction ajoutProjet
$manager->addRdv($rdv);


?>