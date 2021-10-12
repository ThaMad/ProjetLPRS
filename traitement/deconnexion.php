<?php
require_once '../manager/manager.php';
try {
    $man = new manager();
    $man->deconnexion();
} catch (Exception $e) {
    echo $e->getMessage();
    header("Location: ../index.php");
}
