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

        $this->query['select']->exeSelect("hm_banners", '', 'WHERE status = :status ORDER BY orderby ASC', 'status=Ativo');

        $data['banners'] = $this->query['select']->getResult();

        $data['main_promotion'] = $this->query['fullRead']->fullRead("SELECT * FROM hm_main_promotion",'')[0];

        $data['itens'] = $this->query['fullRead']->fullRead("SELECT * FROM hm_main_items ORDER BY orderby", '');

        $data['galery_instagram'] = $this->query['fullRead']->fullRead("SELECT * FROM hm_galery_instagram ORDER BY orderby", '');

        $data['new_products'] = $this->query['fullRead']->fullRead("SELECT * FROM pr_products Where status = :status ORDER BY orderby", 'status=Novo');

        $data['best_seller_products'] = $this->query['fullRead']->fullRead("SELECT * FROM pr_products Where amount_sales >= :quant ORDER BY orderby", 'quant=10');

        return $data;


    }

}
