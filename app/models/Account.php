<?php 

require_once(__DIR__.'/../config/Database.php');

class Account extends Database {



  

    public function __construct(){
        parent::__construct();
    }


    // get all user accounts informations
    public function getAccounts($id){
        $query = "SELECT * FROM accounts WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // get account by id
    public function getAccount($id){
        $query = "SELECT * FROM accounts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    // deposite an amount
    public function addAmount($user_id, $account_id, $account_balance, $amount){
        $this->conn->beginTransaction();
        try{
            $sql = 'UPDATE accounts SET balance = :account_balance + :amount, updated_at = NOW()  WHERE id = :account_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':account_balance', $account_balance, PDO::PARAM_STR);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stmt->bindParam(':account_id', $account_id, PDO::PARAM_STR);
            $stmt->execute();

            $sql = 'INSERT INTO transactions (account_id, transaction_type, amount) VALUES (:account_id, "depot", :amount)';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':account_id', $account_id, PDO::PARAM_STR);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            
            $stmt->execute();   


            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
    // withdraw an amount
    public function withdrawAmount($user_id, $account_id, $account_balance, $amount){
        $this->conn->beginTransaction();
        try{
            $sql = 'UPDATE accounts SET balance = :account_balance - :amount, updated_at = NOW()  WHERE id = :account_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':account_balance', $account_balance, PDO::PARAM_STR);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stmt->bindParam(':account_id', $account_id, PDO::PARAM_STR);
            $stmt->execute();

            $sql = 'INSERT INTO transactions (account_id, transaction_type, amount) VALUES (:account_id, "retrait", :amount)';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':account_id', $account_id, PDO::PARAM_STR);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
           
            $stmt->execute();   


            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
    // transfer an amount
    public function transferAmount($user_id, $from_account_id, $from_account_balance, $amount, $to_account_id, $to_account_balance){
        $this->conn->beginTransaction();
        try{    
            $sql = 'UPDATE accounts SET balance = :from_account_balance - :amount, updated_at = NOW()  WHERE id = :from_account_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':from_account_balance', $from_account_balance, PDO::PARAM_STR);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stmt->bindParam(':from_account_id', $from_account_id, PDO::PARAM_STR);
            $stmt->execute();

            $sql = 'UPDATE accounts SET balance = :to_account_balance + :amount, updated_at = NOW()  WHERE id = :to_account_id';
            $stmt = $this->conn->prepare($sql); 
            $stmt->bindParam(':to_account_balance', $to_account_balance, PDO::PARAM_STR);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stmt->bindParam(':to_account_id', $to_account_id, PDO::PARAM_STR);
            $stmt->execute();

            $sql = 'INSERT INTO transactions (account_id, transaction_type, amount) VALUES (:account_id, "transfert", :amount)';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':account_id', $from_account_id, PDO::PARAM_STR);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stmt->execute();   


            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }




    // admin stats
    public function getTotalDeposits() {
        $query = "SELECT COALESCE(SUM(amount), 0) as total FROM transactions WHERE transaction_type = 'depot'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalWithdrawals() {
        $query = "SELECT COALESCE(SUM(amount), 0) as total FROM transactions WHERE transaction_type = 'withdrawal'";
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