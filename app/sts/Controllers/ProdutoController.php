<?php

namespace Sts\Controllers;

class ProdutoController
{

    public function __construct($model, $config_cart){

        $this->model = $model;

        $this->products_cart = $config_cart;

        $this->page = 'produto';

    }

    public function index($id)
    {
        if($id){

            $product = $this->model->get_info($id);

            $product_pictures = $this->model->get_product_pictures($id);

            $related_products = $this->model->get_related_products($product['id_category'], $product['id_product']);

            require_once "app/sts/Views/product/_view.php";
        }else{

            require_once "app/sts/Views/erro/erro.php";

        }

    }

}
