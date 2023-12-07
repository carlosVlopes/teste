<?php

namespace Core;

use Sts\Models\FooterModel;

/**
 * Recebe a URL e manipula
 * Carregar a CONTROLLER
 * 
 * @author Cesar <cesar@celke.com.br>
 */
class ConfigController extends Config
{
    /** @var string $url Recebe a URL do .htaccess */
    private string $url;
    /** @var array $urlArray Recebe a URL convertida para array */
    private array $urlArray;
    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;
    /** @var string $urlParamentro Recebe da URL o parâmetro */
    /*private string $urlParameter;*/
    private string $urlSlugController;
    /** @var array $format Recebe o array de caracteres especiais que devem ser substituido */
    private array $format;
    /** @var string $classe Recebe a classe */
    private string $classLoad;

    private $parameter = '';

    private $info = '';

    private $products_cart = [];

    /**
     * Recebe a URL do .htaccess
     * Validar a URL
     */
    public function __construct()
    {
        $this->config();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            $this->clearUrl();

            $this->urlArray = explode("/", $this->url);

            if(isset($this->urlArray[1])){
                $this->parameter = $this->urlArray[1];
            }

            if(isset($this->urlArray[2])){
                $this->info = $this->urlArray[2];
            }

            if (isset($this->urlArray[0])) {
                $this->urlController = $this->slugController($this->urlArray[0]);
            } else {
                $this->urlController = $this->slugController(CONTROLLERERRO);
            }
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
        }
    }

    /**
     * Método privado não pode ser instanciado fora da classe
     * Limpara a URL, elimando as TAG, os espaços em brancos, retirar a barra no final da URL e retirar os caracteres especiais
     *
     * @return void
     */
    private function clearUrl(): void
    {
        //Eliminar as tag
        $this->url = strip_tags($this->url);
        //Eliminar espaços em branco
        $this->url = trim($this->url);
        //Eliminar a barra no final da URL
        $this->url = rtrim($this->url, "/");
        //Eliminar caracteres 
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);
    }

    /**
     * Converter o valor obtido da URL "sobre-empresa" e converter no formato da classe "SobreEmpresa".
     * Utilizado as funções para converter tudo para minúsculo, converter o traço pelo espaço, converter cada letra da primeira palavra para maiúsculo, retirar os espaços em branco
     *
     * @param string $slugController Nome da classe
     * @return string Retorna a controller "sobre-empresa" convertido para o nome da Classe "SobreEmpresa"
     */
    private function slugController($slugController): string
    {
        //Converter para minusculo
        $this->urlSlugController = strtolower($slugController);
        //Converter o traco para espaco em braco
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        //Converter a primeira letra de cada palavra para maiusculo
        $this->urlSlugController = ucwords($this->urlSlugController);
        //Retirar espaco em branco
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);
        return $this->urlSlugController;
    }

    /**
     * Carregar as Controllers.
     * Instanciar as classes da controller e carregar o método index.
     *
     * @return void
     */
    public function loadPage(): void
    {
        $this->classLoad = "\\Sts\\Controllers\\" . $this->urlController . "Controller";
        $this->model = "\\Sts\\Models\\" . $this->urlController . "Model";

        if (class_exists($this->classLoad)) {

            if(class_exists($this->model)){
                $this->loadClass();
            }

        } else {
            $this->urlController = $this->slugController(CONTROLLERERRO);
            $this->loadPage();
        }
    }

    /**  
     * Verificar se o método existe, existindo o método carrega a página;
     * Não existindo o método, para o carregamento e apresenta mensagem de erro.
     * 
     * @return void
     */
    private function loadClass(): void
    {
        $querys = ['fullRead' => new helper\Read(), 'constructJson' => new helper\ConstructJson(), 'valPassword' => new helper\ValPassword(), 'valField' => new helper\ValField(), 'upload' => new helper\Upload(),'valPermissions' => new helper\ValPermissions(), 'transformPrice' => new helper\TransformPriceInNumber()];

        $model = new $this->model($querys);

        if(isset($_SESSION['site_user_id'])){
            $this->products_cart = $this->get_products_cart($_SESSION['site_user_id']);
        }

        $classPage = new $this->classLoad($model, $this->products_cart);

        if(method_exists($classPage, $this->parameter)){

            if($this->info){

                $classPage->{$this->parameter}($this->info);

            }else{

                $classPage->{$this->parameter}();

            }


        }

        if (method_exists($classPage, "index")) {
            $classPage->index($this->parameter);
        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }


    private function get_products_cart($id_user)
    {

        $fullRead = new helper\Read();

        $itens_likes = $fullRead->fullRead("SELECT id_product FROM lk_likes_association WHERE id_user = :id_user", "id_user={$id_user}");

        $a = $fullRead->fullRead("SELECT pr.price
                                                FROM cr_cart_association AS cr
                                                INNER JOIN pr_products AS pr
                                                ON cr.id_product = pr.id_product
                                                WHERE id_user = :id_user", "id_user={$id_user}");
        $val_total = 0;

        $qnt_products = 0;

        foreach($a as $key => $price){

            $price = $price['price'];

            $a = explode("R$", $price)[1];

            $a = (float) str_replace(',', '.', $a);

            $val_total += $a;

            $qnt_products ++;

        }

        $data['qnt_products'] = $qnt_products;

        $data['price'] = $val_total;

        $id_products_likes = [];

        foreach($itens_likes as $id_product){

            $id_product = $id_product['id_product'];

            array_push($id_products_likes, $id_product);

        }

        $data['id_products_likes'] = $id_products_likes;

        return $data;

    }

}
