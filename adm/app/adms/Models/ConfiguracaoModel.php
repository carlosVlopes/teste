<?php

namespace App\adms\Models;

use Core\helper\Pagination;

class ConfiguracaoModel
{

    private int $page;

    private string|null $resultPg;

    private int $limitResult;


    public function __construct($query){

        $this->query = $query;

    }

    public function create(array $data)
    {
        $this->data = $data;

        $this->query['valField']->valField($this->data);

        if(!$this->query['valField']->getResult()) return false;

        $result = $this->query['fullRead']->query("UPDATE ab_texts SET :data WHERE id_about = :id_about", $this->data, "id_about=1", ['u']);

        return ($result) ? true : false;
    }

    public function getInfo()
    {
        $result = $this->query['fullRead']->query("SELECT * FROM cn_configurations LIMIT 1",[], '', ['s']);

        return $result[0];

    }

}
