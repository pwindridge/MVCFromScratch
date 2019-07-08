<?php


namespace Core\Database;


use PDO;

class Where extends Query {

    public function __construct(Query $query)
    {
        $this->pdo = $query->pdo;
        $this->queryString = $query->queryString;
        $this->bindValues = $query->bindValues;
    }

    public function where(string $field, string $operator, string $value)
    {
        $this->queryString .= " WHERE `{$field}` {$operator} ?";
        $this->bindValues[] = $value;

        return new AndOr($this);
    }
}