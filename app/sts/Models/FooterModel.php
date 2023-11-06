<?php

namespace Sts\Models;

/**
 * Models responsável em buscar os dados da página home
 *
 * @author Celke
 */
class FooterModel
{
    public function __construct($query)
    {

        $this->query = $query;

    }

    public function index()
    {    
        $this->query['fullRead']->fullRead("SELECT footer_desc, footer_text_link, footer_link
                            FROM sts_footers 
                            WHERE id=:id 
                            LIMIT :limit", "id=1&limit=1");
        $this->data = $this->query['fullRead']->getResult();

        return $this->data;
    }
}
