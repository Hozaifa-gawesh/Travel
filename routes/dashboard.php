<?php

use Illuminate\Support\Facades\Route;

// Before Login Dashboard Routes
Route::group(['middleware' => 'adminGuest:admin'], function () {
    $controller = 'AuthController@';
    // Route Login
    Route::get('login', $controller . 'view');
    Route::post('login', $controller . 'login');
});

// After Login Dashboard Routes
Route::group(['middleware' => 'adminWeb:admin'], function () {

    // Route Logout
    Route::post('logout', 'AuthController@logout');

    // Route Home
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('home', 'HomeController@index')->name('dashboard/home');

    // Profile Route
    Route::group(['prefix' => 'profile/'], function () {
        $controller = 'ProfileController@';
        Route::get('/', $controller . 'index');
        Route::get('edit', $controller . 'edit');
        Route::post('update', $controller . 'update');
    });

    // Setting Route
    Route::group(['prefix' => 'setting'], function () {
        $controller = 'SettingController@';
        Route::get('/', $controller . 'index')->name('setting');
        Route::post('/', $controller . 'update')->name('update-setting');
    });

    // Countries Route
    Route::group(['prefix' => 'countries/'], function () {
        $controller = 'CountriesController@';
        $route = '-country';
        Route::get('/', $controller . 'index')->name('countries');
        Route::post('store', $controller . 'store')->name('store' . $route);
        Route::get('{id}/view', $controller . 'view')->name('view' . $route);
        Route::post('{id}/update', $controller . 'update')->name('update' . $route);
        Route::post('{id}/delete', $controller . 'delete')->name('delete' . $route);
        Route::post('deletes', $controller . 'deletes')->name('deletes' . $route);

        // Cities Route
        Route::group(['prefix' => '{id}/cities'], function () use ($route){
            $controller = 'CitiesController@';
            $item = '-city';
            Route::get('create', $controller . 'create')->name('create' . $item . $route);
            Route::post('store', $controller . 'store')->name('store' . $item . $route);
            Route::get('{item}/view', $controller . 'view')->name('view' . $item . $route);
            Route::get('{item}/edit', $controller . 'edit')->name('edit' . $item . $route);
            Route::post('{item}/update', $controller . 'update')->name('update' . $item . $route);
            Route::post('{item}/delete', $controller . 'delete')->name('delete' . $item . $route);
        });
    });

    // Services Route
    Route::group(['prefix' => 'services/'], function () {
        $controller = 'ServicesController@';
        $route = '-service';
        Route::get('/', $controller . 'index')->name('services');
        Route::post('store', $controller . 'store')->name('store' . $route);
        Route::post('{id}/update', $controller . 'update')->name('update' . $route);
        Route::post('{id}/delete', $controller . 'delete')->name('delete' . $route);
        Route::post('deletes', $controller . 'deletes')->name('deletes' . $route);
    });

    // Hotels Route
    Route::group(['prefix' => 'hotels/'], function () {
        $controller = 'HotelsController@';
        $route = '-hotel';
        Route::get('/', $controller . 'index')->name('hotels');
        Route::get('create', $controller . 'create')->name('create' . $route);
        Route::post('store', $controller . 'store')->name('store' . $route);
        Route::get('{id}/edit', $controller . 'edit')->name('edit' . $route);
        Route::post('{id}/update', $controller . 'update')->name('update' . $route);
        Route::post('{id}/delete', $controller . 'delete')->name('delete' . $route);
        Route::post('{id}/hide',$controller . 'hidden')->name('hide' . $route);
        Route::post('{id}/show',$controller . 'show')->name('show' . $route);
    });

    // Offers Route
    Route::group(['prefix' => 'offers/'], function () {
        $controller = 'OffersController@';
        $route = '-offer';
        Route::get('/', $controller . 'index')->name('offers');
        Route::get('create', $controller . 'create')->name('create' . $route);
        Route::post('date', $controller . 'duration')->name('date' . $route);
        Route::post('store', $controller . 'store')->name('store' . $route);
        Route::get('{id}/view', $controller . 'view')->name('view' . $route);
        Route::post('{id}/update', $controller . 'update')->name('update' . $route);
        Route::post('{id}/delete', $controller . 'delete')->name('delete' . $route);
        Route::post('{id}/hide',$controller . 'hidden')->name('hide' . $route);
        Route::post('{id}/show',$controller . 'show')->name('show' . $route);

        // Gallery Route
        Route::group(['prefix' => '{id}/gallery'], function () use ($route, $controller){
            $item = '-gallery';
            Route::get('/', $controller . 'gallery')->name('gallery' . $route);
            Route::post('/', $controller . 'galleryStore')->name('store' . $item . $route);
            Route::post('{it}/delete', $controller . 'galleryDelete')->name('delete' . $item . $route);
        });

        // Cities Route
        Route::group(['prefix' => '{id}/cities'], function () use ($route){
            $controller = 'CitiesOfferController@';
            $item = '-city';
            Route::get('/', $controller . 'index')->name('cities' . $route);
            Route::get('create', $controller . 'create')->name('create' . $item . $route);
            Route::post('date', $controller . 'duration')->name('date' . $item . $route);
            Route::post('hotels', $controller . 'hotels')->name('hotels' . $item . $route);
            Route::post('store', $controller . 'store')->name('store' . $item . $route);
            Route::get('{item}/view', $controller . 'view')->name('view' . $item . $route);
            Route::post('{item}/update', $controller . 'update')->name('update' . $item . $route);
            Route::post('{item}/delete', $controller . 'delete')->name('delete' . $item . $route);
        });

    });

});