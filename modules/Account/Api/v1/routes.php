<?php



use Dingo\Api\Routing\Router;


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function (Router $api) {

    $api->group(["prefix"=>"account","namespace"=>'Alley\Modules\Account\Api\v1\Controllers'],function () use($api){

                        // API ROUTES FOR USERS
        $api->post('/register/', 'UserController@register');
        $api->post('/login/', 'UserController@login');
        $api->get('/list/users', "UserController@index");
        $api->get('/list/user/{id}', "UserController@getById");
        $api->put('/update/user/{id}', "UserController@update");
        $api->delete('/delete/{id}', "UserController@delete");


    });






});