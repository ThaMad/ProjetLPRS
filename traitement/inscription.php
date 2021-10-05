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
            'mdp' => password_hash($_POST["mdp"], PASSWORD_DEFAULT),
        ));
        $man = new manager();
        $man->inscription($user);

    } catch (Exception $e) {
        echo $e->getMessage();
        header("Location: ../index.php");
    }
}else{
    $response = 'error';
    return $response;
}
?>
