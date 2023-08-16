<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AddColumnsToSettingsSocialsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('settings_socials', static function (Blueprint $table) {
                $table->string('tripadvisor_url')->nullable()->default('');
                $table->string('holiday_check_url')->nullable()->default('');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('settings_socials', function (Blueprint $table) {
                $table->dropColumn('tripadvisor_url');
                $table->dropColumn('holiday_check_url');
            });
        }
    }
