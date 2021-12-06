<?php
require_once '../model/evenement.php';
require_once '../manager/manager.php';
if (isset($_POST["deleteEvent"])) {
    try {
        $event = new evenement(array(
            'libelle' => $_POST["deleteEvent"],
        ));
        $man = new manager();
        $man->annuleEvent($event);
    } catch (Exception $e) {
        $_SESSION["erreurcasevide"] = $e->getMessage();
    }
}

?>