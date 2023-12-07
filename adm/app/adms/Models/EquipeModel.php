<?php

namespace App\adms\Models;

use Core\helper\Pagination;

class EquipeModel
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

        $pagination = new Pagination(URLADM . 'equipe/index', 'ab_team', '', 'id_person');

        $pagination->condition($this->page, $this->limitResult);

        $pagination->pagination();

        $this->resultPg = $pagination->getResult();

        $result = $this->query['fullRead']->query("SELECT * FROM ab_team ORDER BY orderby LIMIT :limit OFFSET :offset", [], "limit={$this->limitResult}&offset={$pagination->getOffset()}", ['s']);

        return ($result) ? $result : false;
    }

    public function create(array $data,int|string $id = null)
    {
        $this->data = $data;

        if(isset($this->data["image"])){
            $image = $this->data["image"];
        }

        unset($this->data["image"]);

        if(isset($image)){

            $this->query['upload']->upload($image, $this->data['name'], "../app/sts/assets/img/about/");

            if($this->query['upload']->getResult()){
                $this->data['image'] = $this->query['upload']->nameImage();
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: A imagem só pode ser desses tipos : jpg, jpeg, gif, png</p>";

                return false;
            }

            $noVal['image'] = $this->data['image'];
        }

        unset($this->data['image']);

        $this->query['valField']->valField($this->data);

        if(!$this->query['valField']->getResult()) return false;

        if(isset($image)){
            $this->data['image'] = $noVal['image'];
        }

        if(!$id){ // caso for insert

            $result = $this->query['fullRead']->query("INSERT INTO ab_team :data", $this->data, '', ['i']);

            return ($result) ? true : false;

        }else{ // caso for editar

            $result = $this->query['fullRead']->query("UPDATE ab_team SET :data WHERE id_person = :id_person", $this->data, "id_person={$id}", ['u']);

            return ($result) ? true : false;

        }

    }

    public function delete($id)
    {
        return $this->query['fullRead']->query("DELETE FROM ab_team WHERE id_person = :id_person",[] , "id_person={$id}", ['d']);
    }

    public function getInfo($id)
    {

        $result = $this->query['fullRead']->query("SELECT * FROM ab_team WHERE id_person = :id_person",[] ,"id_person={$id}", ['s']);

        return $result[0];

    }


    public function editOrder($data)
    {
        $id = $data['id'];

        unset($data['id']);

        $result = $this->query['fullRead']->query("UPDATE ab_team SET :data WHERE id_person = :id_person", $data, "id_person={$id}", ['u']);

        return ($result) ? ['status' => 'success', 'orderby' => $data['orderby']] : '';
    }

}
