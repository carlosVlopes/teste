<?php

namespace App\adms\Controllers;


class ItensPrincipaisController
{
    private array|string|null $data;

    private string|int|null $page;

    private int|null $qnt_records = 10;

    private array|null $dataForm;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

        $this->pageAdd = URLADM . 'itens-principais/insert';

        $this->pageEdit = URLADM . 'itens-principais/edit';

        $this->pageDelete = URLADM . 'itens-principais/delete';

        $this->pageReturn = URLADM . 'itens-principais/index';

        $this->data['sidebarActive'] = "itens-principais";

    }
    public function index($page)
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

        require_once "app/adms/Views/itens-principais/_list.php";

    }

    public function insert()
    {
        if(isset($this->sessionPermi['u_add'])){

            $success = false;

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $collections = $this->model->get_collections();

            $categories = $this->model->get_categories();

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                if($_FILES['image']['error'] == 0){
                    $this->dataForm['image'] = $_FILES['image'] ? $_FILES['image'] : null;
                }

                if($this->model->create($this->dataForm)){

                    $success = true;

                }
            }

            require_once "app/adms/Views/itens-principais/_insert.php";

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }

    }

    public function edit($id)
    {
        if(isset($this->sessionPermi['u_edit'])){

            $success = false;

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $collections = $this->model->get_collections();

            $categories = $this->model->get_categories();

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                if($_FILES['image']['error'] == 0){
                    $this->dataForm['image'] = $_FILES['image'] ? $_FILES['image'] : null;
                }

                if($this->model->create($this->dataForm, $id)){

                   $success = true;

                }
            }else{

                $data = $this->model->getInfo($id);
            }

            require_once "app/adms/Views/itens-principais/_edit.php";

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }

    }

    public function delete($id)
    {
        if(isset($this->sessionPermi['u_delete'])){

            if($this->model->delete($id)){
                header("Location: $this->pageReturn");
            }

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Voce nao tem permissao para acessar essa pagina</p>";
            $urlRedirect = URLADM . "erro/index";
            header("Location: $urlRedirect");
        }
    }

    public function editOrder()
    {
        $data = $_POST;

        if(!$data['id'] && !$data['order']){

            echo json_encode(['status' => 'error']);
            exit;

        }

        if($data['orderby'] != 1 || $data['orderby'] != 2 || $data['orderby'] != 3){

            echo json_encode(['status' => 'error', 'message' => 'O campo deve ser 1 | 2 ou 3 !']);
            exit;

        }

        $result = $this->model->editOrder($data);

        echo json_encode($result);

        exit;

    }

}