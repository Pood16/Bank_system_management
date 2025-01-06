<?php


class Database {
    private $conn;
    public function __construct(){
        try{
            $this->conn = new PDO('mysql:host=localhost;dbname=bank_db', 'root', '8951');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }catch(PDOException $e){
            $this->conn = new PDO('mysql:host=localhost;dbname=bank_db', 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
    }
}