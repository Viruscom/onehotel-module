<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateRoomOccupancyTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('room_occupancy', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('page_id');
                $table->date('start_date');
                $table->date('end_date');
                $table->timestamps();

                $table->foreign('page_id')->references('id')->on('pages');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('room_occupancy');
        }
    }
