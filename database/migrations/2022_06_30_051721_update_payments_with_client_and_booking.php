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
        Schema::table('payments', function (Blueprint $table){
            $table->unsignedBigInteger('client_id')->nullable(true)->after('type');
            $table->foreign('client_id')->on('clients')->references('id')->cascadeOnDelete('NO ACTION');

            $table->unsignedBigInteger('booking_id')->nullable(true)->after('client_id');
            $table->foreign('booking_id')->on('bookings')->references('id')->cascadeOnDelete('NO ACTION');

            $table->string('payment_token')->nullable()->after('status');

            $table->text('errors')->nullable()->after('payment_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table){

            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');

            $table->dropForeign(['booking_id']);
            $table->dropColumn('booking_id');

            $table->dropColumn('payment_token');
            $table->dropColumn('errors');
        });
    }
};
