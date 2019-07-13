<?php

require 'Validation/StringValidator.php';


use \Core\{
    App,
    Validation\ValidatorFactory
};


function dd($value)
{
    echo '<pre>';
    die (var_dump($value));
}

function view($page, $data)
{
    extract($data);

    $errors = App::get('errors')??[];

    require __DIR__ . "/../views/{$page}.view.php";
}

function validate(array $parameters)
{
    array_walk($parameters, function (&$args, $key) {

        $validator = array_shift($args);
        array_unshift($args, $_REQUEST[$key]);

        $args = ValidatorFactory::make($validator, $args);
    });

    App::get('errors')->addMany($parameters);

    return ! App::get('errors')->hasErrors();
}