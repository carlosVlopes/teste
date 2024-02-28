<?php

namespace Sts\Controllers;

class CheckoutController
{

    public function __construct($model, $config_cart){

        $this->model = $model;

        $this->config_cart_likes = $config_cart;

        $this->page = 'carrinho';

    }

    public function index()
    {

        $products = $this->model->get_products($_SESSION['site_user_id']);

        $total_price_cart = $products['total_price_cart'];

        unset($products['total_price_cart']);

        $cart = $this->model->get_cart($_SESSION['site_user_id']);

        require_once "app/sts/Views/checkout/_view.php";

    }

    public function teste()
    {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>'; exit;

    }


}
