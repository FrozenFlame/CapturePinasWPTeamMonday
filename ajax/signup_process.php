<?php 
    # signup_process.php's job is to allow users to create an account.
    include_once('../php/connection.php');

    session_start();

    // initialize variables (from POST in signup.html)
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
            $query = $this->db->prepare("INSERT INTO users VALUES(NULL,?,?,?,?,0)"); #value 0 is for the account email verif thing.
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
            $query = $this->db->prepare("SELECT * FROM users WHERE username = ? "); #gets table data
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