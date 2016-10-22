<?php

$configuration = array(
    'db_dsn'  => 'mysql:host=localhost;dbname=Chirper',
    'db_user' => 'root',
    'db_pass' => 'CodersLab',
);

require_once __DIR__.'/lib/Service/Container.php';
require_once __DIR__.'/lib/Service/UserRepo.php';
require_once __DIR__.'/lib/Model/User.php';
