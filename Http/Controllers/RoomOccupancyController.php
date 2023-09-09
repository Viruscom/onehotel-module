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
            $roomDates = RoomOccupancy::where('page_id', $roomId)->get();

            return response()->json($roomDates);
        }

        public function store(Request $request)
        {
            if (!$request->has('room_id')) {
                return response()->json(['message' => trans('onehotel::admin.rooms_occupancy.room_not_found')]);
            }
            $startDate = Carbon::createFromFormat('d.m.Y', $request->start_date);
            $endDate   = Carbon::createFromFormat('d.m.Y', $request->end_date);

            RoomOccupancy::create([
                                      'page_id'    => $request->room_id,
                                      'start_date' => $startDate,
                                      'end_date'   => $endDate,
                                  ]);

            return response()->json(['message' => trans('admin.common.successful_edit')]);
        }

    }
