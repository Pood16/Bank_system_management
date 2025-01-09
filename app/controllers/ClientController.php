<?php 


require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Account.php';
class ClientController extends BaseController {
  
    private $userModel;
    private $accountModel;
    public function __construct(){
        $this->userModel = new User();
        $this->accountModel = new Account();
    }

    // views
    public function profile(){
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || $_SESSION['role'] != 2){
            $this->redirect('/login');
        }
        $id = $_SESSION['user_id'];
        $user = $this->userModel ->getUser($id);
        $this->renderUser('profile', ['user'=> $user]);
    }

    public function depot(){
        $this->renderUser('depot');
    }

    public function showAccounts(){
        $accounts = $this->accountModel->getAccounts($_SESSION['user_id']);
        if ($accounts[0]['status'] == 1){
            $_SESSION['account_statu'] = "You cant do this operation cuz your account is banned by the bank try to contact the administration ⚠️";
        }else{
            unset($_SESSION['account_statu']);
        }
        $this->renderUser('accounts', ['accounts' => $accounts]);
    }
    // end views

    public function updateProfile(){
        
        $name = $email = $password = '';
        $update_errors = [
            'name' => '',
            'email' => '',
            'address' => '',
            'password' => ''
        ];
       
      
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

            $data = $_POST;
            $id = $_SESSION['user_id'];
            $profile_path ='http://localhost:8080/assets/uploads/'.$data['profile'];
            $name = htmlspecialchars(trim($data['name']));
            $address = htmlspecialchars(trim($data['address']));
            $email = htmlspecialchars(trim($data['email']));
            $password = htmlspecialchars(trim($data['password']));

            // Validate name
            if (empty($name)) {
                $update_errors['name'] = 'Name is required';
            }
            if (empty($address)) {
                $update_errors['address'] = 'address is required';
            }

            // Validate email
            if (empty($email)) {
                $update_errors['email'] = 'Email is required';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $update_errors['email'] = 'Invalid email format';
            }

            // Validate password
            if (!empty($password)) {
                if (strlen($password) <= 8) {
                    $update_errors['password'] = 'Password must be more than 8 characters long.';
                }
            }

            $password = password_hash($password, PASSWORD_DEFAULT);
            $update_status = $this->userModel->updateClient($name, $email, $password,$address, $profile_path, $id);
            if ($update_status){
                $this->redirect('/user');
            } 
        }
    }

    public function addAmount(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
            $amount = '';
            $_SESSION['failed'] = '';
            $_SESSION['success'] = '';
            $account = $this->accountModel->getAccounts($_SESSION['user_id']);
           
            if (empty($_POST['amount']) || $_POST['amount'] < 0.01){
                $amount_error = 'The minimum amount to deposit  should be greater than 0.01 Euro';
                $this->renderUser('depot', ['amount_error' => $amount_error]);
            }else{
                $amount = (float)$_POST['amount'];
            }
            $id = $_SESSION['user_id'];
            $old_balance = (float)$account[0]['balance'];
            $status = $this->accountModel->addAmount($id, $old_balance, $amount);
            if ($status){
                $_SESSION['success'] = "The amount was added successfully";
                $this->renderUser('/depot');
            }else{
                $_SESSION['failed'] = "Failed to add the amount";
                $this->renderUser('depot');
            }
        }
    }



    
    

    
}

