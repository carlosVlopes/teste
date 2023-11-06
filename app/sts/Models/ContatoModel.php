<?php

namespace Sts\Models;

class ContatoModel
{

    public function __construct($query)
    {

        $this->query = $query;

    }

    public function create(array $data): bool
    {
        $this->data = $data;

        $this->query['create']->exeCreate("sts_contacts_msgs", $this->data);

        if ($this->query['create']->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Mensagem enviada com sucesso!</p>";
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Mensagem não enviada com sucesso!</p>";
        }
    }

    public function get_info()
    {
        $this->query['fullRead']->fullRead("SELECT *
                            FROM sts_contents_contacts
                            WHERE id=:id
                            LIMIT :limit", "id=1&limit=1");
        $data = $this->query['fullRead']->getResult();

        return $data[0];

    }
}
