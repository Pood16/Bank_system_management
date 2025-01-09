<?php 


require_once(__DIR__.'/../config/Database.php');

class Account extends Database {



  

    public function __construct(){
        parent::__construct();
    }


    // get account information
    public function getAccounts($id){
        $query = "SELECT * FROM accounts WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // deposite an amount
    public function addAmount($id,$solde, $amount){
        $sql = 'UPDATE accounts SET balance = :solde + :amount WHERE user_id = :id AND account_type = "courant"';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':solde', $solde, PDO::PARAM_STR);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        return $stmt->execute();
    }


    
    
    





}