<?php

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

    /*
     * ADMIN ROUTES
     */

    use Illuminate\Support\Facades\Route;

    Route::group(['prefix' => 'admin/hotel', 'middleware' => ['auth']], static function () {

        //Page Tour

    });
