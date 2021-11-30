<?php

session_start(); //on démarre une session
//On appelle les classes
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/manager/attentemanager.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/model/projeted.php");
$manager = new attentemanager();


$idProjet = $_GET['idProjet'];


$manager->suppressionProjet($idProjet);

?>