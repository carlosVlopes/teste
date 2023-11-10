<?php

namespace App\adms\Models;

class GaleriaInstagramModel
{
    public function __construct($query){

        $this->query = $query;

    }

    public function upload($file)
    {
        $this->query['upload']->upload($file, 1, "../app/sts/assets/img/instagram/");

        if(!$this->query['upload']->getResult()) return false;

        $data['image'] = $this->query['upload']->nameImage();

        $orderby = self::getEndOrder();

        $data['orderby'] = $orderby['orderby'] + 1;

        $this->query['create']->exeCreate("hm_galery_instagram", $data);

        return $this->query['create']->getResult();
    }

    public function delete($id)
    {
        $this->query['delete']->delete('hm_galery_instagram', "WHERE id_picture=:id_picture", "id_picture={$id['id']}");

        $result = $this->query['delete']->getResult();

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }


    public function getGaleria()
    {

        $this->query['select']->exeSelect("hm_galery_instagram", '', "ORDER BY orderby", "");

        return $this->query['select']->getResult();

    }

    public function edit($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $this->query['update']->exeUpdate("hm_galery_instagram", $data, "WHERE id_picture=:id_picture", "id_picture={$id}");

        $result = $this->query['update']->getResult();

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }

    private function getEndOrder()
    {
        $this->query['select']->exeSelect("hm_galery_instagram", 'orderby', 'ORDER BY orderby DESC limit 1', "");

        $result = $this->query['select']->getResult();

        return $result[0];
    }

}
