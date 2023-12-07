<?php

namespace App\adms\Controllers;

class CategoriasController
{
    private int|null $qnt_records = 10;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

        $this->pageAdd = URLADM . 'categorias/insert';

        $this->pageEdit = URLADM . 'categorias/edit';

        $this->pageDelete = URLADM . 'categorias/delete';

        $this->pageReturn = URLADM . 'categorias';

        $this->data['sidebarActive'] = "categorias";

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

        require_once "app/adms/Views/categorias/_list.php";
    }

    public function insert()
    {
        if(isset($this->sessionPermi['u_add'])){

            $success = false;

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if(!empty($this->dataForm['addCategory'])){

                unset($this->dataForm['addCategory']);

                if($this->model->insert($this->dataForm)){

                   $success = true;

                }

            }

            require_once "app/adms/Views/categorias/_insert.php";

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }
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