<?php

namespace Sts\Models;

class ItensCurtidosModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }


    public function add_likes($id_product)
    {
        $data['id_user'] = $_SESSION['user_id'];

        $data['id_product'] = $id_product;

        $this->query['create']->exeCreate("lk_likes_association", $data);

        $result = $this->query['create']->getResult();

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];

    }

    public function remove_likes($id_product)
    {
        $id_user = $_SESSION['user_id'];

        $this->query['delete']->delete('lk_likes_association', "WHERE id_product = :id_product AND id_user = :id_user", "id_product={$id_product}&id_user={$id_user}");

        $result = $this->query['delete']->getResult();

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];

    }


}
