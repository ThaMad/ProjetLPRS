<?php
require_once '../model/user.php';
require_once '../manager/manager.php';

if(isset($_POST["mail"])) {
    try {
        $user = new user(array(
            'nom' => $_POST["nom"],
            'prenom' => $_POST["prenom"],
            'mail' => $_POST["mail"],
            'profil' => $_POST["profil"],
            'classe'=> $_POST['classe']
            ));
        $man = new manager();
        $man->modificationProfil($user);
    } catch (Exception $e) {
        $_SESSION["erreurcasevide"] = $e->getMessage();
    }
}
?>