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


    foreach ($recentChirps as $chirp) {
        ?>

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-9">
                <h5><?php echo $chirp['fname'] . ' ' . $chirp['surname'] . ' chirped:'; ?></h5>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="well well-lg">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <h3><?php echo $chirp['content']; ?></h3>
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <?php
                $postRepo = $container->getPostRepo();
                $posts = $postRepo->getPostsByChirpId($chirp['id']);

                foreach ($posts as $post) {
                    //                var_dump($post);die;
                    ?>

                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div
                                class="col-md-9"><?php echo $post['fname'] . ' ' . $post['surname'] . '.posted:'; ?></div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-9"><?php echo $post['content']; ?></div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                <?php } ?>

                <!--        Post a new comment/post-->
                <div>
                    <div class="col-md-2"></div>
                    <div class="col-md-9">
                        <form method="POST" action="postsubmit.php">
                            <input type="text" value="post a comment!" name="postContent"/>
                            <input type="hidden" name="chirpId" value="<?php echo $chirp['id'] ?>"/>
                            <input type="submit" value="post!"/>
                        </form>
                        <br>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>

        <?php
    }
}
?>