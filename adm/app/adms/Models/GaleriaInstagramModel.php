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

        $result = $this->query['fullRead']->query("INSERT INTO hm_galery_instagram :data", $data, '', ['i']);

        return ($result) ? true : false;
    }

    public function delete($id)
    {
        $result = $this->query['fullRead']->query("DELETE FROM hm_galery_instagram WHERE id_picture=:id_picture", [], "id_picture={$id['id']}", ['d']);

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }


    public function getGaleria()
    {

        return $this->query['fullRead']->query("SELECT * FROM hm_galery_instagram ORDER BY orderby", [], "", ['s']);

    }

    public function edit($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $result = $this->query['fullRead']->query("UPDATE hm_galery_instagram SET :data WHERE id_picture = :id_picture", $data, "id_picture={$id}", ['u']);

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }

    private function getEndOrder()
    {
        $result = $this->query['fullRead']->query("SELECT orderby FROM hm_galery_instagram ORDER BY orderby DESC limit 1", [], '', ['s']);

        return $result[0];
    }

}
