<?php 


require_once __DIR__.'/../models/User.php';
class AdminController extends BaseController {

    private $userModel;
    public function __construct(){
        $this->userModel = new User();
    }


    public function dashboard(){
        // dd($_SESSION);
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || $_SESSION['role'] != 1){
            $this->redirect('/login');
        }
        $users = $this->userModel->getAllUsers();
        $all = [];
        foreach($users as $user){
            $user['accounts'] = $this->userModel->getUserAccounts($user['id']);
            // dd($user);  
            $all[] = $user; 
        }
        // dd($all);
        $this->renderAdmin('dashboard', ['users' => $all]);
    }

    public function createUser(){
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || $_SESSION['role'] != 1){
            $this->redirect('/login');
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = trim($_POST['name'] ?? '');
            $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'] ?? '';
            $role = intval($_POST['role'] ?? 0);
            if(empty($name) || strlen($name) > 50 || !$email || strlen($password) < 8 || !in_array($role, [1, 2])){
                $_SESSION['error'] = "Invalid input. Please check your entries.";
                $this->redirect('/admin');
                exit;
            }
            if($this->userModel->createUser($name, $email, $password, $role)){
                $this->redirect('/admin');
                exit;
            }
        }
    }   

    public function getUsers(){
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || $_SESSION['role'] != 1){
            $this->redirect('/login');
        }
        if($_GET['action'] == 'all'){
            $users = $this->userModel->getAllUsers();
            echo json_encode($users);
        }elseif ($_GET['action'] == 'id') {
            $user = $this->userModel->getUser($_GET['id']);
            echo json_encode($user);
        }
    }


    public function DeleteUser(){
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || $_SESSION['role'] != 1){
            $this->redirect('/login');
        }
        $this->userModel->deleteUser($_GET['id']);
    }

    public function banUser(){
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || $_SESSION['role'] != 1){
            $this->redirect('/login');
        }
        $this->userModel->banAccount($_GET['id']);
    }

    public function unbanUser(){
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || $_SESSION['role'] != 1){
            $this->redirect('/login');
        }
        $this->userModel->unbanAccount($_GET['id']);
    }

}