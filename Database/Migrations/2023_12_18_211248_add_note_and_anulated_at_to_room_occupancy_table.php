<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoteAndAnulatedAtToRoomOccupancyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_occupancy', function (Blueprint $table) {
            $table->longText('note')->nullable();
            $table->date('anulated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('room_occupancy', function (Blueprint $table) {
            $table->dropColumn('note');
            $table->dropColumn('anulated_at');
        });
    }
}
