<?php
require_once '../model/evenement.php';
require_once '../manager/manager.php';

if (isset($_POST["deleteEvent"])) {
    try {
        $mail = $_SESSION['mail'];
        $event = new evenement(array(
            'libelle' => $_POST["deleteEvent"],
    ));
        $man = new manager();
        $man->annulePart($event,$mail);
    } catch (Exception $e) {
        $_SESSION["erreurcasevide"] = $e->getMessage();
    }
}
?>