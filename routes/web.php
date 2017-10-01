<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('/{hash}', 'ClipboardController@getJsonHash');

$app->post('/{hash}', 'ClipboardController@postHash');

$app->get('/ui/{hash}', 'ClipboardController@getUiHash');

$app->get('/json/{hash}', 'ClipboardController@getJsonHash');

$app->get('/xml/{hash}', 'ClipboardController@getXmlHash');

$app->get('/text/{hash}', 'ClipboardController@getTextHash');
