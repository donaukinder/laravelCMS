<?php

//Rotas para o site
Route::get('/', 'Site\HomeController@index');

//Rotas para o dashboard
Route::prefix('dashboard')->group(function(){
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('login', 'Admin\Auth\LoginController@index')->name('login');
});