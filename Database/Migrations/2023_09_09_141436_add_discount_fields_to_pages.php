<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AddDiscountFieldsToPages extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('pages', function (Blueprint $table) {
                $table->boolean('from_discounted_price')->default(false);
                $table->decimal('discounted_price', 10, 2)->nullable();
            });
        }

        public function down()
        {
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('from_discounted_price');
                $table->dropColumn('discounted_price');
            });
        }
    }
