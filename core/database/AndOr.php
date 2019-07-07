<?php


namespace Core\Database;


use PDO;


class AndOr extends Query {

    public function __construct(Query $query)
    {
        $this->pdo = $query->pdo;
        $this->queryString = $query->queryString;
        $this->bindValues = $query->bindValues;
    }

    public function and(string $field, string $operator, string $value)
    {
        return $this->returnCondition(
            'AND',
            $field, $operator, $value
        );
    }

    public function or(string $field, string $operator, string $value)
    {
        return $this->returnCondition(
            'OR',
            $field, $operator, $value
        );
    }

    private function returnCondition(
        string $logicalOperator,
        string $field, string $operator, string $value
    )
    {
        $this->queryString .= " {$logicalOperator}" .
            " `{$field}` {$operator} ?";
        $this->bindValues[] = $value;

        return new AndOr($this);
    }
}