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


    public function dashboard(){
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || $_SESSION['role'] != 2){
            $this->redirect('/login');
        }
        $this->renderUser('dashboard');
    }
    public function profile(){
        $id = $_SESSION['user_id'];
        $user = $this->userModel ->getUser($id);
        $this->renderUser('profile', ['user'=> $user]);
    }
    public function updateProfile(){
        $update_errors = [
            'name' => '',
            'email' => '',
            'address' => '',
            'password' => ''
        ];
       
        $name = $email = $password = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
            $data = $_POST;
            $id = $_SESSION['user_id'];
            // dd($id);
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
                if (strlen($password) <= 4) {
                    $update_errors['password'] = 'Password must be more than 4 characters long.';
                }
            }

            $password = password_hash($password, PASSWORD_DEFAULT);
            $this->userModel->updateClient($name, $email, $password,$address, $profile_path, $id);
            // dd($update_errors);
            
        }
    }
    public function showAccounts(){
        $accounts = $this->accountModel->getAccounts($_SESSION['user_id']);
        dd($accounts);
        $this->renderUser('accounts');
    }
    
}

