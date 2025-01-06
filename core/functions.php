<?php


function dd($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function sideMenu($user_role){
    $menu ='';
    if ($user_role == 1){
        $menu =  'Categories';
    } elseif ($user_role == 2) {
        $menu =  'My offers';
    } else {
        $menu =  'offers';
    }
    return $menu;
}