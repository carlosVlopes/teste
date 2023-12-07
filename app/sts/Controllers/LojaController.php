<?php

namespace Sts\Controllers;

class LojaController
{
    
    public function __construct($model, $config_cart_likes){

        $this->model = $model;

        $this->pageReturn = URL . 'home' ;

        $this->page = URL . 'loja' ;

        $this->pageCarrinho = URL . 'carrinho' ;

        $this->configs = $this->model->get_configs();

        $this->config_cart_likes = $config_cart_likes;

        $this->page = 'loja';

    }

    public function index()
    {
        $filter = $_GET;

        $error = $title_filter = '';

        $products = $this->model->get_products();

        if(isset($_POST['name'])){

            $search = $_POST['name'];

            $products = $this->model->searchName($search);

            if(!$products) $error = true;

        }

        if(isset($filter['categoria'])){

            $category = $filter['categoria'];

            $title_filter = $category;

            if($category == "Masculino" || $category == "Feminino"){

                $products = $this->model->filter_gender($category);

            }else{

                $products = $this->model->filter_category($category);

            }

        }

        if(isset($filter['marca'])){

            $brand = $filter['marca'];

            $title_filter = $brand;

            $products = $this->model->filter_brand($brand);

        }

        require_once "app/sts/Views/loja/_list.php";
    }

}