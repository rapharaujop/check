<?php

use App\Http\Controllers\UserController;
use App\User;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

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
Route::get('/', 'ContractController@report')->name('contract.report');

Route::get('header', function () {
    return view('site.header');
});

Route::get('footer', function () {
    return view('site.footer');
});

Route::post('pesquisar','ContractController@report')->name('contract.report');
Route::get('pesquisar','ContractController@report')->name('contract.report');

Route::resource('usuarios', 'UserController')->names('user')->parameters(['usuarios' => 'user']);
Route::resource('contratos', 'ContractController')->names('contract')->parameters(['contratos' => 'contract']);
