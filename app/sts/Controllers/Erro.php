<?php

namespace Sts\Controllers;


/**
 * Controller da página Erro
 *
 * @author Cesar <cesar@celke.com.br>
 */
class Erro
{
    
    /** @var array|string|null $dados Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     * Instantiar a classe responsável em carregar a View
     * 
     * @return void
     */
    public function index()
    {
        $this->data = null;
        $loadView= new \Core\ConfigView("sts/Views/erro/erro", $this->data);
        $loadView->loadView();
    }
}