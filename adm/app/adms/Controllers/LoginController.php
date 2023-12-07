<?php

namespace App\Adms\Controllers;

class LoginController
{

    public function __construct($model, $sessionPermi)
    {

        $this->model = $model;

    }

    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);        

        if(!empty($this->dataForm['SendLogin'])){

            unset($this->dataForm['SendLogin']);

            if($this->model->login($this->dataForm)){
                $urlRedirect = URLADM . "dashboard/index";
                header("Location: $urlRedirect");
            }
        }

        require_once "app/adms/Views/login/login.php";
    }


}
