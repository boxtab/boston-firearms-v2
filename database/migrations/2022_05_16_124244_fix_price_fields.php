<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('alter table events modify price DOUBLE(6,2) NOT NULL DEFAULT 0');
        DB::statement('alter table appointments modify registration_fee DOUBLE(6,2) NOT NULL  DEFAULT 0');
        DB::statement('alter table appointments modify deposit_fee DOUBLE(6,2) NOT NULL DEFAULT 0');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('alter table events modify price DOUBLE(4,2) NOT NULL  DEFAULT 0');
        DB::statement('alter table appointments modify registration_fee DOUBLE(3,2) NOT NULL  DEFAULT 0');
        DB::statement('alter table appointments modify deposit_fee DOUBLE(3,2) NOT NULL  DEFAULT 0');
    }
};
