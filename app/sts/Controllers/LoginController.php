<?php

namespace Sts\Controllers;

class LoginController
{

    public function __construct($model, $config_cart){

        $this->model = $model;

        $this->pageReturn = URL . 'home' ;

        $this->products_cart = $config_cart;

        $this->page = 'login';

    }

    public function index()
    {

        $user = $this->model->get_user();

        $_SESSION['site_user_id'] = $user['id_user'];

        $_SESSION['site_user_name'] = $user['name'];

        $_SESSION['site_user_email'] = $user['email'];

    }
}