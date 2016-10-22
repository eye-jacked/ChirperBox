<?php
session_start();

require __DIR__ . '/bootstrap.php';

include('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (!$_POST['email'] || !$_POST['fname'] || !$_POST['surname'] || !$_POST['password1'] || !$_POST['password2']) {
        //not all fields are provided
        $_SESSION['flash'] = "Please enter all fields";
        header("Location:register.php");

    } elseif ($_POST['password1'] != $_POST['password1']) {
        //passwords do not match
        $_SESSION['flash'] = "Passwords do not match, please mind spelling";
        header("Location:index.php");

    } elseif ($_POST['password1'] == $_POST['password1']) {
        $container = new Container($configuration);
        $PDO = $container->getPDO();
        $userRepo = $container->getUserRepo();

        $newUser = new User();
        $newUser->setEmail($_POST['email']);
        $newUser->setFname($_POST['fname']);
        $newUser->setSurname($_POST['surname']);
        $newUser->setHash($_POST['password1']);

        $userRepo->addNewUser($newUser);

        $_SESSION['flash'] = "User ".$newUser->getFname()." ".$newUser->getSurname()." registered, please log in";
        header("Location:index.php");

    }

} else {
    echo '<form method="post" action="">
                  Email: <input type="text" name="email"><br>
                  Name: <input type="text" name="fname"><br>
                  Surname: <input type="text" name="surname"><br>
                   Password: <input type="password" name="password1"><br>
                  Repeat password: <input type="password" name="password2"><br>
                   <input type="submit" name="login" value="LOGIN">
        </form>
    ';


}



