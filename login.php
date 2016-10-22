<?php session_start();
require __DIR__ . '/bootstrap.php';
include('includes/header.php');

$container = new Container($configuration);

if (isset($_SESSION['user']))   // if logged in, redirect to home
{
    header("Location:index.php");
}

if (isset($_POST['login']))   // did user arrive by pressing login
{
    $userEmail = $_POST['user'];
    $pass = $_POST['pass'];

    $pdo = $container->getPDO();
    $userRepo = $container->getUserRepo();

    $user = $userRepo->getUserByEmail($userEmail);


    $hash = $user->getHash();
    $x = (password_verify($pass, $hash));

    if (password_verify($pass, $hash)) {

        $_SESSION['fname']=$user->getFname();
        $_SESSION['surname']=$user->getSurname();
        $_SESSION['email']=$user->getEmail();
        $_SESSION['id']=$user->getId();
        $_SESSION['flash'] = "You have been authenticated as".$user->getFname()." ".$user->getSurname();
        echo '<script type="text/javascript"> window.open("index.php","_self");</script>';            //  On Successfull Login redirects to index.php

    } else {
        echo "invalid UserName or Password";
    }
}
?>

<html>
<head>

    <title> Login Page </title>

</head>

<body>

<form action="" method="post">

    <table width="200" border="0">
        <tr>
            <td> Email</td>
            <td><input type="text" name="user"></td>
        </tr>
        <tr>
            <td> Password</td>
            <td><input type="password" name="pass"></td>
        </tr>
        <tr>
            <td><input type="submit" name="login" value="LOGIN"></td>
            <td></td>
        </tr>
    </table>
</form>

</body>
</html>