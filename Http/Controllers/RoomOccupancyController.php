<?php

    namespace Modules\OneHotel\Http\Controllers;

    use App\Models\CategoryPage\CategoryPage;
    use Carbon\Carbon;
    use Illuminate\Contracts\Support\Renderable;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Modules\OneHotel\Models\RoomOccupancy;

    class RoomOccupancyController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return Renderable
         */
        public function index()
        {
            $rooms = CategoryPage::where('with_reservation_btn', true)->with('pages')->get();

            return view('onehotel::admin.rooms_occupancy.index', compact('rooms'));
        }

        public function getRoomDates($roomId)
        {
            $roomDates = RoomOccupancy::where('page_id', $roomId)->orderBy('start_date', 'desc')->get();

            return response()->json($roomDates);
        }

        public function store(Request $request)
        {
            if (!$request->has('roomId')) {
                return response()->json(['message' => trans('onehotel::admin.rooms_occupancy.room_not_found')]);
            }
            RoomOccupancy::create([
                                      'page_id'    => $request->roomId,
                                      'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                                      'end_date'   => Carbon::parse($request->end_date)->format('Y-m-d'),
                                      'first_name' => $request->first_name,
                                      'last_name'  => $request->last_name,
                                      'email'      => $request->email,
                                      'phone'      => $request->phone,
                                      'note'       => $request->note,
                                  ]);

            $roomDates = RoomOccupancy::where('page_id', $request->roomId)->orderBy('start_date', 'desc')->get();

            return response()->json($roomDates);
        }

        public function update(Request $request, $roomId, $itemId)
        {
            $roomOccupancy = RoomOccupancy::where('page_id', $roomId)->where('id', $itemId)->first();
            if (is_null($roomOccupancy)) {
                return response()->json(['message' => trans('onehotel::admin.rooms_occupancy.room_not_found')]);
            }
            $roomOccupancy->update([
                                       'start_date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                                       'end_date'   => Carbon::parse($request->end_date)->format('Y-m-d'),
                                       'first_name' => $request->first_name,
                                       'last_name'  => $request->last_name,
                                       'email'      => $request->email,
                                       'phone'      => $request->phone,
                                       'note'       => $request->note,
                                   ]);

            $roomDates = RoomOccupancy::where('page_id', $roomId)->orderBy('start_date', 'desc')->get();

            return response()->json($roomDates);
        }

        public function anulateRoomReservation(Request $request)
        {
            if (!$request->has('roomId')) {
                return response()->json(['message' => trans('onehotel::admin.rooms_occupancy.room_not_found')]);
            }

            $room = RoomOccupancy::where('page_id', $request->roomId)
                ->where('start_date', $request->start_date)
                ->where('end_date', $request->end_date)
                ->where('first_name', $request->first_name)
                ->where('last_name', $request->last_name)
                ->where('email', $request->email)
                ->first();
            if (is_null($room)) {
                return response()->json(['message' => trans('onehotel::admin.rooms_occupancy.room_not_found')]);
            }

            $room->delete();

            $roomDates = RoomOccupancy::where('page_id', $request->roomId)->orderBy('start_date', 'desc')->get();

            return response()->json($roomDates);
        }

    }
