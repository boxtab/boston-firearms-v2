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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id')->nullable(false);
            $table->unsignedBigInteger('client_id')->nullable(false);
            $table->unsignedBigInteger('payment_id')->nullable(true);
            $table->string('guests')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('appointment_id')->on('appointments')->references('id')->cascadeOnDelete();
            $table->foreign('client_id')->on('clients')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table){
            $table->dropForeign(['appointment_id']);
            $table->dropForeign(['client_id']);
        });
        Schema::dropIfExists('bookings');
    }
};
