<?php
    class Connection
    {
        public function dbConnect()
        {
            #this is so that we can connect a php document to the database by simply importing this.
            return new PDO('mysql:host=localhost; dbname=signuptest', 'root', '');
        }
    }
?>