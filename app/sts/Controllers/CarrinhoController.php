<?php

namespace Sts\Controllers;

class CarrinhoController
{

    public function __construct($model, $config_cart){

        $this->model = $model;

        $this->products_cart = $config_cart;

        $this->page = 'carrinho';

    }

    public function index()
    {

        echo '<pre>';
        print_r('as');
        echo '</pre>'; exit;

    }

    public function addCart()
    {
        if((!isset($_SESSION['user_id'])) and (!isset($_SESSION['user_name']))  and (!isset($_SESSION['user_email']))){

            echo json_encode(['status' => 'no_logged']);

            exit;

        }

        $id_product = $_POST['id'];

        echo json_encode($this->model->addCart($id_product));

        exit;


    }

}
