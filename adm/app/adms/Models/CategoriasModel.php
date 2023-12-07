<?php

namespace App\adms\Models;

use Core\helper\Pagination;

class CategoriasModel
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

        $pagination = new Pagination(URLADM . 'categorias/index', 'pr_categories', '', 'id_category');

        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination();

        $this->resultPg = $pagination->getResult();

        $result = $this->query['fullRead']->query("SELECT * FROM pr_categories LIMIT :limit OFFSET :offset", [], "limit={$this->limitResult}&offset={$pagination->getOffset()}", ['s']);

        return ($result) ? $result : false;
    }

    public function insert($data)
    {
        $this->data = $data;

        $result = $this->query['fullRead']->query("INSERT INTO pr_categories :data", $this->data, '', ['i']);

        return ($result) ? true : false;

    }


    public function edit($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $result = $this->query['fullRead']->query("UPDATE pr_categories SET :data WHERE id_category=:id_category", $data, "id_category={$id}", ['u']);

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }


    public function delete($id)
    {
        $result = $this->query['fullRead']->query("DELETE FROM pr_categories WHERE id_category = :id_category", [], "id_category={$id['id']}", ['d']);

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }

}
