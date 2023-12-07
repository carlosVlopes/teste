<?php

namespace Sts\Controllers;

class ItensCurtidosController
{

    public function __construct($model, $config_cart_likes){

        $this->model = $model;

        $this->page = 'itens-curtidos';

        $this->config_cart_likes = $config_cart_likes;

    }

    public function index()
    {
        $error = $title_filter = '';

        $products = $this->model->get_products($_SESSION['site_user_id']);

        if(!$products) $error = true;

        require_once "app/sts/Views/likes/_list.php";

    }

    public function addLikes()
    {
        if((!isset($_SESSION['site_user_id'])) and (!isset($_SESSION['site_user_name']))  and (!isset($_SESSION['site_user_email']))){

            echo json_encode(['status' => 'no_logged']);

            exit;

        }

        $id_product = $_POST['id'];

        echo json_encode($this->model->add_likes($id_product));

        exit;


    }

    public function removeLikes()
    {
        if((!isset($_SESSION['site_user_id'])) and (!isset($_SESSION['site_user_name']))  and (!isset($_SESSION['site_user_email']))){

            echo json_encode(['status' => 'no_logged']);

            exit;

        }

        $id_product = $_POST['id'];

        echo json_encode($this->model->remove_likes($id_product));

        exit;


    }


}
