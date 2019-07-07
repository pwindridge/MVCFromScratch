<?php


namespace Core\Database;


class Result {

    private $sth;

    public function __construct(\PDOStatement $sth)
    {
        $this->sth = $sth;
    }

    public function fetchAll()
    {
        return $this->sth->fetchAll();
    }

    public function fetch()
    {
        return $this->sth->fetch();
    }
}