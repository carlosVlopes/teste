<?php

namespace Sts\Models;

class SobreEmpresaModel
{
    public function __construct($query)
    {

        $this->query = $query;

    }

    public function index(): array|null
    {    
        $this->query['fullRead']->fullRead("SELECT id, title, description, image
                            FROM sts_abouts_companies 
                            WHERE sts_situation_id=:sts_situation_id
                            ORDER BY id DESC  
                            LIMIT :limit", "sts_situation_id=1&limit=10");
        $data = $this->query['fullRead']->getResult();

        return $data;
    }
}
