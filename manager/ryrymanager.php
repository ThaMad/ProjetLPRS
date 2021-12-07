<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/ProjetLPRS/manager/manager.php");

class ryrymanager extends manager
{
    public function deleteLink($idLien){
        $db = parent::connexion_bdd();
        $delete=$db->prepare("DELETE FROM lien WHERE idLien = :idLien");
        $delete=$delete->execute(array('idLien'=>$idLien));
        if($delete != NULL){
            header('Location:/ProjetLPRS/view/profil/profil.php');
        }else{
            echo "erreur";
        }
    }

    public function addLien($lien){
        $db = parent::connexion_bdd();
        $add=$db->prepare("INSERT INTO lien (parent,eleve) VALUES (?,?)");
        $res= $add->execute(array(
            (int)$lien->getParent(),
            (int)$lien->getEleve(),
        ));

        if ($res==true){
            header("Location: /ProjetLPRS/view/profil/add_lien.php");
        }else{
            header("Location: /ProjetLPRS/view/profil/add_lien.php");
        }
    }
}