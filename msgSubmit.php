<?php
session_start();

require __DIR__ . '/bootstrap.php';

include('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === "POST" && ($_POST['msgContent']) && ($_POST['msgContent']) && (isset($_SESSION['id']))) {
    $container = new Container($configuration);
    $PDO = $container->getPDO();               //get all containers ready
    $postRepo = new MsgRepo($PDO);
    $userRepo = $container->getUserRepo();
    $msgRepo= $container->getMsgRepo();

    $receiverEmail = $_POST['email'];           //check if email is correct
    $user = $userRepo->getUserByEmail($receiverEmail);

    if(!$user){
        $_SESSION['flash'] = "No user with that email found!".$receiverEmail;

    }else {
        $msg = new Msg();
        $msg->setContent($_POST['msgContent']);         //set up msg and send
        $msg->setSenderId($_SESSION['id']);
        $msg->setReceiverId($user->getId());
        $msgRepo->sendMsgToDb($msg);

        $_SESSION['flash'] = "You have sucessfully sent a message to ".$receiverEmail."!";
    }
}   header('Location:msgInbox.php');               //redirect to inbox