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
            if($commandReceived==='getId')
            {
                $query = $this->db->prepare("SELECT fullName FROM users WHERE id = ?"); #retrieves fullname and other info based on users
                $query->bindparam(1, $_SESSION['id']);
                $query->execute();
                $result = $query->fetch()['fullName'];
                return $result;
            }
        }
    }
?>