<?php
session_start();
require __DIR__ . '/bootstrap.php';
include('includes/header.php');

$container= new Container($configuration);
$pdo = $container->getPDO();
$userRepo = new UserRepo($pdo);

?>
<h1>Message inbox</h1>
<h2>Send a message</h2>
<form method="POST" action="msgSubmit.php">
    Enter email here: <input type="text" name="email"/>
    Enter message here: <input type="text" name="msgContent"/>
    <input type="submit" value="send msg"/>

</form>

<br><br>

<?php

$msgRepo= $container->getMsgRepo($pdo);
$yourMessages = $msgRepo->getAllMessages($_SESSION['id']);

foreach($yourMessages as $message){
        echo $message->getSenderId();
        echo $message->getReceiverId();
        echo $message->getContent();
        echo "<lb>";

}

