<?php

require "../config/Database.php";
    

 class Articulos_fotos{

        private $db;

        public function __construct(Database $database) {
            $this->db = $database->getConnection();
        }


        

}