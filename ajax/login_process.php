<?php 
    # login_process.php's job is to verify the input of the user to the database if such a user exists.
    include_once('../php/connection.php');
   
    $user = $_POST['usern'];
    $pass = $_POST['passw'];
    if(isset($user) === TRUE && empty($user) === FALSE 
    && isset($pass) === TRUE && empty($pass) === FALSE) #this is to check if our reference is valid.
    {
        $attempt = new Login();
        echo $attempt->login($user, $pass);
    } 


    class Login
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
            
            $query = $this->db->prepare("SELECT * FROM users2 WHERE usrName = ? AND password = ?");
            $query->bindparam(1, $username);
            $query->bindparam(2, $password);
            $query->execute();

            if($query->rowcount() == 1) #checks if it at least found a user with such credentials.
                $successful = TRUE;
            else
                $successful = FALSE; #the credentials were wrong.
            
            return ($successful) ? 'TRUE' : 'FALSE';
        }
       
    }

?>