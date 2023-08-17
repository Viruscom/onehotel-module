<?php

    namespace Modules\OneHotel\Database\Seeders;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Seeder;

    class OneHotelDatabaseSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            Model::unguard();

            $this->call(SpecialPageReservationsTableSeeder::class);
            $this->call(HotelSettingsTableSeeder::class);
        }
    }
