<?php

namespace Sts\Models;

class HomeModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    public function getInfos()
    {

        $data['banners'] = $this->query['fullRead']->query("SELECT * FROM hm_banners WHERE status = :status ORDER BY orderby ASC", [], 'status=Ativo', ['s']);

        $data['main_promotion'] = $this->query['fullRead']->query("SELECT * FROM hm_main_promotion", [], '', ['s'])[0];

        $data['itens'] = $this->query['fullRead']->query("SELECT * FROM hm_main_items ORDER BY orderby", [], '', ['s']);

        $data['galery_instagram'] = $this->query['fullRead']->query("SELECT * FROM hm_galery_instagram ORDER BY orderby", [], '', ['s']);

        $data['new_products'] = $this->query['fullRead']->query("SELECT * FROM pr_products Where status = :status ORDER BY orderby", [], 'status=Novo', ['s']);

        $data['best_seller_products'] = $this->query['fullRead']->query("SELECT * FROM pr_products Where amount_sales >= :quant ORDER BY orderby", [], 'quant=10', ['s']);

        return $data;


    }

}
