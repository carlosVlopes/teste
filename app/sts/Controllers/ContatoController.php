<?php

namespace Sts\Controllers;

class ContatoController
{

    public function __construct($model){

        $this->model = $model;

    }

    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['AddContMsg'])) {

            unset($this->dataForm['AddContMsg']);

            $this->model->create($this->dataForm);
        }

        $content = $this->model->get_info();
        require_once "app/sts/Views/contato/contato.php";

    }
}
