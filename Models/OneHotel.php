<?php

    namespace Modules\OneHotel\Models;

    use Illuminate\Database\Eloquent\Model;

    class OneHotel extends Model
    {
        const TOURS_PATH = 'hotel/tours';
        protected $table    = 'hotel_settings';
        protected $fillable = ['default_reservation_system', 'clientric_key', 'clock_key', 'travelline_key'];
        public static function getReservationPage($viewArray)
        {
            //Get current reservation system
            return view('onehotel::front.reservations', [
                'viewArray' => $viewArray,
                'reservationSystem'
            ]);
        }
    }
