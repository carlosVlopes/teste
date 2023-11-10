<?php

namespace Sts\Controllers;

class ItensCurtidosController
{

    public function __construct($model, $config_cart){

        $this->model = $model;

        $this->products_cart = $config_cart;

        $this->page = 'itens-curtidos';

    }

    public function index()
    {

        echo '<pre>';
        print_r('as');
        echo '</pre>'; exit;

    }

    public function addLikes()
    {
        if((!isset($_SESSION['user_id'])) and (!isset($_SESSION['user_name']))  and (!isset($_SESSION['user_email']))){

            echo json_encode(['status' => 'no_logged']);

            exit;

        }

        $id_product = $_POST['id'];

        echo json_encode($this->model->add_likes($id_product));

        exit;


    }

}
