<?php 


require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Account.php';
// require_once __DIR__.'/../models/Transaction.php';
class ClientController extends BaseController {
  
    private $userModel;
    private $accountModel;
    public function __construct(){
        $this->userModel = new User();
        $this->accountModel = new Account();
    }

    //

    //start views

    //
    
    // client view
    public function profile(){
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || $_SESSION['role'] != 2){
            $this->redirect('/login');
        }
        $id = $_SESSION['user_id'];
        $user = $this->userModel ->getUser($id);
        $this->renderUser('profile', ['user'=> $user]);
    }
    // depot view
    public function depot(){
        $this->renderUser('depot');
    }
    // client accounts view
    public function showAccounts(){
        unset($_SESSION['accounts']);
        $accounts = $this->accountModel->getAccounts($_SESSION['user_id']);
        $_SESSION['accounts'] = $accounts;
        if ($accounts[0]['status'] == 1){
            $_SESSION['account_statu'] = "You cant do this operation cuz your account is banned by the bank try to contact the administration ⚠️";
        }else{
            unset($_SESSION['account_statu']);
        }
        // dd($accounts);  
        $this->renderUser('accounts', ['accounts' => $accounts]);
    }
    // client transfers view
    public function showTransfert(){
        unset($_SESSION['accounts']);
        $accounts = $this->accountModel->getAccounts($_SESSION['user_id']);
        $_SESSION['accounts'] = $accounts;
        $this->renderUser('transfer');
    }
    // client transactions historique view
    public function showHistoriques(){
        $this->renderUser('historique');
    }
    //
    // end views
    //


    // update profile action
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

    // add amount action
    public function addAmount(){
      
        $_SESSION['failed'] = '';
        $_SESSION['success'] = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
            $amount = floatval(htmlspecialchars(trim($_POST['amount'])));
            $account_id = intval($_POST['account_id']);
            $account = $this->accountModel->getAccount($account_id);
            $user_id = $account['user_id'];
            $account_balance = floatval($account['balance']);
         

            if ($amount< 0.01){
                $_SESSION['failed'] = 'The minimum amount to deposit  should be greater than 0.01 dirhams';
             
                $this->redirect('/user/accounts?action=depot');
            }
            
            
            $depot = $this->accountModel->addAmount($user_id, $account_id, $account_balance, $amount);

            if ($depot){
                $_SESSION['success'] = "The amount was added successfully";
          
                $this->redirect('/user/accounts?action=depot');
            }else{
                $_SESSION['failed'] = "Failed to add the amount";
             
                $this->redirect('/user/accounts?action=depot');
            }
        }
    }

    // withdraw amount
    public function withdrawAmount(){
        
        $_SESSION['failed'] = '';
        $_SESSION['success'] = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
            
            $amount = floatval(htmlspecialchars(trim($_POST['amount'])));
            $account_id = intval($_POST['account_id']);
            $account = $this->accountModel->getAccount($account_id);
            $user_id = $account['user_id'];
            $account_balance = floatval($account['balance']);
         

            if ($amount > $account_balance){
                $_SESSION['failed'] = 'The amount you want to withdraw is greater than your balance';
           
                $this->redirect('/user/accounts?action=retrait');
            }
            
            
            $retrait = $this->accountModel->withdrawAmount($user_id, $account_id, $account_balance, $amount);

            if ($retrait){
                $_SESSION['success'] = "The amount was withdraw successfully";
                dd($_SESSION['success']);
                $this->redirect('/user/accounts?action=retrait');
            }else{
                $_SESSION['failed'] = "Failed to withdraw the amount";
             
                $this->redirect('/user/accounts?action=retrait');
            }
        }
    }

    // transfer handeling
    public function handleTransfert(){
        $id = $_SESSION['user_id'];
        $_SESSION['accounts'] = $this->accountModel->getAccounts($id);
        // $this->transactionModel->
        $this->redirect('user/transferts');
        
    }

    
        
    



    
    

    
}

