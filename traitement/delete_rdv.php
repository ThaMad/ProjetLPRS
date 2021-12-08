<?php

session_start(); //on démarre une session
//On appelle les classes
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/manager/attentemanager.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/model/rdv.php");
$manager = new attentemanager();


$idRdv = $_GET['idRdv'];


$manager->suppressionCompteRendu($idRdv);

?>