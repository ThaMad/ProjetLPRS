<?php
require_once '../model/messages.php';
require_once '../manager/attentemanager.php';

if (isset ($_POST['message'])){
    try{
        $messages = new messages(array(
        'userExp' => $_POST['userExp'],
            'userDest'=> $_POST['userDest'],
            'message'=>$_POST['message'],
            'date'=>$now = date_create()->format('Y-m-d H:i:s')));
        $man = new attentemanager();
        $man->newConversation($messages);


    } catch (Exception $e){
        echo $e->getMessage();
        header("Location: ../view/chatbox/chatbox.php");
    }

} else{
    header("Location: ../view/chatbox/chatbox.php");
}

?>