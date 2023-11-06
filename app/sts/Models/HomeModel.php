<?php

namespace Sts\Models;

class HomeModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    // public function get_products(): array|null
    // {

    //     $this->query['select']->exeSelect("pr_products", '', 'ORDER BY orderby ASC', '');

    //     $data =$this->query['select']->getResult();

    //     return $data;
    // }

    // public function get_products_category($category)
    // {

    //     $this->query['fullRead']->fullRead("SELECT pr.*, ct.name AS name_category
    //                                         FROM pr_products AS pr
    //                                         INNER JOIN pr_categories AS ct
    //                                         ON ct.id_category = pr.id_category
    //                                         WHERE ct.name = :category", "category={$category}");

    //     return $this->query['fullRead']->getResult();

    // }

    public function get_banners()
    {

        $this->query['select']->exeSelect("hm_banners", '', 'WHERE status = :status ORDER BY orderby ASC', 'status=Ativo');

        $result = $this->query['select']->getResult();

        return $result;

    }

    public function get_itens()
    {

        $this->query['fullRead']->fullRead("SELECT * FROM hm_main_items ORDER BY orderby", '');

        $result = $this->query['fullRead']->getResult();

        return $result;

    }

    public function get_products()
    {

        $this->query['fullRead']->fullRead("SELECT * FROM pr_products ORDER BY orderby", '');

        $result = $this->query['fullRead']->getResult();

        return $result;

    }

}
