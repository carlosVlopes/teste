<?php

namespace Sts\Controllers;


/**
 * Controller da página SobreEmpresa
 *
 * @author Cesar <cesar@celke.com.br>
 */
class SobreEmpresaController
{

    public function __construct($model, $conf_footer){

        $this->model = $model;

        $this->conf_footer = $conf_footer;

    }

    public function index()
    {

        $abouts = $this->model->index();

        require_once "app/sts/Views/sobreEmpresa/sobreEmpresa.php";
    }
}
