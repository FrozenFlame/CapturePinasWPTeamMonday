<?php
/*
    The purpose of database_dealer is for general database dealership. 
    that being: collection of content, posting of content, etc.
    all based on the $command given to it
*/
    include_once('../php/connection.php');
    
    session_start();

    $type = $_POST['type'];
    $command = $_POST['command'];

    $agent = new Getter();
    //$broker = new Broker($agent);
    //$broker->performCommand($type, $command);
    echo $agent->getData($command);
    class Broker
    {
        private $db; //public so other classes may use it easily
        private $agent;
        public function __construct($agent) //accepts variable to initialize database to.
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect();
            $this->agent = $agent;
        }
        
        public function performCommand($type, $command)
        {
            switch ($type)
            {
            case "set":
            $this->agent = new Setter($db);
            break;
            case "get":
            $this->agent = new Getter($db);
            break;
            }
        }
    }
    class Setter //job is to put things into the database
    {

    }
    class Getter //job is to take things from the database
    {
        private $db;
        public function __construct($db) 
        {
                $this->db = new Connection();
                $this->db = $this->db->dbConnect();
        }
        
        public function getData($commandReceived)
        {
            if($commandReceived==='getPostInfo')
            {        
                include_once('../post/postObject.php');
                $query = $this->db->prepare("SELECT * FROM post");
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                
                $posts = array();
                if($query->rowcount() != 0) 
                {
                    for($ctr = 0; $ctr < $query->rowcount() ; $ctr++)
                    {
                        $post = new Post
                        (
                            $result['postid'],
                            $result['userid'],
                            $result['title'],
                            $result['place'],
                            $result['description'],
                            $result['likes'],
                            $result['dislikes'],
                            $result['timestamp']
                        );
                        array_push($posts, $post->toArray());
                    }
                return json_encode($posts);
                } else
                    return "false";
            }
            else if($commandReceived==='getPostInfoTEMP')
            {        
                include_once('../post/postObject.php');
                $query = $this->db->prepare("SELECT * FROM post");
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                
                $posts = array();
                if($query->rowcount() != 0) 
                {
                    for($ctr = 0; $ctr < $query->rowcount() ; $ctr++)
                    {
                        $post = new Post
                        (
                            $result['postid'],
                            $result['userid'],
                            $result['title'],
                            $result['place'],
                            $result['description'],
                            $result['likes'],
                            $result['dislikes'],
                            $result['timestamp']
                        );
                        array_push($posts, $post->toArray());
                    }
                return json_encode($posts);
                } else
                    return "false";
            }
            else if($commandReceived==='getId') //we should rename this method one day. We're not getting the ID here, we're getting the full name            {
            {
                $query = $this->db->prepare("SELECT fullName FROM users WHERE id = ?"); #retrieves fullname and other info based on users
                $query->bindparam(1, $_SESSION['id']);
                $query->execute();
                $result = $query->fetch()['fullName'];
                return $result;
            }
            else if($commandReceived==='getPostAuthor')
            {
                $authorID = $_POST['author_id'];
                $query = $this->db->prepare("SELECT username FROM users WHERE id = ?"); #retrieves fullname and other info based on users
                $query->bindparam(1, $authorID);
                $query->execute();
                $result = $query->fetch()['username'];
                return $result;
            }
        }
    }
    function debug() {
            echo "<script>alert( 'Fake' );</script>";
        }
?>
