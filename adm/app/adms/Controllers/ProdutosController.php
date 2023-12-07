<?php

namespace App\adms\Controllers;

class ProdutosController
{
    private $qnt_records = 10;

    public function __construct($model, $sessionPermi){

        $this->model = $model;

        $this->sessionPermi = $sessionPermi;

        $this->pageAdd = URLADM . 'produtos/insert';

        $this->pageEdit = URLADM . 'produtos/edit';

        $this->pageGaleria = URLADM . 'produtos-galeria/index';

        $this->pagePromotion = URLADM . 'produtos/promocaoPrincipal';

        $this->pageDelete = URLADM . 'produtos/delete';

        $this->pageReturn = URLADM . 'produtos/index';

        $this->deletePromotion = URLADM . 'produtos/deletePromotion';

        $this->data['sidebarActive'] = "produtos";

    }

    public function index($page)
    {
        $this->page = (int) $page ? $page : 1;

        self::list();
    }

    public function list()
    {
        $error = false;

        $product_main_promotion = $this->model->get_main_promotion();

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($this->dataForm['search_name'])){

            $data = $this->model->searchName($this->dataForm);

            if(!$data) $error = true;

        }else{

            $data = $this->model->list($this->page, $this->qnt_records);

            if(!$data) $error = true;

            if($data) $pagination = $this->model->getResultPg();

        }

        require_once "app/adms/Views/produtos/_list.php";

    }

    public function insert()
    {

        $success = false;

        $categories = $this->model->getAllCategories();

        $brands = $this->model->get_brands();

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            if($_FILES['image']['error'] == 0){
                $this->dataForm['image'] = $_FILES['image'] ? $_FILES['image'] : null;
            }

            if($this->model->create($this->dataForm)){

                $success = true;

            }
        }

        require_once "app/adms/Views/produtos/_insert.php";


    }

    public function edit($id)
    {

        $success = false;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            if($_FILES['image']['error'] == 0){
                $this->dataForm['image'] = $_FILES['image'] ? $_FILES['image'] : null;
            }

            if($this->model->create($this->dataForm, $id)){

                $success = true;

            }
        }else{

            $data = $this->model->getInfo($id);

            $categories = $this->model->getAllCategories();

            $brands = $this->model->get_brands();

            $data['colors'] = explode(',', $data['colors']);

        }

        require_once "app/adms/Views/produtos/_edit.php";

    }

    public function delete($id)
    {

        if($this->model->delete($id)){

            header("Location: $this->pageReturn");

        }

    }

    public function deletePromotion()
    {

        if($this->model->deletePromotion()){
            header("Location: $this->pageReturn");
        }

    }

    public function editOrder()
    {
        $data = $_POST;

        if(!$data['id'] && !$data['order']){

            echo json_encode(['status' => 'error']);
            exit;

        }

        if($data['orderby'] < 1){

            echo json_encode(['status' => 'error', 'message' => 'O campo deve ser maior que 0!']);
            exit;

        }

        $result = $this->model->editOrder($data);

        echo json_encode($result);

        exit;

    }

    public function promocaoPrincipal($id)
    {

        $data = $other_product = $success = false;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(isset($_GET['substituir'])){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                if($this->model->save_main_promotion($this->dataForm)){

                    $success = true;

                }
            }

        }else{

            if($this->model->verify_main_promotion($id)){

                $data = $this->model->verify_edit($id);

                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    if($this->model->save_main_promotion($this->dataForm)){

                        $success = true;

                    }
                }

            }else{

                $other_product = true;

            }
        }

        require_once "app/adms/Views/produtos/_main-promotion.php";

    }

}