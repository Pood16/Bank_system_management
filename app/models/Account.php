<?php 


require_once(__DIR__.'/../config/Database.php');

class Account extends Database {



  

    public function __construct(){
        parent::__construct();
    }


    // get account information
    public function getAccounts($id){
        $query = "SELECT * FROM accounts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    
    
    





}