<?php


$router->get('', 'PagesController@home');
$router->get('home', 'PagesController@home');
$router->get('about', 'PagesController@about');
$router->get('search', 'PagesController@search');
$router->get('add', 'PagesController@addModule');
$router->get('detail', 'PagesController@detail');

$router->post('store', 'PagesController@store');
$router->post('edit', 'PagesController@edit');
$router->post('delete', 'PagesController@delete');

$router->get('pagenotfound', 'ErrorsController@page_not_found');