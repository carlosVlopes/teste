<?php

namespace App\adms\Controllers;


class BannersHomeController
{
    private int|null $qnt_records = 10;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

        $this->pageAdd = URLADM . 'banners-home/insert';

        $this->pageEdit = URLADM . 'banners-home/edit';

        $this->pageDelete = URLADM . 'banners-home/delete';

        $this->pageReturn = URLADM . 'banners-home/index';

        $this->data['sidebarActive'] = "banners-home";

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

        require_once "app/adms/Views/banners/_list.php";

    }

    public function insert()
    {
        if(isset($this->sessionPermi['u_add'])){

            $success = false;

            $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $collections = $this->model->get_collections();

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                if($_FILES['banner']['error'] == 0){
                    $this->dataForm['banner'] = $_FILES['banner'] ? $_FILES['banner'] : null;
                }

                if($this->model->create($this->dataForm)){

                    $success = true;

                }
            }

            require_once "app/adms/Views/banners/_insert.php";

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

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                if($_FILES['banner']['error'] == 0){
                    $this->dataForm['banner'] = $_FILES['banner'] ? $_FILES['banner'] : null;
                }

                if($this->model->create($this->dataForm, $id)){

                   $success = true;

                }
            }else{

                $data = $this->model->getInfo($id);
            }

            require_once "app/adms/Views/banners/_edit.php";

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

        if($data['orderby'] < 1){

            echo json_encode(['status' => 'error', 'message' => 'O campo deve ser maior que 0!']);
            exit;

        }

        $result = $this->model->editOrder($data);

        echo json_encode($result);

        exit;

    }

    public function toggleStatus()
    {
        $data = $_POST;

        $data['status'] = ($data['status'] == "Ativar") ? "Ativo" : "Inativo";

        echo json_encode($this->model->toggle_status($data));

        exit;

    }

}