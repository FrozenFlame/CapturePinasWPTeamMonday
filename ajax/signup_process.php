<?php 
    /**********************************************************************************
    *   @author Jarvis
    *   02-OCT-17
    ***********************************************************************************/
    # signup_process.php's job is to allow users to create an account.

    include_once('../php/connection.php');

    session_start();

    // initialize variables (from POST in signup.html)
    $username=$_POST['username'];
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    #hashed password!
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $attempt = new Signup();
    echo $attempt->signup($username, $hash, $email, $fullname); 
    $attempt->getUserId($username);
    

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
            $query = $this->db->prepare("INSERT INTO users VALUES(NULL,?,?,?,?)"); #value 0 is for the account email verif thing.
            $query->bindparam(1,$user);
            $query->bindparam(2,$full_name);
            $query->bindparam(3,$e_mail);
            $query->bindparam(4,$pass);
            $result = $query->execute();
            
            if($result){
                
                $query2 = $this->db->prepare("SELECT id FROM users ORDER BY id DESC LIMIT 1");
                $query2->execute();
                $result2 = $query2->fetch()['id'];
                
                $query3 = $this->db->prepare("INSERT INTO userinfo VALUES(?,'/CapturePinasWPTeamMonday/images/userimages/default.png','')");
                $query3->bindparam(1,$result2);
                $query3->execute();
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
                
            }
        }
    }
    die(0);
?>
