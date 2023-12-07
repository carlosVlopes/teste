<?php

namespace App\adms\Controllers;


class TextosController
{
    private int|null $qnt_records = 10;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

        $this->pageReturn = URLADM . 'textos/index';

        $this->data['sidebarActive'] = "textos";

    }
    public function index($id)
    {
        $success = false;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            if($this->model->create($this->dataForm)){

                $success = true;

            }
        }else{

            $data = $this->model->getInfo();

        }

        require_once "app/adms/Views/textos/_edit.php";

    }

}