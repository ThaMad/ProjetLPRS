<?php
require_once '../model/conversation.php';
require_once '../manager/attentemanager.php';

if (isset ($_POST['message'])){
    try{
        $conversation = new conversation(array(
        'userA' => $_POST["userA"],
            'userB'=> $_POST["userB"],
            'message'=>$_POST["message"],
            'date'=>$now = date_create()->format('Y-m-d H:i:s')));
        $man = new attentemanager();
        $man->newConversation($conversation);


    } catch (Exception $e){
        echo $e->getMessage();
        header("Location: ../view/chatbox/chatbox.php");
    }

} else{
    header("Location: ../view/chatbox/chatbox.php");
}

?>