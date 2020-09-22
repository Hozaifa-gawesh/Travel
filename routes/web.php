<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('cities/country', 'CitiesCountryController@cities')->name('cities.country.global');

Route::get('/', function () {

    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', '2015-5-5 3:30:34');
    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', '2015-5-15 9:30:34');
    $diff_in_days = $to->diffInDays($from);
    print_r($diff_in_days); // Output: 1

    return view('welcome');
});
