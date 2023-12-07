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
        $data['date_contact'] = date('Y-m-d');

        $result = $this->query['fullRead']->query("INSERT INTO ct_contacts :data", $data, '', ['i']);

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];

    }

}
