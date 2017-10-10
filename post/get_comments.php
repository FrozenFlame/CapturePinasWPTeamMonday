<?php
    include_once('../php/connection.php');
    include_once('commentObject.php');

    $postid = $_POST['postid'];
    $range = $_POST['range'];
 
    $commentFactory = new CommentFactory();
  
    echo $commentFactory->getComments($postid, $range);
    //echo "trolled";

    class CommentFactory
    {
        private $db;

        public function __construct()
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect();
        }

        public function getComments($postid, $range)
        {
            //SELECT * FROM `postcomments` WHERE postid = 1 LIMIT y OFFSET x  !!y is how many results you want, and x will be what index in the result set.
            // I <3 MYSQL A LOT. #getREKTDB2
            $query = $this->db->prepare("SELECT * FROM postcomments WHERE postid = :postid LIMIT :lim OFFSET :offset");
            $query->bindparam(':postid', $postid);
            $really = 2; //omg REALLY? YOU NEED TO DECLARE IT? BIND PARAM CANNOT ACCEPT LITERALS? LEGIT? WHAT THE HELL.
            //$query->bindparam(':lim', 2, PDO::PARAM_INT); //THIS BREAKS IT FOR REAL
            $query->bindparam(':lim', $really, PDO::PARAM_INT);
            $offset = (int)$range;
            $query->bindparam(':offset', $offset, PDO::PARAM_INT);
            // $query->bindparam(2, (int)$range);
            $query->execute();

            $comments = array(); //an array for JSONs

            if($query->rowcount() != 0) 
            {
                foreach($query as $result)
                {
                    $comment = new Comment
                    (
                        $result['postid'],
                        $result['commentid'],
                        $result['userid'],
                        $result['content'],
                        $result['likes'],
                        $result['dislikes']
                    );
                    array_push($comments, $comment->toArray());
                }
                return json_encode($comments);
            }
            else
                return "false";
            //else
            //    return null; //this might be an example that I wasted my time.
            // $comments = $query->fetch_all();
           // return json_encode($comments);
        }
    }

//this segment of our study taught me how horridly strict and how explicit you must be when calling global variables in php.
?>