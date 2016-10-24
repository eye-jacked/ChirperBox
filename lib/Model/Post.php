<?php

class Post {

    private $id;
    private $userId;
    private $chirpId;
    private $content;

    /**
     * Post constructor.
     * @param $id
     */
    public function __construct($id = -1)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getChirpId()
    {
        return $this->chirpId;
    }

    /**
     * @param mixed $chirpId
     */
    public function setChirpId($chirpId)
    {
        $this->chirpId = $chirpId;
    }


}
