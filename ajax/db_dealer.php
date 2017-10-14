<?php 
    # set.php is to prepare the SESSION and Cookies for use throughout the website.
    include_once('../php/connection.php');
    session_start();
    
    $type = $_POST['type']; 
    $command = $_POST['command'];
    $broker = new Broker($type);
    $agent = $broker->getAgent();
    $agent->performCommand($command);
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *       @author Denzel
 *      - Inner Classes -
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
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
                case "search":
                return new Searcher();
                break;
            }
        }
    }

    /**
        Responsible for getting database data
    */
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
                $query = $this->db->prepare("SELECT u.username, p.*, i.filepath FROM post p LEFT JOIN users u ON p.userid = u.id LEFT JOIN userinfo i ON u.id = i.id WHERE postid = ?");
                // SELECT u.username, p.*, i.filepath FROM post p LEFT JOIN users u ON p.userid = u.id LEFT JOIN userinfo i ON u.id = i.id 
                $postid = $_POST['postid'];
                $query->bindparam(1, $postid);
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
                            $result['timestamp'],
                            $result['username'],
                            $result['filepath']
                        );
                         /*adding of file paths*/
                        $query2 = $this->db->prepare("SELECT * FROM `postmedia` WHERE postid = ?");
                        $query2->bindparam(1, $result['postid']);
                        $query2->execute();
                        foreach($query2 as $result2)
                        {
                            // echo json_encode($result2[1]);
                            $post->pushToPathList($result2[1]);
                        }
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

    /**
        Responsible for pushing database data
    */
    class Setter
    {
        private $db;
        public function __construct() 
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect(); #being extremely explicit here just in case.      
        }
        public function performCommand($commandReceived)
        {
            if($commandReceived === "postComment")
            {
                // do placeholder things
                $commentJSON = $_POST['comment'];
                $comment = json_decode($commentJSON);
                $query = $this->db->prepare("INSERT INTO postcomments VALUES(?,NULL,?,?,0,0,NULL)");
                $query->bindparam(1, $comment->postid);
                $query->bindparam(2, $comment->userid);
                $query->bindparam(3, $comment->content);
                $query->execute(); #fingers crossed x
                
                $query2 = $this->db->prepare("SELECT filepath FROM userinfo WHERE id=?");
                $query2->bindparam(1,$_POST['userid']);
                $query2->execute();
                $result = $query2->fetch()['filepath'];
                echo $result;
            }
        }
    }

    /**
        Responsible for getting posts via search types
    */
    class Searcher
    {
        private $db;
        public function __construct() 
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect();     
        }
        public function performCommand($command)
        {
            switch($command)
            {
                #search function is for getting list of post
                case "search": 
                    $query = $_POST['query'];
                    #$sql = 
                    echo $query;
                break;
                
                //these are ther results for BASIC home (organized by post date)
                case "home": 
                    include_once('../post/postObject.php');
                    $query = $this->db->prepare("SELECT u.username, p.*, i.filepath FROM post p LEFT JOIN users u ON p.userid = u.id LEFT JOIN userinfo i ON u.id = i.id ORDER BY 'timestamp' LIMIT 4 OFFSET :off");
                    /*
                    "SELECT u.username, p.* FROM post p RIGHT JOIN users u ON p.userid = u.id WHERE postid = :postid");
                    $postid = $_POST['postid'];
                    $query->bindparam(':postid', $postid, PDO::PARAM_INT);
                    */
                    //"SELECT * FROM postcomments WHERE postid = :postid LIMIT :lim OFFSET :offset"
                    $offset = (int)$_POST['offset'];
                    $query->bindparam(':off', $offset, PDO::PARAM_INT);
                    $query->execute();
                    $posts = array();
                    if($query->rowcount() != 0) 
                    {
                        foreach($query as $result)
                        {
                            $post= new Post
                            (
                                $result['postid'],
                                $result['userid'],
                                $result['title'],
                                $result['place'],
                                $result['description'],
                                $result['likes'],
                                $result['dislikes'],
                                $result['timestamp'],
                                $result['username'],
                                $result['filepath'] //this is the path to their avatar
                            );
                            /*adding of file paths*/
                            $query2 = $this->db->prepare("SELECT * FROM `postmedia` WHERE postid = ?");
                            $query2->bindparam(1, $result['postid']);
                            $query2->execute();
                            foreach($query2 as $result2)
                            {
                                // echo json_encode($result2[1]);
                                $post->pushToPathList($result2[1]);
                            }
                            array_push($posts, $post->toArray());
                        }
                    echo json_encode($posts);
                    } else
                        echo "false";
                break;
            }
        }
    }
    function debug() 
    {
            echo "<script>alert( 'Fake' );</script>";
    }
?>