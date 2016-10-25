<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="container">
<?php
    if (isset($_SESSION['id'])) {
    $logged = True;

        echo "
        
            <nav class=\"navbar navbar-default\">
        <div class=\"container-fluid\">
            <div class=\"navbar-header\">
                <a class=\"navbar-brand\" href=\"#\">ChirperBox</a>
            </div>
            <ul class=\"nav navbar-nav\">
                <li class=\"active\"><a href=\"#\">Home</a></li>
                <li><a href=\"logout.php\">logout</a></li>
                <li><a href=\"msgInbox.php\">inbox</a></li>
               <!--<li><a href=\"#\">Page 3</a></li> -->
            </ul>
        </div>
    </nav>
        logged in as " . $_SESSION['fname'] . " " . $_SESSION['surname'] . "<br>";
    echo '';
    echo '<br>';
    } else {
    header("Location:login.php");

    }?>


    <?php
    if (isset($_SESSION['flash'])) { ?>
        <div class="alert alert-success">
            <strong>Success!</strong> <?php echo $_SESSION['flash']; ?>
        </div>
        <?php
        unset($_SESSION['flash']);
    }



    ?>

</div>
</html>
