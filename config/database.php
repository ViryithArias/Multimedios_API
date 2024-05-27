<?php

    class DatabasesConexion {

        private $host = "srv863.hstgr.io";
        private $pass = '#5?Sf1p0Vh';
        private $usua = "u484426513_multimedios022";
        private $database =  "u484426513_multimedios022";



        public $conectors;

        public function obtenerConn(){

            $this->conectors = null;

            try {

                $this->conectors = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->usua, $this->pass);
                $this->conectors->exec("set names utf8");

            }catch(PDOException $e){
                    echo "Error: " . $e->getMessage();

            }

            return $this->conectors;
        }


        
    }




?>