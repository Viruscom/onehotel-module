<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AddColumnsToPagesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('pages', function (Blueprint $table) {
                $table->boolean('tour_active')->default(false);
                $table->boolean('tour_path')->nullable()->default(null);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('tour_active');
                $table->dropColumn('tour_path');
            });
        }
    }
