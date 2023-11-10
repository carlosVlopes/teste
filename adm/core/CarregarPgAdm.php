<?php

namespace Core;

/**
 * Verificar se existe a classe
 * Carregar a CONTROLLER
 * @author Cesar <cesar@celke.com.br>
 */
class CarregarPgAdm
{
    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;
    /** @var string $urlMetodo Recebe da URL o nome do método */
    private string $urlMetodo;
    /** @var string $urlParamentro Recebe da URL o parâmetro */
    private string $urlParameter;
    /** @var string $classLoad Controller que deve ser carregada */
    private string $classLoad;

    private string $controllerOriginal;

    private array $methodAjax;

    private array $sessionPermi = [];

    private array $listPgPublic;
    private array $listPgPrivate;


    /**
     * Verificar se existe a classe
     * @param string $urlController Recebe da URL o nome da controller
     * @param string $urlMetodo Recebe da URL o método
     * @param string $urlParamentro Recebe da URL o parâmetro
     */

    public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParameter, string $controllerOriginal, array $methodAjax): void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;
        $this->controllerOriginal = $controllerOriginal;
        $this->methodAjax = $methodAjax;

        if($this->urlController == "Logout"){

            unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_nickname'], $_SESSION['user_email'], $_SESSION['user_image']);
            $_SESSION['msg'] = "<p class='alert-success'>Logout realizado com sucesso!</p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");

        }

        $this->pgPublic();

        if (class_exists($this->classLoad)) {
            $this->loadMetodo();
        } else {
            $this->loadClassSts();
        }
    }

    private function loadClassSts(): void
    {
        $this->classLoad = "App\\sts\\Controllers\\" . $this->urlController . 'Controller';

        if (class_exists($this->classLoad)) {

            $this->loadMetodo(true);

        } else {

            die("Erro - 003: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
            /*$this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParameter = "";
            $this->loadPage($this->urlController, $this->urlMetodo, $this->urlParameter);*/
        }
    }

    /**
     * Verificar se existe o método e carregar a página
     *
     * @return void
     */
    private function loadMetodo($sts = false): void
    {
        ($sts) ? $model = '\\App\\sts\\Models\\' . $this->urlController . 'Model' : $model = '\\App\\adms\\Models\\' . $this->urlController . 'Model';

        if($this->urlController == 'Erro')
        {

            $controller = new \App\adms\Controllers\ErroController();

            $controller->index();

            exit;
        }

        if(!class_exists($model)){
            die("Erro - 004: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }

        // classes de querys usadas no model
        $querys = ['select' => new helper\Select(), 'fullRead' => new helper\Read() , 'delete' => new helper\Delete() , 'create' => new helper\Create(), 'update' => new helper\Update(), 'constructJson' => new helper\ConstructJson(), 'valPassword' => new helper\ValPassword(), 'valField' => new helper\ValField(), 'upload' => new helper\Upload(),'valPermissions' => new helper\ValPermissions()];

        $model = new $model($querys);

        $checkPermissions = new helper\ValPermissions();

        $sessionPermi = '';

        if($this->urlController != "Login" && $this->urlController != "Api"){

            $sessionPermi = $checkPermissions->valPermissions($_SESSION['user_id']);

            $activeMenus = $checkPermissions->valPermissions($_SESSION['user_id'], true);

            $sessionPermi = array_merge($sessionPermi, $activeMenus);

            self::checkMenusPermi($querys, $activeMenus);

        }

        $classLoad = new $this->classLoad($model, $sessionPermi);

        if(!empty($this->methodAjax['status'])){

            if($this->methodAjax['method'] != 'skin-config-html'){

                $classLoad->{$this->methodAjax['method']}();
            }

        }

        if (method_exists($classLoad, $this->urlMetodo)) {
            $classLoad->{$this->urlMetodo}($this->urlParameter);

            if($this->urlController == "Api"){

                $result = $classLoad->{$this->urlMetodo}($this->urlParameter);

                echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            }

        } else {
            // die("Erro - 004: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }


    }

    private function checkMenusPermi($querys, $activeMenus)
    {
        $querys['select']->exeSelect("cn_menus", '', 'ORDER BY orderby', '');

        $menus = $querys['select']->getResult();

        $linksMenus = [];

        foreach($menus as $menu){

            array_push($linksMenus, $menu['link']);

        }

        $linksMenusActive = [];

        foreach(array_keys($activeMenus) as $menu){

            $te = explode("m_", $menu);

            array_push($linksMenusActive, $te[1]);

        }

        if(in_array($this->controllerOriginal, $linksMenus)){

            if(!in_array($this->controllerOriginal, $linksMenusActive)){

                die('nao tem acesso a esse menu');

            }

        }

    }

    /**
     * Verificar se a página é pública e carregar a mesma
     *
     * @return void
     */
    private function pgPublic(): void
    {
        $this->listPgPublic = ["Login", "Erro", "Logout", "NewUser", "RecoverPassword", "Api", "Home"];

        if (in_array($this->urlController, $this->listPgPublic)) {
            $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController . 'Controller';
        } else {
            $this->pgPrivate();
        }
    }
    /**
     * Verificar se a página é privada e chamar o método para verificar se o usuário está logado
     *
     * @return void
     */
    private function pgPrivate():void
    {
        $this->listPgPrivate = ["Dashboard", "Usuarios", "ViewUser", "AddUser", "EditUser", "UserProfile", "UserToken", "Produtos", "ProdutosGaleria", "Categorias", "BannersHome", "ItensPrincipais", "GaleriaInstagram", "Marcas", "Contatos"];
        if(in_array($this->urlController, $this->listPgPrivate)){
            $this->verifyLogin();
        }else{

            if($this->urlController != "App"){

                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Página não encontrada! {$this->urlController}</p>";
                $urlRedirect = URLADM . "erro/index";
                header("Location: $urlRedirect");
            }

            exit;

        }
    }

    /**
     * Verificar se o usuário está logado e carregar a página
     *
     * @return void
     */
    private function verifyLogin(): void
    {
        if((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name']))  and (isset($_SESSION['user_email'])) ){
            $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController . 'Controller';
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Para acessar a página realize o login!</p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }

}
