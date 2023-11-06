<?php

namespace Sts\Controllers;

class NovidadesController
{
    
    public function __construct($model){

        $this->model = $model;

        $this->pageReturn = URL . 'home' ;

    }

    public function index()
    {
        $error = false;

        $data = $this->model->get_products_news();

        if(!$data) $error = true;

        require_once "app/sts/Views/novidades/_view.php";
    }
}