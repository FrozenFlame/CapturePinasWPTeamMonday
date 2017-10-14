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
    private $_username;
    //add: array of file paths for the pictures
    private $_filepathsL;
    public function __construct($postid, $userid, $title, $place, $description, $likes, $dislikes, $timestamp, $username)
    {   
        $this->_postid = $postid;
        $this->_userid = $userid;
        $this->_title = $title;
        $this->_place = $place;
        $this->_description = $description;
        $this->_likes = $likes;
        $this->_dislikes = $dislikes;
        $this->_timestamp = $timestamp;
        $this->_username = $username;
        $this->_filepathsL = array();
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
    
    /*
        @param {string} path - used to push item into $_filePathsL 
    */
    public function pushToPathList($path)
    {
        array_push($this->_filepathsL, $path);
    }

    public function toArray() //could be useful
    {
        $arr = array
        (
            "postid" => $this->_postid,
            "userid" => $this->_userid,
            "title" => $this->_title,
            "place" => $this->_place,
            "description" => $this->_description,
            "likes" => $this->_likes,
            "dislikes" => $this->_dislikes,
            "timestamp" => $this->_timestamp,
            "username" => $this->_username,
            "path" => $this->_filepathsL
        );
        return $arr;
    }
}
?>
