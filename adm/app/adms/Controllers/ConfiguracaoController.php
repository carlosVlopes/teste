<?php

namespace App\adms\Controllers;


class ConfiguracaoController
{
    private int|null $qnt_records = 10;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

    }

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            if($this->model->create($this->dataForm)){

                $success = true;

            }
        }else{

            $data = $this->model->getInfo();

        }

        echo '<pre>';
        print_r($data);
        echo '</pre>'; exit;

        require_once "app/adms/Views/configuracao/_edit.php";

    }

}