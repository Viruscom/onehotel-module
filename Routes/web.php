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
    use Modules\OneHotel\Http\Controllers\OneHotelController;
    use Modules\OneHotel\Http\Controllers\TourController;

    Route::group(['prefix' => 'admin/hotel', 'middleware' => ['auth']], static function () {

        /* Page Tour */
        Route::group(['prefix' => 'tour'], static function () {
            Route::group(['prefix' => '{page_id}'], static function () {
                Route::get('update', [TourController::class, 'updateActiveTourStatus'])->name('admin.tour.update');
            });
        });

        /* Settings */
        Route::group(['prefix' => 'settings'], static function () {
            Route::get('/', [OneHotelController::class, 'index'])->name('admin.hotel.settings.index');

            Route::group(['prefix' => '{id}'], static function () {
                Route::get('edit', [OneHotelController::class, 'edit'])->name('admin.hotel.settings.edit');
                Route::post('update', [OneHotelController::class, 'update'])->name('admin.hotel.settings.update');
            });
        });
    });
