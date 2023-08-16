<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AddColumnsToCategoryPagesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('category_pages', function (Blueprint $table) {
                $table->boolean('with_reservation_btn')->default(false);
                $table->boolean('with_tour_btn')->default(false);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('category_pages', function (Blueprint $table) {
                $table->dropColumn('with_reservation_btn');
                $table->dropColumn('with_tour_btn');
            });
        }
    }
