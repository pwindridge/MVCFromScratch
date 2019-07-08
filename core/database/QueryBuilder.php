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
        $this->queryString = "SELECT * FROM `{$fromTable}`";

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

        return $this->execute()->rowsAffected();
    }

    public function update(string $table, array $parameters)
    {
        $this->queryString = "UPDATE `{$table}`" .
            " SET " .
            implode(',',
                array_map(function ($key, $value) {
                    return "`{$key}` = ?";
                }, array_keys($parameters), $parameters)
            );
        $this->bindValues = array_values($parameters);
        return new Where($this);
    }

    public function delete(string $fromTable)
    {
        $this->queryString = "DELETE FROM `{$fromTable}`";
        return new Where($this);

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