<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('groupon_code', 64)->nullable()->after('guests');
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('groupon_code');
            $table->dropColumn('has_live_fire');
            $table->dropColumn('info_source_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('bookings', 'groupon_code') ) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropColumn('groupon_code');
            });
        }

        Schema::table('clients', function (Blueprint $table) {
            $table->string('groupon_code', 64)->nullable()->after('email');
            $table->boolean('has_live_fire')->default(true)->after('is_guest');
            $table->unsignedBigInteger('info_source_id')->after('has_live_fire')->nullable();
        });
    }
};
