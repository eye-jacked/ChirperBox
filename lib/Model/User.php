<?php

class User
{

    const TABLE_NAME = "rst_users";

    private $id;
    private $email;
    private $fname;
    private $surname;
    private $hash;


    public function __construct($id = -1)
    {
        $this->id = $id;
        $this->email = "";;
        $this->hash = "";
        $this->fname = "";
        $this->surname = "";

    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function setHash($pass)
    {
        if ($this->id == -1) {
            $options = ['cost' => 4, 'salt' => mcrypt_create_iv(22, MCRYPT_RAND)];
            $hash = password_hash($pass, PASSWORD_BCRYPT, $options);
            $this->hash = $hash;
        } else {
            $this->hash = $pass;
        }

    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }


    //still need to improve the datetime thing in the whole code
    public function createPost($content)
    {
        if ($this->id != -1) {
            $post = new Post($this->id, date("YYYY-MM-DD hh:mm:ss"), $content);
            return $post;
        } else {
            echo "<br>ERROR - SAVE USER TO DATABASE<br>";
            return FALSE;
        }
    }

    public function sendMessage($receiverID, $content)
    {

    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }


}
