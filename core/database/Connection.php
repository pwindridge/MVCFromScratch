<?php


namespace Core\Database;


use PDO;


class Connection {

    public static function make(array $config)
    {
        return new PDO (
            "{$config['connection']};dbname={$config['dbname']}",
            $config['username'],
            $config['password'],
            $config['options']
        );
    }
}