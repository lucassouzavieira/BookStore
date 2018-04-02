<?php

/**
 * Application routes
 */
$app->get('/', 'home:index');

$app->get('/index', 'book:index');

$app->get('/create', 'book:create');

$app->post('/store', 'book:store');

$app->get('/edit/{id}', 'book:edit');

$app->get('/details/{id}', 'book:details');

$app->post('/update/{id}', 'book:update');

$app->post('/delete/{id}', 'book:delete');