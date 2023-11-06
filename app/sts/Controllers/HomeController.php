<?php

namespace Sts\Controllers;

class HomeController
{
    
    public function __construct($model){

        $this->model = $model;

        $this->pageReturn = URL . 'home' ;

    }

    public function index()
    {
        // $error = false;

        // if(isset($_GET['categoria'])){

        //     $category = $_GET['categoria'];

        //     $products = $this->model->get_products_category($category);

        //     if(!$products) $error = true;

        // }else{
        //     $products = $this->model->get_products();
        // }

        $main_banners = $this->model->get_banners();

        $main_itens = $this->model->get_itens();

        $products = $this->model->get_products();

        require_once "app/sts/Views/home/_view.php";
    }
}