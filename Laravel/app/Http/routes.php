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
    return "Lumen RESTful API By chanu1993";
});

$app->group(['prefix' => 'api/v1', 'namespace' => 'App\Http\Controllers'], function ($app) {

    $app->get('migrate_data', 'MigrateController@testDualDatabaseConnection');
    $app->get('convert_data', 'MigrateController@convertPerlToJson');

});
