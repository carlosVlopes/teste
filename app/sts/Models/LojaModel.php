<?php

namespace Sts\Models;

class LojaModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    public function get_configs()
    {

        $data['categories'] = $this->query['fullRead']->fullRead("SELECT * FROM pr_categories ORDER BY orderby");

        $data['brands'] = $this->query['fullRead']->fullRead("SELECT * FROM pr_brands ORDER BY orderby");

        $amount_categories = [];

        foreach($data['categories'] as $category){

            $amount = $this->query['fullRead']->fullRead("SELECT COUNT(*) as a FROM pr_products WHERE id_category = :id_category", "id_category={$category["id_category"]}");

            $amount_categories[$category["name"]] = $amount[0]['a'];

        }

        $amount_gender = $this->query['fullRead']->fullRead("SELECT (SELECT COUNT(*) FROM pr_products WHERE gender = :masc OR gender = :uni) AS qnt_masc,
                                                         (SELECT COUNT(*) FROM pr_products WHERE gender = :femi OR gender = :uni) AS qnt_fm", "masc=Masculino&femi=Feminino&uni=Unisex");

        $amount_categories = array_merge($amount_gender[0], $amount_categories);

        $data['amount_categories'] = $amount_categories;

        return $data;
    }


    public function get_products()
    {

        return $this->query['fullRead']->fullRead("SELECT * FROM pr_products WHERE main_promotion <> :a ORDER BY orderby", "a=Ativo");

    }

    public function filter_gender($gender)
    {

        return $this->query['fullRead']->fullRead("SELECT * FROM pr_products WHERE gender = :gender OR gender = :other ORDER BY orderby", "gender={$gender}&other=Unisex");

    }

    public function filter_brand($brand)
    {
        return $this->query['fullRead']->fullRead("SELECT * FROM pr_products WHERE brand = :brand ORDER BY orderby", "brand={$brand}");

    }

    public function filter_category($category)
    {
        return $this->query['fullRead']->fullRead("SELECT pr.*,ct.name AS name_category FROM pr_products AS pr
                                                    INNER JOIN pr_categories AS ct
                                                    ON ct.id_category = pr.id_category
                                                    WHERE ct.name = :category ORDER BY orderby", "category={$category}");

    }


    public function searchName($name)
    {

        $data = $this->query['fullRead']->fullRead("SELECT * FROM pr_products WHERE name LIKE :name", "name=%{$name}%");

        return $data;

    }


}
