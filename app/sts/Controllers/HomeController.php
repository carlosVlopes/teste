<?php

namespace Sts\Controllers;

class HomeController
{
    
    public function __construct($model, $config_cart_likes){

        $this->model = $model;

        $this->pageReturn = URL . 'home' ;

        $this->pageAddCart = URL . 'carrinho/addCart' ;

        $this->config_cart_likes = $config_cart_likes;

        $this->page = 'home';
    }

    public function index()
    {
        $data = $this->model->getInfos();

        $main_banners = $data['banners'];

        $main_itens = $data['itens'];

        $new_products = $data['new_products'];

        $best_seller_products = $data['best_seller_products'];

        $main_promotion = $data['main_promotion'];

        $galery_instagram = $data['galery_instagram'];

        require_once "app/sts/Views/home/_view.php";
    }
}