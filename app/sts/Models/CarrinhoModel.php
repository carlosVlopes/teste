<?php

namespace Sts\Models;

class CarrinhoModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }


    public function addCart($id_product)
    {
        $data['id_user'] = $_SESSION['user_id'];

        $data['id_product'] = $id_product;

        $this->query['create']->exeCreate("cr_cart_association", $data);

        $result = $this->query['create']->getResult();

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];

    }



}
