<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/', function () {
//    return request()->all();
//    info(\request()->all());
    $repository = \request('repository');
//    return $repository;

    $dir = '/home/apache/' . $repository['name'];
    info('Opening ' . $dir);
    $openOK = @chdir($dir);
    if ($openOK) {
        return exec(<<<EOD
cd $dir
php -f ../update.php
EOD
);
    }
    return ['update' => false];
});