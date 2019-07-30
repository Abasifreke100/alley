<?php


use Dingo\Api\Routing\Router;


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function (Router $api) {

    $api->group(["prefix"=>"admin","namespace"=>'Alley\Modules\Admin\Api\v1\Controllers'],function () use($api){

                    // API ROUTES FOR ADMIN
        $api->post('/register/', 'AdminController@register');
        $api->post('/login/', 'AdminController@login');
        $api->get('/list/admins', "AdminController@index");
        $api->get('/list/admin/{id}', "AdminController@getById");
        $api->put('/update/admin/{id}', "AdminController@update");
        $api->delete('/delete/{id}', "AdminController@delete");


    });

});