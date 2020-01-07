<?php

//Rotas para o site
Route::get('/', 'Site\HomeController@index');

//Rotas para o dashboard
Route::prefix('dashboard')->group(function () {
    //Home da Dashboard
    Route::get('/', 'Admin\AdminController@index')->name('admin');

    //Login
    Route::get('login', 'Admin\Auth\LoginController@index')->name('login');
    Route::post('login', 'Admin\Auth\LoginController@authenticate');

    //Cadastro
    Route::get('register', 'Admin\Auth\RegisterController@index')->name('register');
    Route::post('register', 'Admin\Auth\RegisterController@register');

    //Logout
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');

    //Usuários
    Route::resource('users', 'Admin\UserController');

    //Gerenciar perfil do usuário
    Route::get('profile', 'Admin\ProfileController@index')->name('profile');
    Route::put('profile', 'Admin\ProfileController@save')->name('profile.save');

    //Configurações gerais do site
    Route::get('settings', 'Admin\SettingController@index')->name('settings');
});
