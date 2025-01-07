<?php 


require_once __DIR__.'/../models/User.php';
class AdminController extends BaseController {

    private $userModel;
    public function __construct(){
        $this->userModel = new User();
    }


    public function dashboard(){
        if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || $_SESSION['role'] != 2){
            $this->redirect('/login');
        }
        $this->renderAdmin('dashboard');
    }
}

