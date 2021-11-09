<?php
session_start();
require_once '../model/creation.php';
require_once '../manager/manager.php';
if(isset($_POST["event"])) {
    try {
        $event = $_POST["event"];
        $mail = $_SESSION['mail'];
        $man = new manager();
        $man->participerEvent($event,$mail);
    } catch (Exception $e) {
        $_SESSION["erreurcasevide"] = $e->getMessage();
    }
}
?>