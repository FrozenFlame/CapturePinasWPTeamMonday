<?php
include_once('../php/connection.php'); //so that we can get the author of the comment.

class UserProfile
{
    private $_filepath;
    private $_userid;
    private $_bio;
    private $_fullname;
    public function __construct($filepath,$bio, $fullname)
    {   
        $this->_filepath = $filepath;
        $this->_bio = $bio;
        $this->_fullname = $fullname;
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
            "bio" => $this->_bio,
            "fullname" => $this->_fullname
        );
        return $arr;
    }
}
?>