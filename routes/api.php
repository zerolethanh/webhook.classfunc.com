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
    $repository = \request('repository');
    $dir = @chdir('~/Projects/' . $repository['name']);
    if ($dir) {
        $return_to_github = [];
        exec('git pull', $return_to_github);
        return $return_to_github;
    }
    return ['update' => false];
});