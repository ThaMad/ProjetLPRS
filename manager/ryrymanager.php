<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/manager.php");

class ryrymanager extends manager
{
    public function deleteLink($idLien){
        $db = parent::connexion_bdd();
        $alix=$db->prepare("DELETE FROM lien WHERE idLien = :idLien");
        $alix=$alix->execute(array('idLien'=>$idLien));
        if($alix != NULL){
            header('Location:/ProjetLPRS/view/profil/profil.php');
        }else{
            echo "erreur";
        }
    }
}