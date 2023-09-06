<?php

    namespace Modules\OneHotel\Http\Controllers;

    use Illuminate\Contracts\Support\Renderable;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;

    class RoomOccupancyController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return Renderable
         */
        public function index()
        {
            return view('onehotel::admin.rooms_occupancy.index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Renderable
         */
        public function create()
        {
            return view('onehotel::create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param Request $request
         *
         * @return Renderable
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Show the specified resource.
         *
         * @param int $id
         *
         * @return Renderable
         */
        public function show($id)
        {
            return view('onehotel::show');
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         *
         * @return Renderable
         */
        public function edit($id)
        {
            return view('onehotel::edit');
        }

        /**
         * Update the specified resource in storage.
         *
         * @param Request $request
         * @param int $id
         *
         * @return Renderable
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         *
         * @return Renderable
         */
        public function destroy($id)
        {
            //
        }
    }
