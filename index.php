<?php
session_start();
require __DIR__ . '/bootstrap.php';
include('includes/header.php');

if (isset($_SESSION['id'])) { ?>

    Welcome to your homepage

    <!--    post a new chirp-->
    <form method="post" action="chirpsubmit.php">
        <input type="text" name="chirpContent">
        <input type="submit" value="Chirp!">
    </form>

    <?php
//instantiate container, display recent tweets

    $container = new Container($configuration);
    $container->getPDO();
    $chirpRepo = $container->getChirpRepo();
    $recentChirps = $chirpRepo->getChirpsByUserId($_SESSION['id']);

    foreach ($recentChirps as $chirp) {
        echo $chirp->getContent();
        echo "HTML FORMATTING FOR MAKING COMMENTS LOOK NICE";
        $postRepo = $container->getPostRepo();
        $posts = $postRepo->getPostsByChirpId($chirp->Id);

        foreach($posts as $post){
            echo $post->getContent();
            echo "<br>";
        }

    }
}
