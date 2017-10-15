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
    $attempt = new Save_Changes($_email, $_password, $_fullname, $_id);
    $attempt->savechanges();


    class Save_Changes #inner class
    {
        private $db;
        private $successful;
        private $e_mail;
        private $pass;
        private $fullname;
        private $id;
        
        private $trimmedFullname;
        public function __construct($e, $p, $f, $i)
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect(); #being extremely explicit here just in case.
            $this->e_mail = $e;
            $this->pass = $p;
            $this->fullname = $f;
            $this->id = $i;
        }

        public function savechanges()
        {
            if ($this->e_mail != '@gmail.com' && $this->e_mail != '@yahoo.com'){
                $query = $this->db->prepare("UPDATE users SET email=? WHERE id=$this->id");
                $query->bindparam(1,$this->e_mail);
                $result = $query->execute();
                $query->execute();
            }

            if ($this->pass != ''){
                $query2 = $this->db->prepare("UPDATE users SET password=? WHERE id=$this->id");
                $hashed = password_hash($this->pass,PASSWORD_DEFAULT);
                $query2->bindparam(1,$hashed);
                $result2 = $query2->execute();
                $query2->execute();
            }
            
            if ($this->fullname != ''){
                $query3 = $this->db->prepare("UPDATE users SET fullname=? WHERE id=$this->id");
                $query3->bindparam(1,$this->fullname);
                $result3 = $query3->execute();
                $query3->execute();
            }

            if($result && $resul2 && $result3)
            {
                $successful=TRUE;
                //alert('Password changed!');
            }else{
                $successful=FALSE;
                //echo "alert('Error changing E-mail')";
            }

            return $successful;
        }

    }
    die(0);

?>
