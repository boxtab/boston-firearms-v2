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
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable()->after('name');
            $table->string('certification_number')->nullable()->after('remember_token');
            $table->date('certification_expiration')->nullable()->after('certification_number');
            $table->date('ltc_expiration')->nullable()->after('certification_expiration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('certification_number');
            $table->dropColumn('certification_expiration');
            $table->dropColumn('ltc_expiration');
        });
    }
};
