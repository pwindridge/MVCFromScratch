<?php


namespace Core\Database;


use PDO;


class QueryBuilder {

    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll(string $table)
    {
        $sth = $this->pdo->prepare(
            "SELECT * FROM `{$table}`;"
        );

        $sth->execute();

        return $sth->fetchAll();
    }
}