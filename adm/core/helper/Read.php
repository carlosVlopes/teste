<?php

namespace Core\helper;

use PDO;
use PDOException;

class Read extends Conn
{
    private string $select;

    private $values = [];

    private $query;

    private object $conn;

    /**
     * QUERYS:
     * INSERT INTO :data
     * UPDATE table SET :data
     * DELETE FROM table
     * SELECT * FROM table
     * @param string $query Recebe a QUERY da Models.
     * @param array  $data Array de dados caso a query for insert | update.
     * @param string $parseString Recebe o valores que devem ser subtituidos no link, ex: sts_situation_id=1
     * @param array  $type Array com um valor | ['i'] | ['u'] | ['d'] | ['s']
     * 
     *
     */
    public function query(string $query, $data, $parseString = null, $type = null)
    {
        $this->select = $query;

        $this->values = $parseString;

        $this->data = $data;

        $this->type = $type[0];

        if($this->type == 'u'){

            if (!empty($parseString)) {
                parse_str($parseString, $this->values);
            }

            return $this->exeReplaceValuesUpdate();

        }

        if($this->type == 'i'){

            $this->values = $data;

            return $this->exeReplaceValuesInsert();

        }

        if($this->type == 's' || $this->type == 'd'){

            if (!empty($parseString)) {
                parse_str($parseString, $this->values);
            }

            return $this->exeInstruction();

        }
    }

    private function exeReplaceValuesUpdate()
    {
        foreach ($this->data as $key => $value){
            $values[] = $key . "=:" . $key;
        }

        $values = implode(", ", $values);

        $a = explode(':data', $this->select);

        $this->select = "{$a[0]}{$values}{$a[1]}";

        return $this->exeInstruction();
    }

    private function exeReplaceValuesInsert()
    {
        $coluns = implode(',', array_keys($this->values));

        $values = ':' . implode(', :', array_keys($this->values));

        $a = explode(':data', $this->select);

        $this->select = "{$a[0]}($coluns) VALUES ($values)";

        return $this->exeInstruction();
    }


    /**
     * Executa a QUERY. 
     * Quando executa a query com sucesso retorna o array de dados, senão retorna null.
     * 
     * @return void
     */
    private function exeInstruction()
    {
        $this->connection();
        try {

            if($this->type == 's' || $this->type == 'd'){

                $this->exeParameter();

                $this->query->execute();

                return ($this->type == 's') ? $this->query->fetchAll() : true ;
            }

            if($this->type == 'i'){
                $this->query->execute($this->values);

                return $this->conn->lastInsertId();

            }

            if($this->type == 'u'){

                $this->query->execute(array_merge($this->data, $this->values));

                return true;

            }

        } catch (PDOException $err) {
            return null;
        }
    }

    /**
     * Obtem a conexão com o banco de dados da classe pai "Conn".
     * Prepara uma instrução para execução e retorna um objeto de instrução.
     * 
     * @return void
     */
    private function connection(): void
    {
        $this->conn = $this->connectDb();

        $this->query = $this->conn->prepare($this->select);

        if($this->type != 'i') $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    /**
     * Substitui os link da QUERY pelo valores utilizando o bindValue
     * 
     * @return void
     */
    private function exeParameter(): void
    {
        if ($this->values) {
            foreach ($this->values as $link => $value) {
                if (($link == 'limit') or ($link == 'offset') or ($link == 'id')) {
                    $value = (int) $value;
                }
                $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
