<?php

    namespace Modules\OneHotel\Database\Seeders;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Seeder;
    use Modules\OneHotel\Models\OneHotel;

    class HotelSettingsTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            Model::unguard();

            $settings = OneHotel::all();
            if (!is_null($settings)) {
                OneHotel::delete();
            }
            
            OneHotel::insert([
                                 'default_reservation_system' => 'inquiry',
                                 'clientric_key'              => '',
                                 'clock_key'                  => '',
                                 'travelline_key'             => ''
                             ]);
        }
    }
