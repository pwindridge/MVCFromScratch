<?php


namespace Core\Database;


use PDO;


abstract class Query {

    /**
     * @var PDO
     */
    protected $pdo;

    protected $queryString = '';

    protected $bindValues;

    public function execute()
    {
        $sth = $this->pdo->prepare($this->queryString . ';');

        $index = 1;

        if ($this->bindValues) {
            for ($i = 0; $i < count($this->bindValues); $i++) {
                $sth->bindParam($index++, $this->bindValues[$i]);
            }
        }

        $sth->execute();

        return new Result($sth);
    }
}