<?php
include_once('../php/connection.php'); //so that we can get the author of the comment.

class Post
{
    private $_postid;
    private $_userid;
    private $_title;
    private $_place;
    private $_description;
    private $_likes;
    private $_dislikes;
    private $_timestamp;

    public function __construct($postid, $userid, $title, $place, $description, $likes, $dislikes, $timestamp)
    {   
        $this->_postid = $postid;
        $this->_userid = $userid;
        $this->_title = $title;
        $this->_place = $place;
        $this->_description = $description;
        $this->_likes = $likes;
        $this->_dislikes = $dislikes;
        $this->_timestamp = $timestamp;
       
    }

    public function getPostID()
    {
        return $this->_postid;
    }
    public function getPlace()
    {
        return $this->_place;
    }
    public function getUserID()
    {
        return $this->_userid;
    }
    public function getTitle()
    {
        return $this->_title;
    }
    public function getLikes()
    {
        return $this->_likes;
    }
    public function getDislikes()
    {
        return $this->_dislikes;
    }
    public function getDescription()
    {
        return $this->_description;
    }
    public function getTimestamp()
    {
        return $this->_timestamp;
    }
?>
