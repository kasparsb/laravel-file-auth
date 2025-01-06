<?php

use Illuminate\Http\Request;

use Kasparsb\Auth\Controllers\LoginController;

Route::group([
    'controller' => LoginController::class,
    'prefix' => 'auth',
    /**
     * Te vajag obligāti norādit middleware, savādāk nebūs session
     * un nevar uztaistī login
     * Varbūt labāk atstāt, lai login routes pats lietotājs uzliek
     * savā routes failā
     */
    'middleware' => ['web'],
], function(){
    Route::get('login', 'index')->name('auth::login');
    Route::post('login', 'login');
    Route::get('logout', 'logout')->name('auth::logout');
});