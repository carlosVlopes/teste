<?php

namespace Sts\Models;

class QuemSomosModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    public function get_infos()
    {

        $data['texts'] = $this->query['fullRead']->fullRead("SELECT * FROM ab_texts LIMIT 1")[0];

        $data['team'] = $this->query['fullRead']->fullRead("SELECT * FROM ab_team ORDER BY orderby ASC");

        $data['companies'] = $this->query['fullRead']->fullRead("SELECT * FROM ab_partner_companies ORDER BY orderby ASC");

        return $data;


    }

}
