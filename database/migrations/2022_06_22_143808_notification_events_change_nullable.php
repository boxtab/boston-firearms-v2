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
        Schema::table('notification_events', function (Blueprint $table) {
            $table->string('slug', 255)->change();

            $table->unsignedBigInteger('sendgrid_list_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification_events', function (Blueprint $table) {
            $table->unsignedBigInteger('sendgrid_list_id')->change();

            $table->string('slug', 255)->nullable()->change();
        });
    }
};
