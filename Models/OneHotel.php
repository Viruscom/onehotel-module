<?php

    namespace Modules\OneHotel\Models;

    use Illuminate\Database\Eloquent\Model;

    class OneHotel extends Model
    {
        public static function getReservationPage($viewArray)
        {
            //Get current reservation system
            return view('onehotel::front.reservations', [
                'viewArray' => $viewArray,
                'reservationSystem'
            ]);
        }
    }
