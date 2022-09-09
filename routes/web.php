<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

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


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('company', 'App\Http\Controllers\CompanyController', ['only' => [ 'index','store','edit','update','destroy' ]]);
    Route::resource('employee', 'App\Http\Controllers\EmployeeController', ['only' => [ 'index','store','edit','update','destroy' ]]);
});

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
Route::get('mail', [ 'uses' => 'App\Http\Controllers\LanguageController@mail']);

require __DIR__.'/auth.php';
