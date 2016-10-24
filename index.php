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
    $recentChirps = $chirpRepo->getAllChirps();

//    $userRepo = $container->getUserRepo();
//    $test = $userRepo->getUserByEmail("sallysue@gmail.com");
//    if($userRepo->getUserByEmail("sallysue@gmail.com")) {
//        var_dump($test);
//    }

    foreach ($recentChirps as $chirp) {
        echo $chirp->getContent();
        echo "<br>comments go here<br>";
        $postRepo = $container->getPostRepo();
        $posts = $postRepo->getPostsByChirpId($chirp->getId());

        foreach($posts as $post){
            echo $post->getContent();
            echo "<br>";
        }
        ?>
<!--        Post a new comment/post-->
        <form method="POST" action="postsubmit.php">
            <input type="text" value="post a comment!" name="postContent"/>
            <input type="hidden" name="chirpId" value="<?= $chirp->getId() ?>" />
            <input type="submit" value="post!"/>
        </form><br>




        <?php
    }
}
