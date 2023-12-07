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

        $result = $this->query['fullRead']->query("SELECT * FROM pr_brands LIMIT :limit OFFSET :offset", [], "limit={$this->limitResult}&offset={$pagination->getOffset()}", ['s']);

        return ($result) ? $result : false;
    }

    public function insert($data)
    {
        $this->data = $data;

        $result = $this->query['fullRead']->query("INSERT INTO pr_brands :data", $this->data, '', ['i']);

        return ($result) ? true : false;

    }


    public function edit($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $result = $this->query['fullRead']->query("UPDATE pr_brands SET :data WHERE id_brand=:id_brand", $data, "id_brand={$id}", ['u']);

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }


    public function delete($id)
    {
        $result = $this->query['fullRead']->query("DELETE FROM pr_brands WHERE id_brand=:id_brand", [], "id_brand={$id['id']}", ['d']);

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }

}
