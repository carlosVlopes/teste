<?php

namespace Sts\Controllers;

class CarrinhoController
{
    
    public function __construct($model){

        $this->model = $model;

        $this->pageReturn = URL . 'home' ;

    }

    public function index()
    {

        require_once "app/sts/Views/carrinho/_view.php";
    }
}