<?php
session_start();
require_once '../model/creation.php';
require_once '../manager/manager.php';
if(isset($_POST["event"])) {
    try {
        $event = $_POST["event"];
        if(isset($_POST["etudiant"])) {
            $mail = $_POST["etudiant"];
        }
        if(isset($_POST["parent"])) {
            $mail = $_POST["parent"];
        }
        if(isset($_POST["prof"])) {
            $mail = $_POST["prof"];
        }
        $man = new manager();
        $man->addOrganisateur($event,$mail);
    } catch (Exception $e) {
        $_SESSION["erreurcasevide"] = $e->getMessage();
    }
}
?>