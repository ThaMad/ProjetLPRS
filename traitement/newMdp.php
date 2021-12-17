<?php
session_start();
require_once '../model/user.php';
require_once '../manager/manager.php';
if (isset($_POST["newMdp"])) {
    $mdp = $_POST['newMdp'];
    try {
        $user = new user(array(
            'mail' => $_SESSION["mailModif"],
            'mdp' => password_hash($_POST["newMdp"], PASSWORD_DEFAULT),
        ));
        $man = new manager();
        $man->newMdp($user, $mdp);

    } catch (Exception $e) {
        echo $e->getMessage();
        header("Location: ../index.php");
    }
}
?>