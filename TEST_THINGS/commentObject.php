<?php
include_once('../php/connection.php'); //so that we can get the author of the comment.

class Comment
{
    private $_postid;
    private $_commentid;
    private $_userid;
    private $_username;
    private $_author; //full name basically
    private $_content;
    private $_likes;
    private $_dislikes;

    public function __construct($postid, $commentid, $userid, $content, $likes, $dislikes)
    {   
        $this->_postid = $postid;
        $this->_commentid = $commentid;
        $this->_userid = $userid;
        $this->_content = $content;
        $this->_likes = $likes;
        $this->_dislikes = $dislikes;
        //setAuthor(); //just learned php doesnt like userdefined functions UNLESS YOU CLAIM IT AS YOUR OWN OMG PHP SUCKS
        $this->setAuthor(); //gotta be super explicit jeez...
    }
    
    private function setAuthor()
    {
        $db = new Connection();
        $db = $db->dbConnect();
        $query = $db->prepare("SELECT * FROM users WHERE id = ?");
        $userID = $this->_userid;
        $query->bindparam(1, $userID);
        $query->execute();
        $this->_username = $query->fetch()['username'];
        $this->_author = $query->fetch()['fullname'];
    }

    public function getPostID()
    {
        return $this->_postid;
    }
    public function getCommentID()
    {
        return $this->_commentid;
    }
    public function getUserID()
    {
        return $this->_userid;
    }
    public function getContent()
    {
        return $this->_content;
    }
    public function getLikes()
    {
        return $this->_likes;
    }
    public function getDislikes()
    {
        return $this->_dislikes;
    }
    public function getUsername()
    {
        return $this->_username;
    }
    public function getAuthor()
    {
        return $this->_author;
    }

    public function toJSON() //this doesnt actually return a json. But it returns an object that is primed to be a JSON
    {
        $json;
        $json->postid = $this->_postid;
        $json->commentid = $this->_commentid;
        $json->userid = $this->_userid;
        $json->content = $this->_content;
        $json->likes = $this->_likes;
        $json->dislikes = $this->_dislikes;
        $json->username = $this->_username;
        $json->author = $this->_author;
        return json_encode($json);
    }
  

    public function getAll() //to bypass scoping
    {
        return get_object_vars($this);
    }

    public function toArray() //could be useful
    {
        $arr = array
        (
           "postid" => $this->_postid,
           "commentid" => $this->_commentid,
           "userid" => $this->_userid,
           "content" => $this->_content,
           "likes" => $this->_likes,
           "dislikes" => $this->_dislikes,
           "username" => $this->_username,
           "author" => $this->_author
        );
        return $arr;
    }
}
#I may have wasted my time making this class
?>
