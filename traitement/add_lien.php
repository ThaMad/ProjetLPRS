<?php


//On appelle les classes
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/ryrymanager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/model/lien.php");
$manager = new ryrymanager();

//on démarre une session
session_start();

//on déclare l'objet $projet de type projeted

$lien = new lien(['parent' => $_POST['parentid'],
   'eleve' => $_POST['idUser']
    ]);

//on appelle la fonction ajoutProjet
$manager->addLien($lien);


?>