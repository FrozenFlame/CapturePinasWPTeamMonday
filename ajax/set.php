<?php 
    # set.php is to prepare the SESSION and Cookies for use throughout the website.
    include_once('../php/connection.php');

    session_start();
    
    
    $command = $_POST['passed'];

    $attempt = new Getter();
    echo $attempt->getData($command);

    class Getter
    {
        private $db;
        private $successful;
        public function __construct() 
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect(); #being extremely explicit here just in case.      
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
