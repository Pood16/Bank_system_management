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
        $email = $password = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

            $data = $_POST;
        
            // check email forma
            if(empty($data['name'])){
                $login_errors['email'] = 'Email required';
            }elseif (!filter_var($data['name'], FILTER_VALIDATE_EMAIL)) {
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
            $user = $this->userModel->getUserEmail($email);
            dd($user);
            if ($user){
                // dd($user);
                $this->render('auth/logout', ['user' => $user]);
            }
        }
        




        
          

       
    }
    // handle logout
    public function handleLogout(){
        $this->render('auth/logout');
    }
    
}

