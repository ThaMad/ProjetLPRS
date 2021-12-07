<?php
require_once '../model/user.php';
require_once '../manager/manager.php';
if (isset($_POST["mail"])) {
    $email = $_POST['mail'];
    try {
        $user = new user(array(
            'mail' => $_POST["mail"],
        ));
        $man = new manager();
        $man->mdpOublier($user);

    } catch (Exception $e) {
        echo $e->getMessage();
        header("Location: ../index.php");
    }
}
?>