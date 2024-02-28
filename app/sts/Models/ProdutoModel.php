<?php

namespace Sts\Models;

class ProdutoModel
{

    public function __construct($query)
    {
        $this->query = $query;

        $this->db = $query['fullRead'];

    }

    public function get_info($id)
    {
        return $this->db->query("SELECT pr.*,ct.name as name_category
                                            FROM pr_products AS pr
                                            inner JOIN pr_categories AS ct
                                            ON ct.id_category = pr.id_category
                                            WHERE id_product = :id_product", [], "id_product={$id}", 's')[0];

    }

    public function get_product_pictures($id)
    {

        return $this->db->query("SELECT * FROM pr_products_pictures WHERE id_product = :id_product ORDER BY orderby", [], "id_product={$id}", 's');

    }

    public function get_related_products($category, $id_product)
    {

        return $this->db->query("SELECT pr.*,ct.name FROM pr_products as pr inner JOIN pr_categories AS ct
                                            ON ct.id_category = pr.id_category WHERE pr.id_category = :id_category AND id_product <> :id_product ORDER BY pr.orderby", [], "id_category={$category}&id_product={$id_product}", 's');

    }


}
