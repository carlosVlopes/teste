<?php

namespace Sts\Controllers;

class QuemSomosController
{
    
    public function __construct($model, $config_cart_likes){

        $this->model = $model;

        $this->pageReturn = URL . 'home' ;

        $this->pageAddCart = URL . 'carrinho/addCart' ;

        $this->config_cart_likes = $config_cart_likes;

        $this->page = 'quem-somos';
    }

    public function index()
    {

        $data = $this->model->get_infos();

        require_once "app/sts/Views/about/_view.php";
    }
}