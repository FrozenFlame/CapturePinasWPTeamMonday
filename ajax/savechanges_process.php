<?php
    # signup_process.php's job is to allow users to create an account.
    include_once('../php/connection.php');

    session_start();

    // initialize variables (from POST in signup.html)
   // echo "<script>console.log('Hello');</script>";
    $_email=$_POST['email'];
    $_password=$_POST['password'];
   // echo "<script>console.log('$password , $email');</script>";
    $_id = $_SESSION['id'];
    $attempt = new Save_Changes($_email, $_password, $_id);
    //echo $attempt->savechanges($password,$email);
    $attempt->savechanges();
    


    class Save_Changes #inner class
    {
        private $db;
        private $successful;
        private $e_mail;
        private $pass;
        private $id;
        public function __construct($e, $p, $i)
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect(); #being extremely explicit here just in case.
            $this->e_mail = $e;
            $this->pass = $p;
            $this->id = $i;
        }

        public function savechanges()
        {
            $query = $this->db->prepare("UPDATE users SET password=? WHERE id=$this->id");
            $query->bindparam(1,$this->pass);
            $result = $query->execute();
            $query->execute();

            $query2 = $this->db->prepare("UPDATE users SET email=? WHERE id=$this->id");
            $query2->bindparam(1,$this->e_mail);
            $result2 = $query2->execute();
            $query2->execute();

            if($result)
            {
                $successful=TRUE;
                //alert('Password changed!');
            }else{
                $successful=FALSE;
                //alert('Error changing password');
            }

            return $successful;
        }

    }
    die(0);

?>
