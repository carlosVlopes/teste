<?php

namespace Sts\Models;

class CheckoutModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    public function get_products($id_user, $get_total_price = false)
    {

        $products = $this->query['fullRead']->query("SELECT pr.id_product,pr.name, pr.price, pr.image, COUNT(cr.id_product) as qnt_product,cr.color, cr.size
                                                        FROM cr_cart_association AS cr
                                                        INNER JOIN pr_products AS pr
                                                        ON cr.id_product = pr.id_product
                                                        WHERE cr.id_user = :id_user
                                                        GROUP BY NAME, size
                                                        ORDER BY NAME ASC", [], "id_user={$id_user}", ['s']);

        $total_price_cart = 0;

        foreach($products as $key => $product){

            $price = $product['price'];

            $price_ok = $this->query['transformPrice']->transform($price);

            $total_price = $price_ok * $product['qnt_product'];

            $products[$key]['total_price'] = 'R$' . str_replace('.',',',$total_price);

            $total_price_cart += $total_price;

        }

        $products['total_price_cart'] = 'R$' . str_replace('.',',',$total_price_cart);

        if($get_total_price){

            return $products['total_price_cart'];

        }

        return $products;

    }


    public function get_cart($id_user)
    {

        return $this->query['fullRead']->query("SELECT * FROM cr_cart WHERE id_user = :id", [], "id={$id_user}", ['s'])[0];

    }

}
