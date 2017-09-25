<?php
    #this is so that we can connect a php document to the database by simply importing this.
    class Connection
    {
        public function dbConnect()
        {
            return new PDO('mysql:host=localhost; dbname=capturepinas', 'root', ''); #this is where we may have differences (db username and password)
        }
    }
            
<<<<<<< HEAD
    //die(0);
=======
>>>>>>> c6dc912d93fc3e686b1c2672ae93512f3cfc6189
?>
