<?php
    # signup_process.php's job is to allow users to create an account.
    include_once('../php/connection.php');

    session_start();

    // initialize variables (from POST in signup.html)

    $email=$_POST['email'];
    $password=$_POST['password'];

    $attempt = new Save_Changes();
    echo $attempt->savechanges($password,$email);


    class Save_Changes #inner class
    {
        private $db;
        private $successful;
        public function __construct()
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect(); #being extremely explicit here just in case.
        }

        public function savechanges($pass, $e_mail)
        {
            $query = $this->db->prepare("UPDATE users SET password=? WHERE id=$_SESSION['id']");
            $query->bindparam(1,$pass);
            $result = $query->execute();
            $query->execute();

            $query2 = $this->db->prepare("UPDATE users SET email=? WHERE id=$_SESSION['id']");
            $query2->bindparam(1,$e_mail);
            $result2 = $query2->execute();
            $query2->execute();

            if($result)
            {
                $successful=TRUE;
                alert('Password changed!');
            }else{
                $successful=FALSE;
                alert('Error changing password');
            }

            return $successful;
        }

    }
    die(0);
?>
