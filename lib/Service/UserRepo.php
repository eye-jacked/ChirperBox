<?php

class UserRepo{

    private $pdo;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    /**
     * @param $email
     * @return User
     */
    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM rst_users WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }

        return $this->createUserFromData($userData);
    }

    /**
     * @return User[]
     */
    public function getAllUsers()
    {
        $users = array();
        $usersData = $this->queryforUsers();


        foreach ($usersData as $userData) {
            $users[] = $this->createUserFromData($userData);
        }

        return $users;
    }

    private function queryforUsers(){

        $stmt = $this->getPDO()->prepare('SELECT * FROM rst_users');
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->createUserFromData($userData);
    }

public function saveUserToDb(){

    $stmt = $this->getPDO()->prepare('INSERT * FROM rst_users');
    $stmt->execute();

}

//TODO: SAVE USER TO DB
//
////TODO: GET USER BY ID
//
///TODO: SAVE USER TO DB


    private function createUserFromData(array $userData)
    {
        $user = new User($userData['id']);
        $user->setEmail($userData['email']);
        $user->setHash($userData['hash']);
        $user->setSurname($userData['surname']);
        $user->setFname($userData['fname']);
        return $user;
    }

}