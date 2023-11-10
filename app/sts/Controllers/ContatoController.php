<?php

namespace Sts\Controllers;

class ContatoController
{

    public function __construct($model, $config_cart){

        $this->model = $model;

        $this->products_cart = $config_cart;

        $this->page = 'contato';

    }

    public function index(): void
    {
        // $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // if (!empty($this->dataForm['AddContMsg'])) {

        //     unset($this->dataForm['AddContMsg']);

        //     $this->model->create($this->dataForm);
        // }

        // $content = $this->model->get_info();
        require_once "app/sts/Views/contact/contact.php";

    }

    public function teste()
    {

        $data = $_POST;

        $data['message'] = explode('=', $data['data'])[1];

        unset($data['data']);

        echo json_encode($this->model->saveContact($data));

        exit;

    }

}
