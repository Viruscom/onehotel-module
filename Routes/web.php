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
            Route::get('/create', [RoomOccupancyController::class, 'create'])->name('admin.room_occupancy.create');
            Route::post('/store', [RoomOccupancyController::class, 'store'])->name('admin.room_occupancy.store');

            Route::group(['prefix' => 'multiple'], static function () {
                Route::get('active/{active}', [RoomOccupancyController::class, 'activeMultiple'])->name('admin.room_occupancy.active-multiple');
                Route::get('delete', [RoomOccupancyController::class, 'deleteMultiple'])->name('admin.room_occupancy.delete-multiple');
            });

            Route::group(['prefix' => '{id}'], static function () {
                Route::get('edit', [RoomOccupancyController::class, 'edit'])->name('admin.room_occupancy.edit');
                Route::post('update', [RoomOccupancyController::class, 'update'])->name('admin.room_occupancy.update');
                Route::get('delete', [RoomOccupancyController::class, 'delete'])->name('admin.room_occupancy.delete');
                Route::get('show', [RoomOccupancyController::class, 'show'])->name('admin.room_occupancy.show');
                Route::get('/active/{active}', [RoomOccupancyController::class, 'active'])->name('admin.room_occupancy.changeStatus');
                Route::get('position/up', [RoomOccupancyController::class, 'positionUp'])->name('admin.room_occupancy.position-up');
                Route::get('position/down', [RoomOccupancyController::class, 'positionDown'])->name('admin.room_occupancy.position-down');
                Route::get('image/delete', [RoomOccupancyController::class, 'deleteImage'])->name('admin.room_occupancy.delete-image');
            });
        });

        /* Settings */
        Route::group(['prefix' => 'settings'], static function () {
            Route::get('/', [OneHotelController::class, 'index'])->name('admin.hotel.settings.index');
            Route::post('update', [OneHotelController::class, 'update'])->name('admin.hotel.settings.update');
        });
    });
