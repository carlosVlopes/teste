<?php

namespace Sts\Models;

class ContatoModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    public function saveContact(array $data)
    {
        $this->query['create']->exeCreate("ct_contacts", $data);

        if (!$this->query['create']->getResult()) return ['status' => 'error'];

        return ['status' => 'success'];
    }

}
