<?php

namespace App\adms\Controllers;


class GaleriaInstagramController
{
    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

        $this->pageAdd = URLADM . 'galeria-instagram/insert';

        $this->pageDelete = URLADM . 'galeria-instagram/delete';

        $this->pageReturn = URLADM . 'galeria-instagram/index';

        $this->data['sidebarActive'] = "galeria-instagram";

    }

    public function index($page)
    {
        $this->page = (int) $page ? $page : 1;

        self::list();

    }

    public function list()
    {
        $error = false;

        $data = $this->model->getGaleria();

        if(!$data) $error = true;

        require_once "app/adms/Views/galeria-instagram/_list.php";

    }

    public function insert($id_product)
    {
        require_once "app/adms/Views/galeria-instagram/_insert.php";

    }

    public function edit()
    {
        $data = $_POST;

        if(!$data['id'] && !$data['orderby']){

            echo json_encode(['status' => 'error']);
            exit;

        }

        $result = $this->model->edit($data);

        echo json_encode($result);

        exit;

    }

    public function upload()
    {
        $file = $_FILES['file'];

        if($file){

            return $this->model->upload($file);

        }

    }

    public function delete()
    {
        if(!$_POST){

            echo json_encode(['status' => 'error']);
            exit;

        }

        $result = $this->model->delete($_POST);

        echo json_encode($result);

        exit;
    }

}