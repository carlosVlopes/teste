<?php

namespace Sts\Models;

class LoginModel
{

    public function __construct($query)
    {
        $this->query = $query;

        $this->db = $query['fullRead'];

    }


    public function get_user()
    {

        return $this->query['fullRead']->query("SELECT * FROM site_users", [], '', 's')[0];

    }

}
