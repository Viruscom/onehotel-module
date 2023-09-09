<?php

    namespace Modules\OneHotel\Models;

    use Illuminate\Database\Eloquent\Model;

    class RoomOccupancy extends Model
    {
        protected $table = 'room_occupancy';

        protected $fillable = [
            'page_id',
            'start_date',
            'end_date',
            'first_name',
            'last_name',
            'email',
            'phone'
        ];
    }
