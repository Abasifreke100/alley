<?php



use Dingo\Api\Routing\Router;


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function (Router $api) {

    $api->group(["prefix"=>"vendor","namespace"=>'Alley\Modules\Vendor\Api\v1\Controllers'],function () use($api){

                            // API ROUTES FOR PRODUCTS
        $api->post('/create/product', 'ProductController@createProduct');
        $api->get('/list/products', 'ProductController@getAllProduct');
        $api->get('/list/product/{id}', 'ProductController@getProductById');
        $api->post('/update/product/{id}', 'ProductController@updateProduct');
        $api->delete('/delete/{id}', 'ProductController@deleteProduct');


                            // API ROUTE FOR ORDERS
        $api->get('/all/orders', 'OrderController@getAllOrders');
        $api->get('/order/{id}', 'OrderController@getOrderById');
        $api->post('/create/order', 'OrderController@makeOrder');



    });



});
