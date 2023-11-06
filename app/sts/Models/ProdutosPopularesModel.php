<?php

namespace Sts\Models;

class ProdutosPopularesModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    public function get_popular_products()
    {
        $this->query['select']->exeSelect("pr_products", '', 'ORDER BY amount_sales DESC', '');

        $data =$this->query['select']->getResult();

        return $data;
    }


}
