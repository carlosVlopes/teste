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

        $this->query['select']->exeSelect("ct_contacts", "","LIMIT :limit OFFSET :offset" , "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $result = $this->query['select']->getResult();

        return ($result) ? $result : false;
    }

    public function delete($id)
    {
        $this->query['delete']->delete('ct_contacts', "WHERE id_contact=:id_contact", "id_contact={$id}");

        $result = $this->query['delete']->getResult();

        return ($result) ? true : false;
    }

    public function deleteAll()
    {
        $this->query['delete']->delete('ct_contacts', "", "");

        $result = $this->query['delete']->getResult();

        return ($result) ? true : false;
    }

    public function getInfo($id)
    {

        $result = $this->query['fullRead']->fullRead("SELECT * FROM ct_contacts WHERE id_contact = :id_contact", "id_contact={$id}");

        return ($result) ? ['date_contact' => $result[0], 'status' => 'success'] : ['status' => 'error'];

    }

}
