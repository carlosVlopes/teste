<?php

namespace Sts\Models;

class QuemSomosModel
{

    public function __construct($query)
    {
        $this->query = $query;

        $this->db = $query['fullRead'];

    }

    public function get_infos()
    {

        $data['texts'] = $this->db->query("SELECT * FROM ab_texts LIMIT 1", [], '', 's')[0];

        $data['team'] = $this->db->query("SELECT * FROM ab_team ORDER BY orderby ASC", [], '', 's');

        $data['companies'] = $this->db->query("SELECT * FROM ab_partner_companies ORDER BY orderby ASC", [], '', 's');

        return $data;


    }

}
