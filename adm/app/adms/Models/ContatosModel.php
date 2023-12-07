<?php

namespace App\adms\Models;

use Core\helper\Pagination;

class ContatosModel
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

        $pagination = new Pagination(URLADM . 'contatos/index', 'ct_contacts', '', 'id_contact');

        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination();

        $this->resultPg = $pagination->getResult();

        $result = $this->query['fullRead']->query("SELECT * FROM ct_contacts LIMIT :limit OFFSET :offset", [], "limit={$this->limitResult}&offset={$pagination->getOffset()}", ['s']);

        return ($result) ? $result : false;
    }

    public function delete($id)
    {
        $result = $this->query['fullRead']->query("DELETE FROM ct_contacts WHERE id_contact=:id_contact", [], "id_contact={$id}", ['d']);

        return ($result) ? true : false;
    }

    public function deleteAll()
    {
        $result = $this->query['fullRead']->query("DELETE FROM ct_contacts", [], "", ['d']);

        return ($result) ? true : false;
    }

    public function getInfo($id)
    {

        $result = $this->query['fullRead']->query("SELECT * FROM ct_contacts WHERE id_contact = :id_contact", [], "id_contact={$id}", ['s']);

        return ($result) ? ['date_contact' => $result[0], 'status' => 'success'] : ['status' => 'error'];

    }

}
