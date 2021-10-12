<?php


//On appelle les classes
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/attentemanager.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/model/user.php");
$manager = new attentemanager();
//on démarre une session
session_start();
//on déclare l'objet $user de type etudiant
$user = new user(['nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'mail' => $_POST['mail'],
    'classe' => $_POST['classe'],
    'profil'=>$_POST['profil'] ]);
//on appelle la fonction ajoutEtudiant
$manager->ajoutUser($user);


?>