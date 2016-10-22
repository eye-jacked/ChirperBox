<?php
if(isset($_SESSION['flash'])){
    echo $_SESSION['flash']."<br>";
    unset($_SESSION['flash']);
}


if (isset($_SESSION['user'])) {
    $logged= True;
    echo "logged in as ".$_SESSION['fname']." ".$_SESSION['surname']."<br>";
    echo '<a href="logout.php">logout</a><br>';
} else {
    $logged = False;
    echo '<a href="login.php">login</a><br>';
    echo '<a href="register.php">Register</a><br>';
}
