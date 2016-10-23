<?php
if(isset($_SESSION['flash'])){
    echo $_SESSION['flash']."<br>";
    unset($_SESSION['flash']);
}


if (isset($_SESSION['id'])) {
    $logged= True;
    echo "logged in as ".$_SESSION['fname']." ".$_SESSION['surname']."<br>";
    echo '<a href="logout.php">logout</a><br>';
} else {
    header("Location:login.php");

}
