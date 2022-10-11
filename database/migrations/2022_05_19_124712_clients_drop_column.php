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
        Schema::table('clients', function (Blueprint $table) {

            $table->dropForeign(['event_id']);

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $table->dropColumn('event_id');
            $table->dropColumn('event_date');
            $table->dropColumn('time_slot_start');
            $table->dropColumn('time_slot_end');
            $table->dropColumn('payment_option_id');
            $table->dropColumn('payment_mode_id');
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->after('groupon_code');
            $table->date('event_date')->after('event_id');
            $table->time('time_slot_start')->after('event_date')->nullable();
            $table->time('time_slot_end')->after('time_slot_start')->nullable();
            $table->unsignedBigInteger('payment_option_id')->after('info_source_id')->nullable();
            $table->unsignedBigInteger('payment_mode_id')->after('payment_option_id')->nullable();

            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->cascadeOnDelete();
        });
    }
};
