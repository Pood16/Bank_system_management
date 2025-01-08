<?php 


require_once __DIR__.'/../models/User.php';
class ClientController extends BaseController {

    private $userModel;
    public function __construct(){
        $this->userModel = new User();
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
        // dd($user);
        $this->renderUser('profile', ['user'=> $user]);
    }
    public function updateProfile(){
        $update_errors = [
            'name' => '',
            'email' => '',
            'password' => ''
        ];
        $name = $email = $password = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
            dd($_SESSION); 
        }
    }
}

