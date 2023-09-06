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
    use Modules\OneHotel\Http\Controllers\RoomOccupancyController;
    use Modules\OneHotel\Http\Controllers\TourController;

    Route::group(['prefix' => 'admin/hotel', 'middleware' => ['auth']], static function () {

        /* Page Tour */
        Route::group(['prefix' => 'tour'], static function () {
            Route::group(['prefix' => '{page_id}'], static function () {
                Route::get('update', [TourController::class, 'updateActiveTourStatus'])->name('admin.tour.update');
            });
        });

        /* Room occupancy */
        Route::group(['prefix' => 'room_occupancy'], static function () {
            Route::get('/', [RoomOccupancyController::class, 'index'])->name('admin.room_occupancy.index');
            Route::post('/store', [RoomOccupancyController::class, 'store'])->name('admin.room_occupancy.store');
        });

        /* Settings */
        Route::group(['prefix' => 'settings'], static function () {
            Route::get('/', [OneHotelController::class, 'index'])->name('admin.hotel.settings.index');
            Route::post('update', [OneHotelController::class, 'update'])->name('admin.hotel.settings.update');
        });
    });
