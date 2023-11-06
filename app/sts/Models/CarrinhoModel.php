<?php

namespace Sts\Models;

class CarrinhoModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    public function get_products(): array|null
    {

        $this->query['select']->exeSelect("pr_products", '', 'ORDER BY orderby ASC', '');

        $data =$this->query['select']->getResult();

        return $data;
    }

    public function get_products_category($category)
    {

        $this->query['fullRead']->fullRead("SELECT pr.*, ct.name AS name_category
                                            FROM pr_products AS pr
                                            INNER JOIN pr_categories AS ct
                                            ON ct.id_category = pr.id_category
                                            WHERE ct.name = :category", "category={$category}");

        return $this->query['fullRead']->getResult();

    }

}
