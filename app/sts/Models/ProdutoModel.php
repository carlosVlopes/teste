<?php

namespace Sts\Models;

class ProdutoModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    public function get_info($id)
    {
        $this->query['fullRead']->fullRead("SELECT pr.*,ct.name as name_category
                                            FROM pr_products AS pr
                                            inner JOIN pr_categories AS ct
                                            ON ct.id_category = pr.id_category
                                            WHERE id_product = :id_product", "id_product={$id}");

        return $this->query['fullRead']->getResult()[0];
    }

    public function get_product_pictures($id)
    {

        $this->query['fullRead']->fullRead("SELECT * FROM pr_products_pictures WHERE id_product = :id_product ORDER BY orderby", "id_product={$id}");

        return $this->query['fullRead']->getResult();

    }

    public function get_related_products($category, $id_product)
    {

        $this->query['fullRead']->fullRead("SELECT pr.*,ct.name FROM pr_products as pr inner JOIN pr_categories AS ct
                                            ON ct.id_category = pr.id_category WHERE pr.id_category = :id_category AND id_product <> :id_product ORDER BY pr.orderby", "id_category={$category}&id_product={$id_product}");

        return $this->query['fullRead']->getResult();

    }


}
