<?php



use Dingo\Api\Routing\Router;


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function (Router $api) {

    $api->group(["prefix"=>"account","namespace"=>'Alley\Modules\Account\Api\v1\Controllers'],function () use($api){

                        // API ROUTE FOR VENDOR REGISTRATION AND LOGIN
        $api->post('/register/vendor','UserController@registerVendor');
        $api->post('/vendor/login','UserController@vendorLogin');

                        // API ROUTE FOR ADMIN LOGIN
        $api->post('/admin/login','UserController@adminLogin');

        $api->get('/all/vendors','UserController@getAllVendor');
        $api->get('/vendor/{id}','UserController@getVendorById');
        $api->post('/update/vendor/{id}','UserController@updateVendor');
        $api->delete('/delete/vendor/{id}','UserController@deleteVendor');

    });






});