<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateHotelSettingsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('hotel_settings', function (Blueprint $table) {
                $table->id();
                $table->text('default_reservation_system')->nullable()->default('inquiry');
                $table->text('clientric_key')->nullable();
                $table->text('clock_key')->nullable();
                $table->text('travelline_key')->nullable();

                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('hotel_settings');
        }
    }
