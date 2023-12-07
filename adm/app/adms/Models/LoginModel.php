<?php

namespace App\adms\Models;

class LoginModel
{
    private array|null $data;
    private $resultBd;

    public function __construct($query){

        $this->query = $query;

    }

    public function login(array $data = null)
    {
        $this->data = $data;

        $this->resultBd = $this->query['fullRead']->query("SELECT * FROM adms_users WHERE user = :user OR email =:email LIMIT :limit", [], "user={$this->data['user']}&email={$this->data['user']}&limit=1", ['s']);

        if($this->resultBd){
            if($this->valPassword()) return true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário ou a senha incorreta!</p>";
            return false;
        }
    }

    private function valPassword()
    {
        if(password_verify($this->data['password'], $this->resultBd[0]['password'])){
            $_SESSION['user_id'] = $this->resultBd[0]['id'];

            $_SESSION['user_name'] = $this->resultBd[0]['name'];

            $_SESSION['user_email'] = $this->resultBd[0]['email'];

            $_SESSION['user_image'] = $this->resultBd[0]['image'];

            return true;

        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário ou a senha incorreta!</p>";

            return false;
        }
    }


}