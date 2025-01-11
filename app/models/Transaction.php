<?php 


require_once(__DIR__.'/../config/Database.php');

class Transaction extends Database {




    public function __construct(){
        parent::__construct();
    }




    // get all transactions
    public function getTransactions($id){
        $query = "SELECT 
                users.name AS user_name, 
                accounts.account_number, 
                accounts.account_type,
                transactions.amount, 
                transactions.created_at, 
                transactions.transaction_type 
            FROM users 
            INNER JOIN accounts ON users.id = accounts.user_id 
            INNER JOIN transactions ON accounts.id = transactions.account_id
            WHERE users.id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    



}