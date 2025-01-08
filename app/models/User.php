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

    // get All Users
    public function getAllUsers(){
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function createUser($name, $email, $password, $role){
        $query = "INSERT INTO users (name, email, password, role, profile_pic) VALUES (:name, :email, :password, :role, 'http://www.fls.usmba.ac.ma/app/public/admin/uploads/users/user_default.png')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        $stmt->execute();
        $lastInsertedId = $this->conn->lastInsertId();
        $query = "INSERT INTO accounts (user_id, balance, account_number, account_type) VALUES (:user_id, 0, :account_number, 'courant')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $lastInsertedId, PDO::PARAM_INT);
        $stmt->bindParam(':account_number', rand(1000000000, 9999999999), PDO::PARAM_STR);
        $stmt->execute();

        $query = "INSERT INTO accounts (user_id, balance, account_number, account_type) VALUES (:user_id, 0, :account_number, 'epargne')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $lastInsertedId, PDO::PARAM_INT);
        $stmt->bindParam(':account_number', rand(1000000000, 9999999999), PDO::PARAM_STR);
        $stmt->execute();

        return true;
        
    }
    





}