<?php

namespace App\adms\Controllers;

class ContatosController
{
    private array|string|null $data;

    private string|int|null $page;

    private int|null $qnt_records = 10;

    private array|null $dataForm;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

        $this->pageDelete = URLADM . 'contatos/delete';

        $this->deleteAllContacts = URLADM . 'contatos/deleteAllContacts';

        $this->pageReturn = URLADM . 'contatos';

        $this->data['sidebarActive'] = "contatos";

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

        require_once "app/adms/Views/contatos/_list.php";
    }

    public function viewContact()
    {

        $result = $this->model->getInfo($_POST['id']);

        echo json_encode($result);

        exit;

    }

    public function delete($id_contact)
    {
        if($this->model->delete($id_contact)){

            header("Location: $this->pageReturn");

        }

    }

    public function deleteAllContacts()
    {

        if($this->model->deleteAll()){

            header("Location: $this->pageReturn");

        }

    }

}