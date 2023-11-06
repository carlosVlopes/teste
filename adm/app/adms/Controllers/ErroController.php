<?php

namespace App\adms\Controllers;

/**
 * Controller da página erro
 * @author Cesar <cesar@celke.com.br>
 */
class ErroController
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index():void
    {
        $this->data = '';

        require_once "app/adms/Views/erro/erro.php";
    }
}