<?php

namespace Sts\Models;

class NovidadesModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    public function get_products_news()
    {
        $this->query['fullRead']->fullRead("SELECT * FROM pr_products WHERE new = :new", "new=Ativo");

        $data = $this->query['fullRead']->getResult();

        return $data;
    }


}
