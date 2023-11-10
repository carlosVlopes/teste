<?php

namespace App\adms\Models;

use Core\helper\Pagination;

class MarcasModel
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

        $pagination = new Pagination(URLADM . 'marcas/index', 'pr_brands', '', 'id_brand');

        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination();

        $this->resultPg = $pagination->getResult();

        $this->query['select']->exeSelect("pr_brands", "","LIMIT :limit OFFSET :offset" , "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $result = $this->query['select']->getResult();

        return ($result) ? $result : false;
    }

    public function insert($data)
    {
        $this->data = $data;

        $this->query['create']->exeCreate("pr_brands", $this->data);

        $result = $this->query['create']->getResult();

        return ($result) ? true : false;

    }


    public function edit($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $this->query['update']->exeUpdate("pr_brands", $data, "WHERE id_brand=:id_brand", "id_brand={$id}");

        $result = $this->query['update']->getResult();

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }


    public function delete($id)
    {
        $this->query['delete']->delete('pr_brands', "WHERE id_brand=:id_brand", "id_brand={$id['id']}");

        $result = $this->query['delete']->getResult();

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }

}
