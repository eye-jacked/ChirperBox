<?php

class Post {

    private $id;
    private $userID;
    private $datetime;
    private $content;

    function getId() {
        return $this->id;
    }

    function getUserID() {
        return $this->userID;
    }

    function getDatetime() {
        return $this->datetime;
    }

    function getContent() {
        return $this->content;
    }

    function setUserID($userID) {
        $this->userID = $userID;
    }

    function setDatetime($datetime) {
        $this->datetime = $datetime;
    }

    function setContent($content) {
        $this->content = $content;
    }

    static public function loadUserByID(mysqli $connection, $id) {
        $query = "SELECT * FROM Chirps WHERE id=$id";
        $result = $connection->query($query);
        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->email = $row['email'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->timezone = $row['timezone'];
            return $loadedUser;
        }
        return null;
    }

}
