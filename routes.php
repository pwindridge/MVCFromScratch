<?php


$router->get('', 'PagesController@home');
$router->get('home', 'PagesController@home');
$router->get('about', 'PagesController@about');
$router->get('search', 'PagesController@search');
$router->get('add', 'PagesController@addModule');

$router->post('store', 'PagesController@store');

$router->get('pagenotfound', 'ErrorsController@page_not_found');