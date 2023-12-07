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

        $result = $this->query['fullRead']->query("SELECT * FROM hm_main_items ORDER BY orderby LIMIT :limit OFFSET :offset", [], "limit={$this->limitResult}&offset={$pagination->getOffset()}", ['s']);

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

            $result = $this->query['fullRead']->query("INSERT INTO hm_main_items :data", $this->data, '', ['i']);

            return ($result) ? true : false;


        }else{ // caso for editar

            $result = $this->query['fullRead']->query("UPDATE hm_main_items SET :data WHERE id_item = :id_item", $this->data, "id_item={$id}", ['u']);

            return ($result) ? true : false;

        }

    }

    public function delete($id)
    {

        $result = $this->query['fullRead']->query("DELETE FROM hm_main_items WHERE id_item=:id_item", [], "id_item={$id}", ['d']);

        return ($result) ? true : false;
    }

    public function getInfo($id)
    {

        $result = $this->query['fullRead']->query("SELECT * FROM hm_main_items WHERE id_item = :id_item", [], "id_item={$id}", ['s']);

        return $result[0];

    }


    public function editOrder($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $result = $this->query['fullRead']->query("UPDATE hm_main_items SET :data WHERE id_item = :id_item", $data, "id_item={$id}", ['u']);

        return ($result) ? ['status' => 'success', 'orderby' => $data['orderby']] : '';
    }

    public function get_collections()
    {

        $result = $this->query['fullRead']->query("SELECT * FROM pr_collections", [], '', ['s']);

        return $result;

    }

    public function get_categories()
    {

        $result = $this->query['fullRead']->query("SELECT * FROM pr_categories ORDER BY orderby ASC", [], '', ['s']);

        return $result;

    }


}
