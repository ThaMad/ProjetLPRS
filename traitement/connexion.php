<?php
require_once '../model/user.php';
require_once '../manager/manager.php';

if(isset($_POST["mail"])) {
    try {
        $user = new user(array(
            "mail" => $_POST["mail"],
            "mdp" => $_POST['mdp']
        ));
        $man = new manager();
        $man->connexion($user);
    } catch (Exception $e) {
        $_SESSION["erreurcasevide"] = $e->getMessage();
    }
}
?>