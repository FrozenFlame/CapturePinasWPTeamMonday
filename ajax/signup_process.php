<?php 
    # login_process.php's job is to verify the input of the user to the database if such a user exists.
    include_once('../php/connection.php');

    session_start();

    // create a variable
    $username=$_POST['username'];
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
 
    $attempt = new Signup();
    echo $attempt->signup($username, $password,$email, $fullname); 
    $attempt->getUserId($username);
    /*if(isset($user) === TRUE && empty($user) === FALSE 
    && isset($pass) === TRUE && empty($pass) === FALSE) #this is to check if our reference is valid.
    {                
    } */

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
            $query = $this->db->prepare("INSERT INTO users VALUES(NULL,?,?,?,?,0)");
            $query->bindparam(1,$user);
            $query->bindparam(2,$full_name);
            $query->bindparam(3,$e_mail);
            $query->bindparam(4,$pass);
            $result = $query->execute();
        
            if($result)
            {                
                $successful=TRUE;                                
            }else{
                $successful=FALSE;
            }            
            return $successful;
        }              
        
        function getUserId($username)
        {
            $query = $this->db->prepare("SELECT * FROM users WHERE username = ? "); #BINARY makes the password search case-sensitive.
            $query->bindparam(1, $username);
            $query->execute();
            
            if($query->rowcount() == 1) #checks if it at least found a user with such credentials.
            {    
                $_SESSION['id'] = $query->fetch()['id'];
                //$_SESSION['fullname'] = $query->fetch()['fullname'];//this will give us the id
                
            }
        }
    }
?>