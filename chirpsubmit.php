<?php
session_start();

require __DIR__ . '/bootstrap.php';

include('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === "POST" && ($_POST['chirpContent']) && (isset($_SESSION['id']))) {
    $container = new Container($configuration);
    $PDO = $container->getPDO();               //get all containers ready
    $chirpRepo = new ChirpRepo($PDO);

    $chirp = new Chirp();
    $chirp->setContent($_POST['chirpContent']);         //set up chirp and send
    $chirp->setUserId($_SESSION['id']);
    $chirpRepo->sendChirpToDB($chirp);

    header('Location:index.php');               //redirect to index

}
