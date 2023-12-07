<?php

namespace App\adms\Models;

use Core\helper\Pagination;

class ProdutosModel
{

    private int $page;

    private string|null $resultPg;

    private int $limitResult;


    public function __construct($query){

        $this->query = $query;

    }

    function getResultPg(): string|null
    {
        return $this->resultPg;
    }

    public function list(int $page = null, int $qnt_records)
    {
        $this->page = (int) $page ? $page : 1;

        $this->limitResult = $qnt_records;

        $pagination = new Pagination(URLADM . 'produtos/index', 'pr_products', '', 'id_product');

        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination();

        $this->resultPg = $pagination->getResult();

        $result = $this->query['fullRead']->query("SELECT pr.*,ct.name as name_category
                                            FROM pr_products AS pr
                                            inner JOIN pr_categories AS ct
                                            ON ct.id_category = pr.id_category", [], '', ['s']);

        return ($result) ? $result : false;
    }

    public function create(array $data,int|string $id = null)
    {
        $this->data = $data;

        $this->data['colors'] = (isset($this->data['colors'])) ? implode(',', $this->data['colors']) : '';

        if(isset($this->data["image"])){
            $image = $this->data["image"];
        }

        unset($this->data["image"]);

        if(isset($image)){

            $this->query['upload']->upload($image, $this->data['name'], "app/adms/Views/images/products/");

            if($this->query['upload']->getResult()){
                $this->data['image'] = $this->query['upload']->nameImage();
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: A imagem só pode ser desses tipos : jpg, jpeg, gif, png</p>";

                return false;
            }

            $noVal['image'] = $this->data['image'];
        }

        unset($this->data['image']);

        if(isset($image)){
            $this->data['image'] = $noVal['image'];
        }

        if(!$id){ // caso for insert

            $result = $this->query['fullRead']->query("INSERT INTO pr_products :data", $this->data, '', ['i']);

            return ($result) ? true : false;

        }else{ // caso for editar

            $as_main_promotion = $this->query['fullRead']->query("SELECT image FROM pr_products WHERE main_promotion = 'Ativo' AND id_product = {$id}", [], "",['s']);

            if($as_main_promotion){

                $image = $as_main_promotion[0]['image'];

                if(isset($this->data['image'])){

                    $image = $this->data['image'];

                }

                $data = ['title' => $this->data['name'], 'price' => $this->data['price'], 'image' => $image];

                $this->query['fullRead']->query("UPDATE hm_main_promotion SET :data WHERE id_product = :id_product", $data, "id_product={$id}", ['u']);

            }

            $result = $this->query['fullRead']->query("UPDATE pr_products SET :data WHERE id_product = :id_product", $this->data, "id_product={$id}", ['u']);

            return ($result) ? true : false;
        }

    }

    public function delete($id)
    {

        $result = $this->query['fullRead']->query("DELETE FROM pr_products WHERE id_product=:id_product", [], "id_product={$id}", ['d']);

        return ($result) ? true : false;

    }

    public function getInfo($id)
    {

        $result = $this->query['fullRead']->query("SELECT pr.*,ct.name as name_category
                                            FROM pr_products AS pr
                                            inner JOIN pr_categories AS ct
                                            ON ct.id_category = pr.id_category WHERE id_product = :id_product",[],"id_product={$id}",['s']);

        return $result[0];

    }

    public function getAllCategories()
    {

        return $this->query['fullRead']->query("SELECT * FROM pr_categories",[],'',['s']);

    }

    public function get_brands()
    {

        return $this->query['fullRead']->query("SELECT * FROM pr_brands",[],'',['s']);

    }

    public function searchName($data)
    {
        $result = $this->query['fullRead']->query("SELECT * FROM pr_products WHERE name LIKE '%:name%'", [], "name={$data['search_name']}", ['s']);

        return ($result) ? $result : false;
    }

    public function editOrder($data)
    {

        $id = $data['id'];

        unset($data['id']);

        $result = $this->query['fullRead']->query("UPDATE pr_products SET :data WHERE id_product = :id_product", $data, "id_product={$id}", ['u']);

        return ($result) ? ['status' => 'success', 'orderby' => $data['orderby']] : '';
    }

    public function save_main_promotion($data)
    {
        $this->query['fullRead']->query("UPDATE pr_products SET :data", ['main_promotion' => "Inativo"], '', ['u']);

        $this->query['fullRead']->query("DELETE FROM hm_main_promotion", [], '', ['d']);

        $product = self::getInfo($data['id_product']);

        $this->query['fullRead']->query("UPDATE pr_products SET :data WHERE id_product = :id_product", ['main_promotion' => "Ativo", 'price' => $data['price'], 'old_price' => $product['price']], "id_product={$data['id_product']}", ['u']);

        $data['date_expiry'] = implode("-",array_reverse(explode("/",$data['date_expiry'])));

        $data['image'] = $product['image'];

        $data['title'] = $product['name'];

        $result = $this->query['fullRead']->query("INSERT INTO hm_main_promotion :data", $data, '', ['i']);

        return ($result) ? true : false;


    }

    public function verify_main_promotion($id_product)
    {

        $result = $this->query['fullRead']->query("SELECT * FROM pr_products WHERE main_promotion = 'Ativo' AND id_product <> :id_product", [], "id_product={$id_product}", ['s']);

        return ($result) ? false : true;

    }

    public function verify_edit($id_product)
    {
        $result = $this->query['fullRead']->query("SELECT * FROM hm_main_promotion WHERE id_product = :id_product", [], "id_product={$id_product}", ['s']);

        return ($result) ? $result[0] : false;


    }

    public function deletePromotion()
    {

        $id_product = $this->query['fullRead']->query("SELECT id_product FROM hm_main_promotion", [], '', ['s']);

        $this->query['fullRead']->query("UPDATE pr_products SET :data WHERE id_product = :id_product", ['main_promotion' => 'Inativo'],"id_product={$id_product[0]['id_product']}", ['u']);

        $this->query['fullRead']->query("DELETE FROM hm_main_promotion WHERE id_product = :id_product", [], "id_product={$id_product[0]['id_product']}", ['d']);

        return $this->query['delete']->getResult();

    }

    public function get_main_promotion()
    {

        $result = $this->query['fullRead']->query("SELECT id_product FROM hm_main_promotion", [], '', ['s']);

        return ($result) ? $result[0] : null;

    }

}
