<?php

/*
 * SETTINGS!
 */
$databaseName = 'Chirper';
$databaseUser = 'root';
$databasePassword = 'CodersLab';


/*
 * CREATE THE DATABASE
 */
$pdoDatabase = new PDO('mysql:host=localhost', $databaseUser, $databasePassword);
$pdoDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdoDatabase->exec('DROP DATABASE Chirper');
$pdoDatabase->exec('CREATE DATABASE IF NOT EXISTS Chirper');

/*
 * CREATE THE TABLE
 */
$pdo = new PDO('mysql:host=localhost;dbname=' . $databaseName, $databaseUser, $databasePassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// initialize the user table
$pdo->exec('CREATE TABLE rst_users (
 `id` INT(11) NOT NULL AUTO_INCREMENT,
 `email` VARCHAR(40) COLLATE utf8mb4_unicode_ci NOT NULL,
 `fname` VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
 `surname` VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
 `hash` CHAR(70) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

/*
 * INSERT SOME USER DATA
 */


$pass1 = 'hello';
$pass2 = 'sup';
$pass3 = 'cheeryo';
$pass4 = 'cornflakes';

$hashedPass1 = password_hash($pass1, PASSWORD_BCRYPT);
$hashedPass2 = password_hash($pass2, PASSWORD_BCRYPT);
$hashedPass3 = password_hash($pass3, PASSWORD_BCRYPT);
$hashedPass4 = password_hash($pass4, PASSWORD_BCRYPT);


$pdo->exec('INSERT INTO rst_users
    (email, fname, surname, hash) VALUES
    ("stuglikr@gmail.com", "Rob", "Stuglik", "' . $hashedPass1 . '")'); //pass :hello

$pdo->exec('INSERT INTO rst_users
    (email, fname, surname, hash) VALUES
    ("sallysue@gmail.com", "Sally", "Sue", "' . $hashedPass2 . '")');  //pass :sup

$pdo->exec('INSERT INTO rst_users
    (email, fname, surname, hash) VALUES
    ("jakeSnake@gmail.com", "Jake", "Snake", "' . $hashedPass3 . '")');  //pass :cheeryo

$pdo->exec('INSERT INTO rst_users
    (email, fname, surname, hash) VALUES
    ("barkerblue@gmail.com", "barker", "Blue", "' . $hashedPass4 . '")');  //pass :cornflakes


// initialize the chirp table
$pdo->exec('DROP TABLE IF EXISTS rst_chirps;');

$pdo->exec('CREATE TABLE rst_chirps (
     `id` INT(11) NOT NULL AUTO_INCREMENT,
     `rst_users_id` INT(11) NOT NULL,
     `content` VARCHAR(140) COLLATE utf8mb4_unicode_ci NOT NULL,
     PRIMARY KEY (`id`),
     FOREIGN KEY (rst_users_id) REFERENCES rst_users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');


// initialize the comment table
$pdo->exec('DROP TABLE IF EXISTS rst_posts;');

$pdo->exec('CREATE TABLE rst_posts (
     `id` INT(11) NOT NULL AUTO_INCREMENT,
     `rst_users_id` INT(11) NOT NULL,
     `rst_chirps_id` INT(11) NOT NULL,
     `content` VARCHAR(60) COLLATE utf8mb4_unicode_ci NOT NULL,
     PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

$pdo->exec('ALTER TABLE rst_posts
            ADD FOREIGN KEY (rst_users_id) REFERENCES rst_users(id)');

$pdo->exec('ALTER TABLE rst_posts
            ADD FOREIGN KEY (rst_chirps_id) REFERENCES rst_chirps(id)');


// initialize the msg table
$pdo->exec('DROP TABLE IF EXISTS rst_msgs;');

$pdo->exec('CREATE TABLE rst_msgs (
     `id` INT(11) NOT NULL AUTO_INCREMENT,
     `sender_rst_users_id` INT(11) NOT NULL,
     `receiver_rst_users_id` INT(11) NOT NULL,
     `text` VARCHAR(140) COLLATE utf8mb4_unicode_ci NOT NULL,
     PRIMARY KEY (`id`),
     FOREIGN KEY (sender_rst_users_id) REFERENCES rst_users(id),
     FOREIGN KEY (receiver_rst_users_id) REFERENCES rst_users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

echo "Ding!\n";