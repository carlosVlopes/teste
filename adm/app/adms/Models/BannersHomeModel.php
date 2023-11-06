<?php

namespace App\adms\Models;

use Core\helper\Pagination;

class BannersHomeModel
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

        $pagination = new Pagination(URLADM . 'banners-home/index', 'hm_banners', '', 'id_banner');

        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination();

        $this->resultPg = $pagination->getResult();

        $this->query['fullRead']->fullRead("SELECT * FROM hm_banners ORDER BY orderby LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $result = $this->query['fullRead']->getResult();

        return ($result) ? $result : false;
    }

    public function create(array $data,int|string $id = null)
    {
        $this->data = $data;

        if(isset($this->data["banner"])){
            $banner = $this->data["banner"];
        }

        unset($this->data["banner"]);

        if(isset($banner)){

            $this->query['upload']->upload($banner, $this->data['title'], "../app/sts/assets/img/main_banners/");

            if($this->query['upload']->getResult()){
                $this->data['banner'] = $this->query['upload']->nameImage();
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: A imagem só pode ser desses tipos : jpg, jpeg, gif, png</p>";

                return false;
            }

            $noVal['banner'] = $this->data['banner'];
        }

        unset($this->data['banner']);

        $this->query['valField']->valField($this->data); // chama o metodo do objeto

        if(!$this->query['valField']->getResult()) return false;

        if(isset($banner)){
            $this->data['banner'] = $noVal['banner'];
        }

        if(!$id){ // caso for insert

            $this->data['status'] = "Ativo";

            $this->query['create']->exeCreate("hm_banners", $this->data);

            if($this->query['create']->getResult()){
                return true;
            }else{
                return false;
            }

        }else{ // caso for editar

            $this->query['update']->exeUpdate("hm_banners", $this->data, 'WHERE id_banner = :id_banner', "id_banner={$id}");

            if($this->query['update']->getResult()){

                return true;

            }else{

                return false;

            }
        }

    }

    public function delete($id)
    {

        $this->query['delete']->delete('hm_banners', "WHERE id_banner=:id_banner", "id_banner={$id}");

        return $this->query['delete']->getResult();
    }

    public function getInfo($id)
    {

        $this->query['fullRead']->fullRead("SELECT * FROM hm_banners WHERE id_banner = :id_banner","id_banner={$id}");

        $result = $this->query['fullRead']->getResult();

        return $result[0];

    }


    public function editOrder($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $this->query['update']->exeUpdate("hm_banners", $data,"WHERE id_banner = :id_banner", "id_banner={$id}");

        $result = $this->query['update']->getResult();

        return ($result) ? ['status' => 'success', 'orderby' => $data['orderby']] : '';
    }

    public function toggle_status($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $this->query['update']->exeUpdate("hm_banners", $data, "WHERE id_banner = :id_banner", "id_banner={$id}");

        $result = $this->query['update']->getResult();

        return ($result) ? ['status' => 'success', 'statusBanner' => $data['status']] : ['status' => 'error'];
    }

    public function get_collections()
    {

        $this->query['fullRead']->fullRead("SELECT * FROM pr_collections");

        $result = $this->query['fullRead']->getResult();

        return $result;

    }

}
