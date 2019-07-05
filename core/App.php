<?php


namespace Core;


use Exception;


class App {

    private static $registry;

    public static function bind(string $key, $data)
    {
        static::$registry[$key] = $data;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public static function get(string $key)
    {
        if (! array_key_exists($key, static::$registry)) {
            throw new Exception("{key} wasn't found in the registry");
        }

        return static::$registry[$key];
    }
}