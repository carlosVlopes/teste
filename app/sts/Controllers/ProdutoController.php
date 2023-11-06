<?php

namespace Sts\Controllers;

class ProdutoController
{

    public function __construct($model){

        $this->model = $model;

    }

    public function index($id)
    {
        if($id){

            $product = $this->model->get_info($id);

            $product_pictures = $this->model->get_product_pictures($id);

            $related_products = $this->model->get_related_products($product['id_category'], $product['id_product']);

            require_once "app/sts/Views/product/_view.php";
        }else{

            echo '<pre>';
            print_r('listagem');
            echo '</pre>'; exit;

            require_once "app/sts/Views/erro/erro.php";

        }

    }

}
