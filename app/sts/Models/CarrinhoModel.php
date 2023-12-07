<?php

namespace Sts\Models;

class CarrinhoModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    public function get_products($id_user, $get_total_price = false)
    {

        // $products = $this->query['fullRead']->fullRead("SELECT pr.id_product,pr.name, pr.price, pr.image, COUNT(cr.id_product) as qnt_product, cr.color, cr.size
        //                                                     FROM cr_cart_association AS cr
        //                                                     INNER JOIN pr_products AS pr
        //                                                     ON cr.id_product = pr.id_product
        //                                                     WHERE cr.id_user = :id_user
        //                                                     GROUP BY pr.name", "id_user={$id_user}");


        $products = $this->query['fullRead']->query("SELECT pr.id_product,pr.name, pr.price, pr.image, COUNT(cr.id_product) as qnt_product,cr.color, cr.size
                                                        FROM cr_cart_association AS cr
                                                        INNER JOIN pr_products AS pr
                                                        ON cr.id_product = pr.id_product
                                                        WHERE cr.id_user = :id_user
                                                        GROUP BY NAME, size
                                                        ORDER BY NAME ASC", [],"id_user={$id_user}", ['s']);

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

        return $this->query['fullRead']->query("SELECT * FROM cr_cart WHERE id_user = :id", [],"id={$id_user}", ['s'])[0];

    }

    public function addCart($id_product)
    {
        $data['id_user'] = $_SESSION['site_user_id'];

        $data['id_product'] = $id_product;

        $result = $this->query['fullRead']->query("INSERT INTO cr_cart_association :data", $data, '', ['i']);

        return ($result) ? ['status' => 'success'] : ['status' => 'error'];

    }

    private function get_price_discont($total_price_cart)
    {
        $coupon_active = $this->query['fullRead']->query("SELECT * FROM cr_cart WHERE id_user = :id_user", [],"id_user={$_SESSION['site_user_id']}", ['s'])[0];

        $price_cart_discont = $total_price_cart;

        if($coupon_active){

            $price = (float) str_replace(',','.',explode('R$', $total_price_cart)[1]);

            $price_cart_discont = number_format($price - ($price / 100 * (int) $coupon_active['percent_discount']), 2, ',', '');

            $this->query['fullRead']->query("UPDATE cr_cart SET :data WHERE id_user = :id_user", ['final_price_cart' => $price_cart_discont], "id_user={$_SESSION['site_user_id']}", ['u']);

        }

        return ['price_cart_discont' => $price_cart_discont];

    }

    public function replace_qnt_products($data)
    {
        $qnt_products = $data['qnt_products'];

        unset($data['qnt_products']);

        $data['id_user'] = $_SESSION['site_user_id'];

        $this->query['fullRead']->query("DELETE FROM cr_cart_association WHERE id_user = :id_user AND id_product = :id_product", [], "id_user={$_SESSION['site_user_id']}&id_product={$data['id_product']}", ['d']);

        for ($i=0; $i < $qnt_products; $i++) {

            $this->query['fullRead']->query("INSERT INTO cr_cart_association :data", $data, '', ['i']);

        }

        $total_price_cart = $this->get_products($_SESSION['site_user_id'], true);

        $result = $this->get_price_discont($total_price_cart);

        return ['status' => 'success', 'total_price_cart' => $total_price_cart, 'price_discount' => $result['price_cart_discont']];

    }

    public function delete_product_cart($id_product)
    {

        $this->query['fullRead']->query("DELETE FROM cr_cart_association WHERE id_user = :id_user AND id_product = :id_product", [], "id_user={$_SESSION['site_user_id']}&id_product={$id_product}", ['d']);

        $total_price_cart = $this->get_products($_SESSION['site_user_id'], true);

        $result = $this->get_price_discont($total_price_cart);

        return ['status' => 'success', 'total_price_cart' => $total_price_cart, 'price_discount' => $result['price_cart_discont']];

    }

    public function add_coupon($coupon)
    {
        $result = $this->query['fullRead']->query("SELECT * FROM cp_coupons WHERE code = :code", [], "code={$coupon}", ['s']);

        if($result){

            $total_price_cart = $this->get_products($_SESSION['site_user_id'], true);

            $price = (float) str_replace(',','.',explode('R$', $total_price_cart)[1]);

            $price_cart = number_format($price - ($price / 100 * (int) $result[0]['percent_discount']), 2, ',', '');

            $cart = $this->query['fullRead']->query("SELECT * FROM cr_cart WHERE id_user = :id_user", [], "id_user={$_SESSION['site_user_id']}", ['s']);

            if($cart){ // caso o usuario ja tenho um carrinho ativo

                $coupon_active = $this->query['fullRead']->query("SELECT * FROM cr_cart WHERE id_user = :id_user AND coupon_active <> ''", [], "id_user={$_SESSION['site_user_id']}", ['s']);

                if($coupon_active) return ['status' => 'success', 'coupon_active' => 'true'];

                $this->query['fullRead']->query("UPDATE cr_cart SET :data WHERE id_user = :id_user", ['coupon_active' => $coupon, 'final_price_cart' => $price_cart, 'percent_discount' => $result[0]['percent_discount']], "id_user={$_SESSION['site_user_id']}", ['u']);

            }else{ // caso nao tenha

                $this->query['fullRead']->query("INSERT INTO cr_cart :data", ['id_user' => $_SESSION['site_user_id'], 'coupon_active' => $result[0]['code'], 'final_price_cart' => $price_cart, 'percent_discount' => $result[0]['percent_discount']], '', ['i']);

            }

        }

        return ($result) ? ['status' => 'success', 'discount' => $result[0]['percent_discount'], 'total_price_cart' => $total_price_cart] : ['status' => 'error'];

    }

    public function remove_coupon()
    {
        $total_price_cart = explode('R$', $this->get_products($_SESSION['site_user_id'], true))[1];

        $result = $this->query['fullRead']->query("UPDATE cr_cart SET :data WHERE id_user = :id_user", ['coupon_active' => '', 'final_price_cart' => $total_price_cart, 'percent_discount' => 0], "id_user={$_SESSION['site_user_id']}", ['u']);

        return ($result) ? ['status' => 'success', 'total_price_cart' => $total_price_cart] : ['status' => 'error'];

    }

}
