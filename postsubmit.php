<?php
session_start();

require __DIR__ . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" && ($_POST['postContent']) && ($_POST['chirpId']) && (isset($_SESSION['id']))) {
    $container = new Container($configuration);
    $PDO = $container->getPDO();               //get all containers ready
    $postRepo = new PostRepo($PDO);

    $post = new Post();
    $post->setContent($_POST['postContent']);         //set up post and send
    $post->setUserId($_SESSION['id']);
    $post->setChirpId($_POST['chirpId']);
    $postRepo->sendPostToDB($post);
    header('Location:index.php');               //redirect to index

}else{

    echo "error";
}
