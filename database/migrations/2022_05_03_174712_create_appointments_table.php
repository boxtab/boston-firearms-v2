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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->date('event_date');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('spots')->default(0);
            $table->double('registration_fee',3,2)->default(0.00);
            $table->double('deposit_fee',3,2)->default(0.00);
            $table->smallInteger('payment_type')->default(1);
            $table->boolean('has_live_fire')->default(true);
            $table->boolean('is_guest_allowed')->default(true);
            $table->unsignedBigInteger('added_by');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->cascadeOnDelete();
            $table->foreign('added_by')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['added_by']);
        });
        Schema::dropIfExists('appointments');
    }
};
