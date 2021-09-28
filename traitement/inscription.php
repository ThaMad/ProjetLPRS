<?php
require_once '../model/user.php';
require_once '../manager/manager.php';

try {
    $a = new user(array(
        'nom' => $_POST["nom"],
        'prenom' => $_POST["prenom"],
        'mail' =>$_POST["mail"],
        'mdp' => password_hash($_POST['mdp'],PASSWORD_DEFAULT),
        'profil'=>$_POST['profil'],
    ));
    $man = new manager();

    $man->inscription($a);

} catch (Exception $e) {
    echo $e->getMessage();
    header("Location: ../index.php");
}
