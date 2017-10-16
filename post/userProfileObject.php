<?php
include_once('../php/connection.php'); //so that we can get the author of the comment.

class UserProfile
{
    private $_filepath;
    private $_userid;
    private $_bio;
    public function __construct($filepath,$bio)
    {   
        $this->_filepath = $filepath;
        $this->_bio = $bio;
    }
    public function getFilepath()
    {
        return $this->_filepath;
    }
    public function getBio()
    {
        return $this->_bio;
    }
    
    public function toArray() //could be useful
    {
        $arr = array
        (
            "filepath" => $this->_filepath,
            "bio" => $this->_bio
        );
        return $arr;
    }
}
?>