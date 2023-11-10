<?php

namespace Sts\Models;

class LoginModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }


    public function get_user()
    {

        $data = $this->query['fullRead']->fullRead("SELECT * FROM site_users", '');

        return $data[0];

    }

}
