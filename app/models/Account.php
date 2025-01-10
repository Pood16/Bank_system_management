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

    public function getTotalDeposits() {
        $query = "SELECT COALESCE(SUM(amount), 0) as total FROM transactions WHERE type = 'deposit'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalWithdrawals() {
        $query = "SELECT COALESCE(SUM(amount), 0) as total FROM transactions WHERE type = 'withdrawal'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalBalance() {
        $query = "SELECT COALESCE(SUM(balance), 0) as total FROM accounts";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}