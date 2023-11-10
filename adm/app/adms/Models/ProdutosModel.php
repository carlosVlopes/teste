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
        $this->query['select']->exeSelect("pr_products", '',"" , "");

        if(empty($this->query['select']->getResult())){

            return false;
        }

        $this->page = (int) $page ? $page : 1;

        $this->limitResult = $qnt_records;

        $pagination = new Pagination(URLADM . 'produtos/index', 'pr_products', '', 'id_product');

        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination();

        $this->resultPg = $pagination->getResult();

        $result = $this->query['fullRead']->fullRead("SELECT pr.*,ct.name as name_category
                                            FROM pr_products AS pr
                                            inner JOIN pr_categories AS ct
                                            ON ct.id_category = pr.id_category");

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

            $this->query['create']->exeCreate("pr_products", $this->data);

            if(!$this->query['create']->getResult()) return false;

            return true;

        }else{ // caso for editar

            $as_main_promotion = $this->query['fullRead']->fullRead("SELECT image FROM pr_products WHERE main_promotion = 'Ativo' AND id_product = {$id}");

            if($as_main_promotion){

                $image = $as_main_promotion[0]['image'];

                if(isset($this->data['image'])){

                    $image = $this->data['image'];

                }

                $this->query['update']->exeUpdate("hm_main_promotion", ['title' => $this->data['name'], 'price' => $this->data['price'], 'image' => $image], "WHERE id_product = :id_product", "id_product={$id}");

            }

            $this->query['update']->exeUpdate("pr_products", $this->data, 'WHERE id_product = :id_product', "id_product={$id}");

            if(!$this->query['update']->getResult()) return false;

            return true;
        }

    }

    public function delete($id)
    {

        $this->query['delete']->delete('pr_products', "WHERE id_product=:id_product", "id_product={$id}");

        return $this->query['delete']->getResult();
    }

    public function getInfo($id)
    {

        $result = $this->query['fullRead']->fullRead("SELECT pr.*,ct.name as name_category
                                            FROM pr_products AS pr
                                            inner JOIN pr_categories AS ct
                                            ON ct.id_category = pr.id_category WHERE id_product = :id_product","id_product={$id}");

        return $result[0];

    }

    public function getAllCategories()
    {

        $this->query['select']->exeSelect("pr_categories", '','', '');

        return $this->query['select']->getResult();

    }

    public function get_brands()
    {

        $this->query['select']->exeSelect("pr_brands", '','', '');

        return $this->query['select']->getResult();

    }

    public function searchName($data)
    {
        $this->query['select']->exeSelect("adms_users", 'id,name,email,date_expiry',"WHERE name = :name OR email = :email" , "name={$data['search_name']}&email={$data['search_name']}");

        $result = $this->query['select']->getResult();

        return ($result) ? $result : false;
    }

    public function editOrder($data)
    {

        $id = $data['id'];

        unset($data['id']);

        $this->query['update']->exeUpdate("pr_products", $data,"WHERE id_product = :id_product", "id_product={$id}");

        $result = $this->query['update']->getResult();

        return ($result) ? ['status' => 'success', 'orderby' => $data['orderby']] : '';
    }

    public function save_main_promotion($data)
    {

        $this->query['update']->exeUpdate("pr_products", ['main_promotion' => "Inativo"], '', '');

        $this->query['delete']->delete("hm_main_promotion", '', '');

        $product = self::getInfo($data['id_product']);

        $this->query['update']->exeUpdate("pr_products", ['main_promotion' => "Ativo", 'price' => $data['price'], 'old_price' => $product['price']], "WHERE id_product = :id_product", "id_product={$data['id_product']}");

        $data['date_expiry'] = implode("-",array_reverse(explode("/",$data['date_expiry'])));

        $data['image'] = $product['image'];

        $data['title'] = $product['name'];

        $this->query['create']->exeCreate("hm_main_promotion", $data);

        if(!$this->query['create']->getResult()) return false;

        return true;


    }

    public function verify_main_promotion($id_product)
    {

        $result = $this->query['fullRead']->fullRead("SELECT * FROM pr_products WHERE main_promotion = 'Ativo' AND id_product <> :id_product", "id_product={$id_product}");

        if($result) return false;

        return true;

    }

    public function verify_edit($id_product)
    {
        $result = $this->query['fullRead']->fullRead("SELECT * FROM hm_main_promotion WHERE id_product = :id_product", "id_product={$id_product}");

        return ($result) ? $result[0] : false;


    }

    public function deletePromotion()
    {

        $id_product = $this->query['fullRead']->fullRead("SELECT id_product FROM hm_main_promotion");

        $this->query['update']->exeUpdate("pr_products", ['main_promotion' => 'Inativo'], "WHERE id_product = :id_product","id_product={$id_product[0]['id_product']}");

        $this->query['delete']->delete('hm_main_promotion', "WHERE id_product=:id_product", "id_product={$id_product[0]['id_product']}");

        return $this->query['delete']->getResult();

    }

    public function get_main_promotion()
    {

        $result = $this->query['fullRead']->fullRead("SELECT id_product FROM hm_main_promotion");

        return ($result) ? $result[0] : null;

    }

}
