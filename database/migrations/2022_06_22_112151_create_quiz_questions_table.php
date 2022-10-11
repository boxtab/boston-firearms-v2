<?php

use App\Constants\QuizConstants;
use App\Models\QuizQuestion;
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
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20)->default( QuizConstants::QUIZ_TYPE_DEFAULT )->comment('todo - should moved in separate table if more than 2 quiz will be needed in future');
            $table->string('text');
            $table->smallInteger('type')->default( QuizQuestion::QUESTION_TYPE_RADIO );
            $table->unsignedBigInteger('correct_answer_id')->nullable();
            $table->smallInteger('position')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_questions');
    }
};
