<?php

    namespace Modules\OneHotel\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\JsonResponse;

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
            'phone',
            'note',
            'anulated_at'
        ];

        public static function getRooms($roomId): JsonResponse
        {
            $roomDates = RoomOccupancy::where('page_id', $roomId)->orderBy('start_date', 'desc')->get();

            return response()->json($roomDates);
        }
    }
