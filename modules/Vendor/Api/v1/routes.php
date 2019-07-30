<?php



use Dingo\Api\Routing\Router;


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function (Router $api) {

    $api->group(["prefix"=>"vendor","namespace"=>'Alley\Modules\Vendor\Api\v1\Controllers'],function () use($api){

                            // API ROUTES FOR VENDORS
        $api->post('/register/', 'VendorController@register');
        $api->post('/login/', 'VendorController@login');
        $api->get('/list/vendors', "VendorController@index");
        $api->get('/list/vendor/{id}', "VendorController@getById");
        $api->put('/update/vendor/{id}', "VendorController@update");
        $api->delete('/delete/{id}', "VendorController@delete");


                            // API ROUTES FOR PRODUCTS
        $api->post('/upload/', 'ProductController@upload');
        $api->get('/list/products', "ProductController@index");
        $api->get('/list/product/{id}', "ProductController@getById");
        $api->put('/update/product/{id}', "ProductController@update");
        $api->delete('/delete/{id}', "ProductController@delete");

    });



});
