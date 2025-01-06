<?php

class BaseController{

    public function render($view, $data = []){
        extract($data);
        include '../app/views/' . $view . '.php';
    }
    public function renderUser($view, $data = []){
        extract($data);
        include '../app/views/user/' . $view . '.php';
    }
    public function renderAdmin($view, $data = []){
        extract($data);
        include '../app/views/admin/' . $view . '.php';
    }
}