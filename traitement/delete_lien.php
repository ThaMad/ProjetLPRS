<?php

session_start(); //on démarre une session
//On appelle les classes
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/manager/ryrymanager.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ProjetLPRS/model/lien.php");
$manager = new ryrymanager();


$idLien = $_GET['idLien'];


$manager->deleteLink($idLien);

?>