<?php 
    # set.php is to prepare the SESSION and Cookies for use throughout the website.
    include_once('../php/connection.php');

    session_start();
    
    $type = $_POST['type']; 
    $command = $_POST['command'];

    $broker = new Broker($type);
    $agent = $broker->getAgent();
    // $attempt = new Getter();
    // $broker->performCommand($command);
    $agent->performCommand($command);
    // echo $agent->getData($command);
    
    class Broker //creates a getter or setter class
    {
        private $type;
        public function __construct($type)
        {
            $this->type = $type;
        }
        public function getAgent()
        {
            switch($this->type)
            {
                case "get":
                return new Getter();
                break;
                case "set":
                return new Setter();
                break;
            }
        }
    }

    class Getter
    {
        private $db;
        public function __construct() 
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect(); #being extremely explicit here just in case.      
        }
        public function performCommand($commandReceived)
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
                echo json_encode($posts);
                } else
                    echo "false";
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
                echo json_encode($posts);
                } else
                    echo "false";
            }
            else if($commandReceived==='getId') //we should rename this method one day. We're not getting the ID here, we're getting the full name            {
            {
                $query = $this->db->prepare("SELECT fullName FROM users WHERE id = ?"); #retrieves fullname and other info based on users
                $query->bindparam(1, $_SESSION['id']);
                $query->execute();
                $result = $query->fetch()['fullName'];
                echo $result;
            }
            else if($commandReceived==='getPostAuthor')
            {
                $authorID = $_POST['author_id'];
                $query = $this->db->prepare("SELECT username FROM users WHERE id = ?"); #retrieves fullname and other info based on users
                $query->bindparam(1, $authorID);
                $query->execute();
                $result = $query->fetch()['username'];
                echo $result;
            }
        }
    }
    function debug() {
            echo "<script>alert( 'Fake' );</script>";
        }
?>
