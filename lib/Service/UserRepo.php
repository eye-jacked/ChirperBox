<?php

class UserRepo
{

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

    private function queryforUsers()
    {

        $stmt = $this->getPDO()->prepare('SELECT * FROM rst_users');
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->createUserFromData($userData);
    }

    public function saveUserToDb()
    {

        $stmt = $this->getPDO()->prepare('INSERT * FROM rst_users');
        $stmt->execute();

    }


    public function addNewUser(User $user)
    {
        $stmt = $this->pdo->prepare('INSERT INTO rst_users (email,fname,surname,hash)
                                                         VALUES (:email,:fname,:surname,:hash);');

        $email = $user->getEmail();
        $fname = $user->getFname();
        $surname = $user->getSurname();
        $hash = $user->getHash();

        $stmt->bindParam(':email', $email , PDO::PARAM_STR);
        $stmt->bindParam(':fname', $fname , PDO::PARAM_STR);
        $stmt->bindParam(':surname',$surname , PDO::PARAM_STR);
        $stmt->bindParam(':hash', $hash , PDO::PARAM_STR);
        $stmt->execute();

    }


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