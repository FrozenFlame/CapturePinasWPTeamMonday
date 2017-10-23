<?php
    /******************************************************************************
    *   @author cKyuzee
    *   07-OCT-17
    *******************************************************************************/
    # savechanges_process.php's job is to allow users to edit their credentials
    include_once('../php/connection.php');

    session_start();

    // initialize variables (from POST in signup.html)
    $_email=$_POST['email'];
    $_password=$_POST['password'];
    $_fullname=$_POST['fullname'];
    $_id = $_SESSION['id'];
    $_bio = $_POST['bio'];
    $_avatar = (bool)$_POST['avatarchanged'];
    $attempt = new Save_Changes($_email, $_password, $_fullname, $_id, $_bio, $_avatar);
    $attempt->savechanges();


    class Save_Changes #inner class
    {
        private $db;
        private $successful;
        private $e_mail;
        private $pass;
        private $fullname;
        private $id;
        private $bio;
        private $avatar;
        private $trimmedFullname;
        private $result = FALSE;
        private $result2 = FALSE;
        private $result3 = FALSE;
        private $result4 = FALSE;
        private $result5 = FALSE;
        public function __construct($e, $p, $f, $i, $b, $a)
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect(); #being extremely explicit here just in case.
            $this->e_mail = $e;
            $this->pass = $p;
            $this->fullname = $f;
            $this->id = $i;
            $this->bio = $b;
            $this->avatar = $a;
        }

        public function savechanges()
        {
            if ($this->e_mail != '@gmail.com' && $this->e_mail != '@yahoo.com'){
                $query = $this->db->prepare("UPDATE users SET email=? WHERE id=$this->id");
                $query->bindparam(1,$this->e_mail);
                $this->result = TRUE;
                $query->execute();
            }

            if ($this->pass != ''){
                $query2 = $this->db->prepare("UPDATE users SET password=? WHERE id=$this->id");
                $hashed = password_hash($this->pass,PASSWORD_DEFAULT);
                $query2->bindparam(1,$hashed);
                $this->result2 = TRUE;
                $query2->execute();
            }
            
            if ($this->fullname != ''){
                $query3 = $this->db->prepare("UPDATE users SET fullname=? WHERE id=$this->id");
                $query3->bindparam(1,$this->fullname);
                $this->result3 = TRUE;
                $query3->execute();
            }

            if ($this->bio != ''){
                $query4 = $this->db->prepare("UPDATE userinfo SET bio=? WHERE id=$this->id");
                $query4->bindparam(1,$this->bio);
                $this->result4 = TRUE;
                $query4->execute();
            }

            if($this->avatar)
            {
                $this->result5 = TRUE;
            }
            
            $finalResult = $this->result || $this->result2 || $this->result3 || $this->result4 || $this->result5; 
            if($result && $result2 && $result3 && $result4)
            {
                $successful=TRUE;
            }else{
                $successful=FALSE;
            }

            return $successful;
        }

    }
    die(0);

?>
