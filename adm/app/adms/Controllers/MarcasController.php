<?php

namespace App\adms\Controllers;

class MarcasController
{
    private int|null $qnt_records = 10;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

        $this->pageAdd = URLADM . 'marcas/insert';

        $this->pageEdit = URLADM . 'marcas/edit';

        $this->pageDelete = URLADM . 'marcas/delete';

        $this->pageReturn = URLADM . 'marcas';

        $this->data['sidebarActive'] = "marcas";

    }

    public function index($page = null) // toda listagem chama o index que chama o list.
    {

        $this->page = (int) $page ? $page : 1;

        self::list();

    }

    public function list()
    {
        $error = false;

        $data = $this->model->list($this->page, $this->qnt_records);

        if(!$data) $error = true;

        $pagination = $this->model->getResultPg();

        require_once "app/adms/Views/marcas/_list.php";
    }

    public function insert()
    {

        $success = false;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($this->dataForm['addCategory'])){

            unset($this->dataForm['addCategory']);

            if($this->model->insert($this->dataForm)){

               $success = true;

            }

        }

        require_once "app/adms/Views/marcas/_insert.php";

    }

    public function edit()
    {
        $data = $_POST;

        if(!$data['id'] && !$data['orderby'] && !$data['name']){

            echo json_encode(['status' => 'error']);
            exit;

        }

        $result = $this->model->edit($data);

        echo json_encode($result);

        exit;

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