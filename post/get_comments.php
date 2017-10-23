<?php

    # not integrating this into db_dealer.php for legacy reasons
    include_once('../php/connection.php');
    include_once('commentObject.php');

    $postid = $_POST['postid'];
    $range = $_POST['range'];
 
    $commentFactory = new CommentFactory();
  
    echo $commentFactory->getComments($postid, $range);

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
            $query = $this->db->prepare("SELECT pc.*, u.filepath FROM postcomments pc LEFT JOIN userinfo u ON pc.userid=u.id WHERE postid= :postid LIMIT :lim OFFSET :offset");
            
            $query->bindparam(':postid', $postid);
            $really = 2; 
            $query->bindparam(':lim', $really, PDO::PARAM_INT);
            $offset = (int)$range;
            $query->bindparam(':offset', $offset, PDO::PARAM_INT);
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
                        $result['dislikes'],
                        $result['filepath']
                    );
                    array_push($comments, $comment->toArray());
                }
                return json_encode($comments);
            }
            else
                return "false";
           
        }
    }

?>