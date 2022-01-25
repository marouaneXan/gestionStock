<?php


    class DB{
       protected $mydb;
       public function connect(){
        try{

            $this->mydb=new PDO("mysql:host=localhost;dbname=gestion_produit","root","");
            // set the PDO error mode to exception
            $this->mydb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->mydb;

        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
       }
    }

?>