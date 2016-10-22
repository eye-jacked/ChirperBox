<?php
session_start();

if (isset($_SESSION['user'])) {
    $logged= True;
    echo "logged in";
} else {
    $logged = False;
    echo '<a href="login.php">login required</a>';
}