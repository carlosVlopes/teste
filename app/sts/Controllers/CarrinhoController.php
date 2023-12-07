<?php

namespace Sts\Controllers;

class CarrinhoController
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

        require_once "app/sts/Views/cart/_view.php";

    }

    public function addCart()
    {
        if((!isset($_SESSION['site_user_id'])) and (!isset($_SESSION['site_user_name']))  and (!isset($_SESSION['site_user_email']))){

            echo json_encode(['status' => 'no_logged']);

            exit;

        }

        $id_product = $_POST['id'];

        echo json_encode($this->model->addCart($id_product));

        exit;


    }

    public function qntProductsCart()
    {

        $data = $_POST;

        if(!isset($data['id_product']) || !isset($data['qnt_products']))
        {
            echo json_encode(['status' => 'error']);

            exit;
        }

        echo json_encode($this->model->replace_qnt_products($data));

        exit;

    }

    public function deleteProductCart()
    {

        $id_product = $_POST['id_product'];

        if(!isset($id_product))
        {
            echo json_encode(['status' => 'error']);

            exit;
        }

        echo json_encode($this->model->delete_product_cart($id_product));

        exit;

    }

    public function addCoupon()
    {

        $coupon = $_POST['coupon'];

        if(!isset($coupon))
        {
            echo json_encode(['status' => 'error']);

            exit;
        }

        echo json_encode($this->model->add_coupon($coupon));

        exit;

    }

    public function removeCoupon()
    {

        echo json_encode($this->model->remove_coupon());

        exit;

    }


}
