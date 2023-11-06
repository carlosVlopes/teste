<?php

namespace App\adms\Models;

use Core\helper\Pagination;

class ItensPrincipaisModel
{

    private int $page;

    private string|null $resultPg;

    private int $limitResult;


    public function __construct($query){

        $this->query = $query;

    }

    function getResultPg(): string|null
    {
        return $this->resultPg;
    }

    public function list(int $page = null, int $qnt_records)
    {
        $this->page = (int) $page ? $page : 1;

        $this->limitResult = $qnt_records;

        $pagination = new Pagination(URLADM . 'itens-principais/index', 'hm_main_items', '', 'id_item');

        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination();

        $this->resultPg = $pagination->getResult();

        $this->query['fullRead']->fullRead("SELECT * FROM hm_main_items ORDER BY orderby LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $result = $this->query['fullRead']->getResult();

        return ($result) ? $result : false;
    }

    public function create(array $data,int|string $id = null)
    {
        $this->data = $data;

        if(isset($this->data["image"])){
            $image = $this->data["image"];
        }

        unset($this->data["image"]);

        if(isset($image)){

            $this->query['upload']->upload($image, $this->data['title'], "../app/sts/assets/img/main_items/");

            if($this->query['upload']->getResult()){
                $this->data['image'] = $this->query['upload']->nameImage();
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: A imagem só pode ser desses tipos : jpg, jpeg, gif, png</p>";

                return false;
            }

            $noVal['image'] = $this->data['image'];
        }

        unset($this->data['image']);

        $this->query['valField']->valField($this->data); // chama o metodo do objeto

        if(!$this->query['valField']->getResult()) return false;

        if(isset($image)){
            $this->data['image'] = $noVal['image'];
        }

        if(!$id){ // caso for insert

            $this->query['create']->exeCreate("hm_main_items", $this->data);

            if($this->query['create']->getResult()){
                return true;
            }else{
                return false;
            }

        }else{ // caso for editar

            $this->query['update']->exeUpdate("hm_main_items", $this->data, 'WHERE id_item = :id_item', "id_item={$id}");

            if($this->query['update']->getResult()){

                return true;

            }else{

                return false;

            }
        }

    }

    public function delete($id)
    {

        $this->query['delete']->delete('hm_main_items', "WHERE id_item=:id_item", "id_item={$id}");

        return $this->query['delete']->getResult();
    }

    public function getInfo($id)
    {

        $this->query['fullRead']->fullRead("SELECT * FROM hm_main_items WHERE id_item = :id_item","id_item={$id}");

        $result = $this->query['fullRead']->getResult();

        return $result[0];

    }


    public function editOrder($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $this->query['update']->exeUpdate("hm_main_items", $data,"WHERE id_item = :id_item", "id_item={$id}");

        $result = $this->query['update']->getResult();

        return ($result) ? ['status' => 'success', 'orderby' => $data['orderby']] : '';
    }

    public function get_collections()
    {

        $this->query['fullRead']->fullRead("SELECT * FROM pr_collections");

        $result = $this->query['fullRead']->getResult();

        return $result;

    }

    public function get_categories()
    {

        $this->query['fullRead']->fullRead("SELECT * FROM pr_categories ORDER BY orderby ASC");

        $result = $this->query['fullRead']->getResult();

        return $result;

    }


}
