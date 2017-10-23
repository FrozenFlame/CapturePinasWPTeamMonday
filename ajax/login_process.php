<?php 
    # login_process.php's job is to verify the input of the user to the database if such a user exists.
    include_once('../php/connection.php');

    session_start();

    $user = $_POST['usern'];
    $pass = $_POST['passw'];
    if(isset($user) === TRUE && empty($user) === FALSE 
    && isset($pass) === TRUE && empty($pass) === FALSE) #this is to check if our reference is valid.
    {
        $attempt = new Login();
        echo $attempt->login($user, $pass);
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
            $query = $this->db->prepare("SELECT * FROM users WHERE username = ?"); #BINARY makes the password search case-sensitive.
            $query->bindparam(1, $username);
            $query->execute();
            $content = $query->fetchAll();
            
            if($query->rowcount() == 1)
            {
                if(password_verify($password, $content[0]['password']))
                {
                    $successful = TRUE;
                    $_SESSION['id'] =  $content[0]['id'];
                }
                else
                {
                    $successful = FALSE;
                }
            }
            else
            {
                $successful = FALSE;
            }
          
               
           return $successful;
        }
    }
?>
