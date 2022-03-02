<?php
require_once '../model/evenement.php';
require_once '../manager/manager.php';

if (isset($_POST["deletePart"])) {
    try {
        $mail = $_SESSION['mail'];
        $event = new evenement(array(
            'libelle' => $_POST["deletePart"],
    ));
        $man = new manager();
        $man->annulePart($event,$mail);
    } catch (Exception $e) {
        $_SESSION["erreurcasevide"] = $e->getMessage();
    }
}
?>