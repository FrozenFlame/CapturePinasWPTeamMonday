<?php 
    # login_process.php's job is to verify the input of the user to the database if such a user exists.
    include_once('../php/connection.php');

    session_start();

    // create a variable
    $username=$_POST['username'];
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
 
    
    if(isset($user) === TRUE && empty($user) === FALSE 
    && isset($pass) === TRUE && empty($pass) === FALSE) #this is to check if our reference is valid.
    {
        $attempt = new Signup();
        echo $attempt->signup($username, $password,$email, $fullname);
    } 

    class Signup #inner class
    {
        private $db;
        private $successful;
        public function __construct()
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect(); #being extremely explicit here just in case. 
        }
        
        public function signup($user, $pass, $e_mail, $full_name)
        {
            $query = $this->db->prepare("INSERT INTO users VALUES(?,?,?,?)");
            $query->bindparam(1,$user);
            $query->bindparam(2,$full_name);
            $query->bindparam(3,$e_mail);
            $query->bindparam(4,$pass);
            $result = $query->execute();
            
            if($result)
            {
                $successful = TRUE;
                
            } else
            {
                $successful = FALSE; #the credentials were wrong.
            }
            
        }
    }

    class Login #inner class
    {
        private $db;
        private $successful;
        public function __construct() 
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect(); #being extremely explicit here just in case.      
        }

        public function login($username, $password) #this is the database logic
        {
            $query = $this->db->prepare("SELECT * FROM users WHERE username = ? AND BINARY password = ?"); #BINARY makes the password search case-sensitive.
            $query->bindparam(1, $username);
            $query->bindparam(2, $password);
            $result = $query->execute();
            
        
            
           return $successful;
        }
    }
?>