<?php

class Comment{
    
    private $id;
    private $user_id;
    private $tweet_id;
    private $content;
        
    
    function getId() {
        return $this->id;
    }

    function getUser_id() {
        return $this->user_id;
    }

    function getTweet_id() {
        return $this->tweet_id;
    }

    function getContent() {
        return $this->content;
    }


    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setTweet_id($tweet_id) {
        $this->tweet_id = $tweet_id;
    }

    function setContent($content) {
        $this->content = $content;
    }

 
    
}