<?php 


require_once __DIR__.'/../models/User.php';
class AuthController extends BaseController {

    private $userModel;
    public function __construct(){
        $this->userModel = new User();
    }




    // display user register form 
    public function showRegister(){
        $this->render('auth/register');
    }
    // display user login form
    public function showLogin(){
        $this->render('auth/login');
    }
    // handle the registration data
    public function handleLogin(){

        $login_errors = [
            'email' => '',
            'password' => ''
        ];
        $email = '';
        $password = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

            $data = $_POST;
        
            // check email forma
            if(empty($data['email'])){
                $login_errors['email'] = 'Email required';
            }elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $login_errors['email'] = 'wrong email formta';
            }else{
                // $email = htmlspecialchars(trim($data['email']));
                $email =$data['email'];
            }
            // check password
            if(empty($data['password'])){
                $login_errors['password'] = 'password required';
            }elseif(!preg_match('/^[a-zA-Z0-9]+$/', $data['password'])) {
                $login_errors['password'] =  "Password should contain letters and numbers";
            }else{
                $password = htmlspecialchars(trim($data['password']));
            }
            // check if the user exists in db
            // dd($email);
            $user = $this->userModel->getUserEmail($email);
            if ($user){
                if (password_verify($password, $user['password'])){
                    if($user['role'] == 1){
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['username'] = $user['name'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['profile_pic'] = $user['profile_pic'];
                        header('Location: /admin');
                        exit();
                    }elseif($user['role'] == 2){
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['username'] = $user['name'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['profile_pic'] = $user['profile_pic'];
                        header('Location: /user');
                        exit();
                    }
                }else{
                    $login_errors['password'] =  "Password incorrect";
                }
            }else{
                $login_errors['password'] =  "User not found";
            }
        }
        




        
          

       
    }
    // handle logout
    public function handleLogout(){
        $this->render('auth/logout');
    }
    
}

