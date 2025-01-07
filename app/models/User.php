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
        return $stmt->fetchAll();
    }





}