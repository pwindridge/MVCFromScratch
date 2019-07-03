<?php

function dd($value)
{
    echo '<pre>';
    die (var_dump($value));
}

function view($page, $data)
{
    extract($data);

    require __DIR__ . "/../views/{$page}.view.php";
}