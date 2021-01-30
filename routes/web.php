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

$router->get('/', 'ClipboardController@index');

$router->group(['middleware' => 'throttle:45,60'], function () use ($router) {
    
    $router->get('/ui', 'ClipboardController@getUiHash');
    
    $router->get('/{hash}', 'ClipboardController@getJsonHash');

    $router->post('/{hash}', 'ClipboardController@postHash');

    $router->get('/ui/{hash}', 'ClipboardController@getUiHash');
    
    $router->get('/json/{hash}', 'ClipboardController@getJsonHash');

    $router->get('/xml/{hash}', 'ClipboardController@getXmlHash');

    $router->get('/raw/{hash}', 'ClipboardController@getRawHash');
    
});
