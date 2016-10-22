<?php

session_start();

unset($_SESSION['user']);
unset($_SESSION['email']);
unset($_SESSION['fname']);
unset($_SESSION['surname']);
unset($_SESSION['id']);

$_SESSION['flash'] = "You have sucessfully logged out";

header("Location:index.php");


