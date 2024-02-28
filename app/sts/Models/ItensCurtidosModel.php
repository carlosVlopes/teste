<?php

namespace Sts\Models;

class ItensCurtidosModel
{

    public function __construct($query)
    {
        $this->query = $query;

        $this->db = $query['fullRead'];

    }

    public function get_products($id_user)
    {

        $data = $this->db->query("SELECT pr.*
                                                    FROM lk_likes_association AS lk
                                                    INNER JOIN pr_products AS pr
                                                    ON lk.id_product = pr.id_product
                                                    WHERE id_user = :id_user", [], "id_user={$id_user}", 's');

        return $data;

    }


    public function add_likes($id_product)
    {
        $data['id_user'] = $_SESSION['site_user_id'];

        $data['id_product'] = $id_product;

        $result = $this->db->query("INSERT INTO lk_likes_association :data", $data, '', 'i');

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];

    }

    public function remove_likes($id_product)
    {
        $id_user = $_SESSION['site_user_id'];

        $result = $this->db->query("DELETE FROM lk_likes_association WHERE id_product = :id_product AND id_user = :id_user", [], "id_product={$id_product}&id_user={$id_user}", 'd');

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];

    }


}
