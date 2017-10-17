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
 *       @author DD_
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
    *    Responsible for getting database data
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
                /**
                *   @author Jarvis
                */
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
            else if($commandReceived==='getUserProfile')
            {
                include_once('../post/userProfileObject.php');
                $query = $this->db->prepare("SELECT filepath,bio FROM userinfo WHERE id = ?");
                $query->bindparam(1, $_SESSION['id']);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $profile = new UserProfile($result['filepath'],$result['bio']);
                //$profile->toArray();
                echo json_encode($profile->toArray());
            }
            else if($commandReceived==='getUserProfileById')
            {
                include_once('../post/userProfileObject.php');
                $query = $this->db->prepare("SELECT i.filepath,i.bio,u.fullname FROM userinfo i LEFT JOIN users u ON u.id = i.id WHERE i.id = ?");
                $query->bindparam(1, $_POST['userid']);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $profile = new UserProfile($result['filepath'],$result['bio'],$result['fullname']);
                //$profile->toArray();
                echo json_encode($profile->toArray());
            }
            else if($commandReceived==='getPostAuthor')
            {
                $authorID = $_POST['author_id'];
                $query = $this->db->prepare("SELECT username FROM users WHERE id = ?"); 
                $query->bindparam(1, $authorID);
                $query->execute();
                $result = $query->fetch()['username'];
                echo $result;
            }
            else if($commandReceived==='getLastPostId')
            {
                $query = $this->db->prepare("SELECT postid FROM post ORDER BY postid DESC LIMIT 1");
                $query->execute();
                echo $query->fetch()['postid'];
            }
            else if($commandReceived==='getLastCommentId')
            {
                $query = $this->db->prepare("SELECT commentid FROM postcomments ORDER BY commentid DESC LIMIT 1 ");
                $query->execute();
                echo $query->fetch()['commentid'];
            }
            else if($commandReceived==='postOpinion') //dont confuse with actual posting
            {
                $query = $this->db->prepare("SELECT opinion FROM postopinion WHERE postid = ? AND userid = ?");
                $query->bindparam(1, $_POST['postid']);
                $query->bindparam(2, $_SESSION['id']);
                $query->execute();
                if($query->rowcount() > 0) //means user has given an opinion before
                    echo $query->fetch()['opinion'];
                else                        //means user hasn't given an opinion before
                    echo 'N';
            }
            else if($commandReceived==='commentOpinion') //withdrawing comment opinion from database (not to be confused with giving an opiniong by the Setter class!)
            {
                $query = $this->db->prepare("SELECT opinion FROM commentopinion WHERE commentid = ? AND userid = ?");
                $query->bindparam(1, $_POST['commentid']);
                $query->bindparam(2, $_SESSION['id']);
                $query->execute();
                if($query->rowcount() > 0) //means user has given an opinion before
                    echo $query->fetch()['opinion'];
                else                        //means user hasn't given an opinion before
                    echo 'N';
            }
            else if($commandReceived==='getLikeUser'){
                $query = $this->db->prepare("SELECT opinion FROM postopinion WHERE postid = ? AND userid = ?");
                $query->bindparam(1, $_POST['postid']);
                $query->bindparam(2, $_SESSION['id']);
                $query->execute();
                if($query->rowcount()==0){
                        echo 'N';
                } else {
                    echo $query->fetch()['opinion'];
            }
                    
            }
        }
    }

    /**
    *    Responsible for pushing database data
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
            if($commandReceived === 'postComment')
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
            else if($commandReceived === 'post') //post some content to CapturePinas!
            {
                /**
                *   @author DD_
                */
                //post columns are: postid, userid, title, place, description, likes, dislikes, favnum, timestamp
                $postJSON = $_POST['postJSON'];
                $post = json_decode($postJSON);
                $query = $this->db->prepare("INSERT INTO post VALUES(NULL, ?, ?, ?, ?, 0, 0, 0, NULL)");
                $query->bindparam(1, $post->userid);
                $query->bindparam(2, $post->title);
                $query->bindparam(3, $post->place);
                $query->bindparam(4, $post->description);
                $query->execute(); //holding trigger for now
                
                //now to add filepaths;
                //postmedia columns are: postid, filepath
                $queryid = $this->db->prepare("SELECT postid FROM post ORDER BY postid DESC LIMIT 1");
                $queryid->execute();
                $postid = $queryid->fetch()['postid'];
                $query2 = $this->db->prepare("INSERT INTO postmedia VALUES(?, ?)");
                $query2->bindparam(1, $postid);
                foreach($post->path as $filepath) //$post->path is an array
                {
                    $query2->bindparam(2, $filepath);
                    $query2->execute(); //holding trigger for now
                }                
            }
            else if($commandReceived === 'userAvatar')
            {
                $path = $_POST['path'];
                $query = $this->db->prepare("UPDATE userinfo SET filepath = ?  WHERE id = ?");
                $query->bindparam(1, $path);
                $query->bindparam(2, $_SESSION['id']);
                $query->execute();
            }
            else if($commandReceived === 'postOpinion')
            {
                /**
                *   @author DD_
                */
                //First time opinion checker
                $query = $this->db->prepare("SELECT opinion FROM postopinion WHERE postid = ? AND userid = ?");
                $query->bindparam(1, $_POST['postid']);
                $query->bindparam(2, $_SESSION['id']);
                $query->execute();
                if($query->rowcount() == 0) //means user is giving opinion for the first time
                {
                    $query2 = $this->db->prepare("INSERT INTO postopinion VALUES(?,?,?)");
                    $query2->bindparam(1, $_POST['postid']);
                    $query2->bindparam(2, $_SESSION['id']);
                    $query2->bindparam(3, $_POST['opinion']);
                    $query2->execute();

                    //updates values found in postcomment like/dislike counter
                    //it's also nice that this is so embedded in the backend service, it'll make it harder for attackers to mess our things up by means of inspect element
                    if($_POST['opinion'] == 'L') //user liked
                    {
                        $query3 = $this->db->prepare("UPDATE post SET likes = likes + 1 WHERE postid = ?");
                        $query3->bindparam(1, $_POST['postid']);
                        $query3->execute();
                    }
                    else //user disliked
                    {
                        $query3 = $this->db->prepare("UPDATE post SET dislikes = dislikes + 1 WHERE postid = ?");
                        $query3->bindparam(1, $_POST['postid']);
                        $query3->execute();
                    }
                }
                else
                {
                    $previousOpinion = $query->fetch()['opinion']; //gets the user's opinion before the change
                    $query2 = $this->db->prepare("UPDATE postopinion SET opinion = ? WHERE postid = ? AND userid = ?");
                    $query2->bindparam(1, $_POST['opinion']);
                    $query2->bindparam(2, $_POST['postid']);
                    $query2->bindparam(3, $_SESSION['id']);
                    $query2->execute();
                    
                    switch($_POST['opinion']) //this is the current opinion casted
                    {
                        case 'N': //they are now neutral
                            if($previousOpinion == 'L') //they liked it before
                            {
                                $query3 = $this->db->prepare("UPDATE post SET likes = likes - 1 WHERE postid = ?"); //-1 from likes
                                $query3->bindparam(1, $_POST['postid']);
                                $query3->execute();
                            }
                            else //they disliked it before
                            {
                                $query3 = $this->db->prepare("UPDATE post SET dislikes = dislikes - 1 WHERE postid = ?"); //-1 from dislikes
                                $query3->bindparam(1, $_POST['postid']);
                                $query3->execute();
                            }
                        break;
                        case 'L': //they are now Liking it
                            if($previousOpinion == 'N') //they were neutral before
                            {
                                $query3 = $this->db->prepare("UPDATE post SET likes = likes + 1 WHERE postid = ?"); //+1 to likes
                                $query3->bindparam(1, $_POST['postid']);
                                $query3->execute();
                            }
                            else //they disliked it before
                            {
                                $query3 = $this->db->prepare("UPDATE post SET likes = likes + 1, dislikes = dislikes - 1 WHERE postid = ?"); //+1 to likes, -1 from dislikes
                                $query3->bindparam(1, $_POST['postid']);
                                $query3->execute();
                            }
                        break;
                        case 'D': //they are now Disliking it
                            if($previousOpinion == 'N') //they were neutral before
                            {
                                $query3 = $this->db->prepare("UPDATE post SET dislikes = dislikes + 1 WHERE postid = ?"); //+1 to dislikes
                                $query3->bindparam(1, $_POST['postid']);
                                $query3->execute();
                            }
                            else //they liked it before
                            {
                                $query3 = $this->db->prepare("UPDATE post SET dislikes = dislikes + 1, likes = likes - 1 WHERE postid = ?");//+1 to dislikes, -1 from likes  
                                $query3->bindparam(1, $_POST['postid']);
                                $query3->execute();
                            }
                        break;
                    }

                }


            }
            else if($commandReceived === 'commentOpinion') //first time opinion is taken care of here
            {
                /**
                *    @author DD_
                */
                //First time opinion checker
                
                $query = $this->db->prepare("SELECT opinion FROM commentopinion WHERE commentid = ? AND userid = ?");
                $query->bindparam(1, $_POST['commentid']);
                $query->bindparam(2, $_SESSION['id']);
                $query->execute();

                if($query->rowcount() == 0) //means user is giving opinion for the first time
                {
                    $query2 = $this->db->prepare("INSERT INTO commentopinion VALUES(?,?,?)");
                    $query2->bindparam(1, $_POST['commentid']);
                    $query2->bindparam(2, $_SESSION['id']);
                    $query2->bindparam(3, $_POST['opinion']);
                    $query2->execute();

                    //updates values found in postcomment like/dislike counter
                    //it's also nice that this is so embedded in the backend service, it'll make it harder for attackers to mess our things up by means of inspect element
                    if($_POST['opinion'] == 'L') //user liked
                    {
                        $query3 = $this->db->prepare("UPDATE postcomments SET likes = likes + 1 WHERE commentid = ?");
                        $query3->bindparam(1, $_POST['commentid']);
                        $query3->execute();
                    }
                    else //user disliked
                    {
                        $query3 = $this->db->prepare("UPDATE postcomments SET dislikes = dislikes + 1 WHERE commentid = ?");
                        $query3->bindparam(1, $_POST['commentid']);
                        $query3->execute();
                    }
                }
                else //user has given opinion before
                {
                    $previousOpinion = $query->fetch()['opinion']; //gets the user's opinion before the change
                    $query2 = $this->db->prepare("UPDATE commentopinion SET opinion = ? WHERE commentid = ? AND userid = ?");
                    $query2->bindparam(1, $_POST['opinion']);
                    $query2->bindparam(2, $_POST['commentid']);
                    $query2->bindparam(3, $_SESSION['id']);
                    $query2->execute();
                    
                    switch($_POST['opinion']) //this is the current opinion casted
                    {
                        case 'N': //they are now neutral
                            if($previousOpinion == 'L') //they liked it before
                            {
                                $query3 = $this->db->prepare("UPDATE postcomments SET likes = likes - 1 WHERE commentid = ?"); //-1 from likes
                                $query3->bindparam(1, $_POST['commentid']);
                                $query3->execute();
                            }
                            else //they disliked it before
                            {
                                $query3 = $this->db->prepare("UPDATE postcomments SET dislikes = dislikes - 1 WHERE commentid = ?"); //-1 from dislikes
                                $query3->bindparam(1, $_POST['commentid']);
                                $query3->execute();
                            }
                        break;
                        case 'L': //they are now Liking it
                            if($previousOpinion == 'N') //they were neutral before
                            {
                                $query3 = $this->db->prepare("UPDATE postcomments SET likes = likes + 1 WHERE commentid = ?"); //+1 to likes
                                $query3->bindparam(1, $_POST['commentid']);
                                $query3->execute();
                            }
                            else //they disliked it before
                            {
                                $query3 = $this->db->prepare("UPDATE postcomments SET likes = likes + 1, dislikes = dislikes - 1 WHERE commentid = ?"); //+1 to likes, -1 from dislikes
                                $query3->bindparam(1, $_POST['commentid']);
                                $query3->execute();
                            }
                        break;
                        case 'D': //they are now Disliking it
                            if($previousOpinion == 'N') //they were neutral before
                            {
                                $query3 = $this->db->prepare("UPDATE postcomments SET dislikes = dislikes + 1 WHERE commentid = ?"); //+1 to dislikes
                                $query3->bindparam(1, $_POST['commentid']);
                                $query3->execute();
                            }
                            else //they liked it before
                            {
                                $query3 = $this->db->prepare("UPDATE postcomments SET dislikes = dislikes + 1, likes = likes - 1 WHERE commentid = ?");//+1 to dislikes, -1 from likes  
                                $query3->bindparam(1, $_POST['commentid']);
                                $query3->execute();
                            }
                        break;
                    }

                }
                
            }
        }
    }

    /**
    *    Responsible for getting posts via search types
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
                case "searchPlace": 
                    $searchplace = "%" . $_POST['searchplace'] . "%"; //the user's search term
                    include_once('../post/postObject.php');
                    $query = $this->db->prepare("SELECT u.username, p.*, i.filepath FROM post p LEFT JOIN users u ON p.userid = u.id LEFT JOIN userinfo i ON u.id = i.id WHERE place LIKE :query ORDER BY timestamp DESC LIMIT 4 OFFSET :off");
                    $query->bindparam(":query", $searchplace, PDO::PARAM_STR);
                    
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
                    } else if ($query->rowcount() == 0)
                        echo FALSE;
                break;
                
                //these are ther results for BASIC home (organized by post date)
                case "home": 
                    include_once('../post/postObject.php');
                    $query = $this->db->prepare("SELECT u.username, p.*, i.filepath FROM post p LEFT JOIN users u ON p.userid = u.id LEFT JOIN userinfo i ON u.id = i.id ORDER BY timestamp DESC LIMIT 4 OFFSET :off");
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
                case "oldest": 
                    include_once('../post/postObject.php');
                    $query = $this->db->prepare("SELECT u.username, p.*, i.filepath FROM post p LEFT JOIN users u ON p.userid = u.id LEFT JOIN userinfo i ON u.id = i.id ORDER BY timestamp ASC LIMIT 4 OFFSET :off");
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
                    
                case "user-profile": 
                    include_once('../post/postObject.php');
                    $query = $this->db->prepare("SELECT u.username, p.*, i.filepath FROM post p LEFT JOIN users u ON p.userid = u.id LEFT JOIN userinfo i ON u.id = i.id WHERE u.id=:userid ORDER BY timestamp DESC LIMIT 4 OFFSET :off");
                    /*
                    "SELECT u.username, p.* FROM post p RIGHT JOIN users u ON p.userid = u.id WHERE postid = :postid");
                    $postid = $_POST['postid'];
                    $query->bindparam(':postid', $postid, PDO::PARAM_INT);
                    */
                    //"S   ELECT * FROM postcomments WHERE postid = :postid LIMIT :lim OFFSET :offset"
                    //$query2->bindparam(1, $result['postid']);
                    $query->bindparam(':userid',$_SESSION['id']);
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
                
                case "user-profile-id": 
                    include_once('../post/postObject.php');
                    $query = $this->db->prepare("SELECT u.username, p.*, i.filepath FROM post p LEFT JOIN users u ON p.userid = u.id LEFT JOIN userinfo i ON u.id = i.id WHERE u.id=:userid ORDER BY timestamp DESC LIMIT 4 OFFSET :off");
                    /*
                    "SELECT u.username, p.* FROM post p RIGHT JOIN users u ON p.userid = u.id WHERE postid = :postid");
                    $postid = $_POST['postid'];
                    $query->bindparam(':postid', $postid, PDO::PARAM_INT);
                    */
                    //"S   ELECT * FROM postcomments WHERE postid = :postid LIMIT :lim OFFSET :offset"
                    //$query2->bindparam(1, $result['postid']);
                    $query->bindparam(':userid',$_POST['userid']);
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

                case "highest": # arrange by highest rated
                    include_once('../post/postObject.php');
                    $query = $this->db->prepare("SELECT u.username, p.*, i.filepath FROM post p LEFT JOIN users u ON p.userid = u.id LEFT JOIN userinfo i ON u.id = i.id ORDER BY likes DESC LIMIT 4 OFFSET :off");
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
                case "favorites": # arrange by  most favorites
                    include_once('../post/postObject.php');
                    $query = $this->db->prepare("SELECT u.username, p.*, i.filepath FROM post p LEFT JOIN users u ON p.userid = u.id LEFT JOIN userinfo i ON u.id = i.id ORDER BY favnum DESC LIMIT 4 OFFSET :off");
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


//  [Team Monday: DBD, FETCH!]
    //                          ;\ 
    //                         |' \ 
    //      _                  ; : ; 
    //     / `-.              /: : | 
    //    |  ,-.`-.          ,': : | 
    //    \  :  `. `.       ,'-. : | 
    //     \ ;    ;  `-.__,'    `-.| 
    //      \ ;   ;  :::  ,::'`:.  `. 
    //       \ `-. :  `    :.    `.  \ 
    //        \   \    ,   ;   ,:    (\ 
    //         \   :., :.    ,'o)): ` `-. 
    //        ,/,' ;' ,::"'`.`---'   `.  `-._ 
    //      ,/  :  ; '"      `;'          ,--`. 
    //     ;/   :; ;             ,:'     (   ,:)    
    //       ,.,:.    ; ,:.,  ,-._ `.     \""'/ 
    //       '::'     `:'`  ,'(  \`._____.-'"' 
    //          ;,   ;  `.  `. `._`-.  \\ 
    //          ;:.  ;:       `-._`-.\  \`.     [db_dealer(DBD): ARF!]
    //           '`:. :        |' `. `\  ) \ 
    //              ` ;:       |    `--\__,' 
    //                '`      ,' 
    //                     ,-' 
//                                             
?>