<?php


namespace Core\Database;


use PDO;


class QueryBuilder extends Query {

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll(string $fromTable)
    {
//        $sth = $this->pdo->prepare(
        $this->queryString = "SELECT * FROM `{$fromTable}`";
//        );

        return $this->execute()->fetchAll();
    }

    public function select(string $fromTable, array $fields)
    {
        $this->queryString = "SELECT " .
            implode(', ', $this->backtick($fields)) .
            " FROM `{$fromTable}`";
        return new Where($this);
    }

    public function insert(string $toTable, array $parameters)
    {
        $this->queryString = "INSERT INTO `$toTable` (" .

            implode(', ',
                $this->backtick(array_keys($parameters))) .

            ") VALUES (" .

            implode(', ', array_map(function () {
                    return '?';
                }, $parameters)
            ) .

            ")";

        $this->bindValues = array_values($parameters);

        $this->execute();
    }

    private function backtick(array $arr)
    {
        return array_map(
            function ($element) {
                return "`{$element}`";
            }, $arr
        );
    }
}