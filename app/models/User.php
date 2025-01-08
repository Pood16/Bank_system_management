<?php 


require_once(__DIR__.'/../config/Database.php');

class User extends Database {




    public function __construct(){
        parent::__construct();
    }


    
    // get user by email
    public function getUserEmail($email){
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    //get user id
    public function getUser($id){
        $query = "SELECT users.name, users.email, accounts.account_type, accounts.account_number FROM users JOIN accounts ON users.id = accounts.user_id WHERE users.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    





}