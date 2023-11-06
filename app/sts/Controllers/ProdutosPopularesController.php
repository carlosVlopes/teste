<?php

namespace Sts\Controllers;

class ProdutosPopularesController
{
    
    public function __construct($model){

        $this->model = $model;

        $this->pageReturn = URL . 'home' ;

    }

    public function index()
    {
        $data = $this->model->get_popular_products();

        require_once "app/sts/Views/produtos-populares/_view.php";
    }
}