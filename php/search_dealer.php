<?php
    # Team Monday #
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        @author Denzel
        This search module is for the multitude of searches including: user search, title search, and place search.
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
    include_once('../php/connection.php');
    session_start();
    $command = $_POST['command'];     

    $search = new Search();
    $search->performCommand($command);

    
    





    # inner classes

    class Search
    {
        private $db;
        public function __construct() 
        {
            $this->db = new Connection();
            $this->db = $this->db->dbConnect();     
        }
        
        public function performCommand($command)
        {
            switch($command)
            {
                #search function is for getting list of post
                case "search": 
                $query = $_POST['query'];
                
                #$sql = 

                echo $query;
                break;

            }
        }
    }

?>