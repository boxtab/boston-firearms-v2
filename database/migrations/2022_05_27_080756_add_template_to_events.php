<?php

use App\Models\Event;
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
        Schema::table('events', function (Blueprint $table) {
            $table->string('custom_template')->nullable()->after('position');
            $table->boolean('is_featured')->default(false)->after('position');
        });
        $basicEvent = Event::where('slug', '=', 'mass-basic-firearm-safety-course')->first();
        if (!empty($basicEvent)) {
            $basicEvent->forceFill([
                'custom_template' => 'class-basic-safety',
                'is_featured' => true,
            ])->save();
        }
        $multiEvent = Event::where('slug', '=', 'non-resident-multi-state-license')->first();
        if (!empty($multiEvent)) {
            $multiEvent->forceFill([
                'custom_template' => 'class-multi-state-safety',
                'is_featured' => true,
            ])->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('custom_template');
            $table->dropColumn('is_featured');
        });
    }
};
