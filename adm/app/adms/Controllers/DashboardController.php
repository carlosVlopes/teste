<?php

namespace App\adms\Controllers;

/**
 * Controller da pagina Dashboard
 * @author Cesar <cesar@celke.com.br>
 */
class DashboardController
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

    }


    public function index():void
    {
        $this->model->getUsers();

        $this->data = $this->model->getResult();

        $this->data['sidebarActive'] = "dashboard";

        require_once "app/adms/Views/dashboard/dashboard.php";
    }
}