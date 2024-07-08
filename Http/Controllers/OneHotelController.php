<?php

    namespace Modules\OneHotel\Http\Controllers;

    use Illuminate\Contracts\Support\Renderable;
    use Illuminate\Routing\Controller;
    use Modules\OneHotel\Models\OneHotel;

    class OneHotelController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return Renderable
         */
        public function index()
        {
            return view('onehotel::admin.settings.index', [
                'hotelSettings' => OneHotel::first()
            ]);
        }

        public function update()
        {

        }
    }
