<?php
        
$db = 



try {
    $db= new pdo('mysql:dbname=Chirper;host=localhost','root','CodersLab');
    //var_dump($db);
}

catch(exception $e){
    //echo get message
    echo "an error has ocurred";
}

?>