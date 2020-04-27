<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::pattern('domain', '(deesk.ru|deesk.online)');
//
////Главный домен
//Route::domain('{domain}')->group(function () {
//    Route::get('/', 'Controller@index');
//    Route::get('/register', 'OrganizationController@create');
//    Route::get('/password', function () {
//        return Hash::make('11111q');
//    });
//});

//Route::group(['domain' => 'panel.{domain}'], function (\http\Client\Request $request) {
//    return $request;
//    Route::view('/{path?}', 'pages.index')
//        ->where('path', '.*')
//        ->name('app');
//});

Route::domain('panel.deesk.ru')->group(function () {
    Route::view('/{path?}', 'app.index')
        ->where('path', '.*')
        ->name('app');
});

Route::domain('deesk.ru')->group(function () {
    Route::get('/', 'PortalController@index')->name('portal.index');
});
