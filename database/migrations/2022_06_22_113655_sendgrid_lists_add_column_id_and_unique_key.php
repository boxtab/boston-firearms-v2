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
        Schema::table('sendgrid_lists', function (Blueprint $table) {
            $table->id()->first();
            $table->unique(['list_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sendgrid_lists', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropUnique(['list_id']);
        });
    }
};
