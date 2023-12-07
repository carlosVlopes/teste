<?php

namespace App\adms\Models;

class ProdutosGaleriaModel
{
    public function __construct($query){

        $this->query = $query;

    }

    public function upload($file, $id_product)
    {
        $this->query['upload']->upload($file, $id_product, "../app/sts/assets/img/products_pictures/");

        if(!$this->query['upload']->getResult()) return false;

        $data['image'] = $this->query['upload']->nameImage();

        $data['name'] = '';

        $orderby = self::getEndOrder($id_product);

        $data['orderby'] = $orderby['orderby'] + 1;

        $data['id_product'] = $id_product;

        $result = $this->query['fullRead']->query("INSERT INTO pr_products_pictures :data", $data, '', ['i']);

        return ($result) ? true : false;
    }

    public function delete($id)
    {
        $result = $this->query['fullRead']->query("DELETE FROM pr_products_pictures WHERE id_picture = :id_picture ", [], "id_picture={$id['id']}", ['d']);

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }


    public function getGaleria($id)
    {

        return $this->query['fullRead']->query("SELECT * FROM pr_products_pictures WHERE id_product = :id_product", [], "id_product={$id}", ['s']);

    }

    public function edit($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $result = $this->query['fullRead']->query("UPDATE pr_products_pictures SET :data WHERE id_picture = :id_picture", $data, "id_picture={$id}", ['u']);

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];
    }

    private function getEndOrder($id_product)
    {
        $result = $this->query['fullRead']->query("SELECT orderby FROM pr_products_pictures WHERE id_product = :id_product ORDER BY orderby DESC limit 1", [], "id_product={$id_product}", ['s']);

        return $result[0];
    }

}
