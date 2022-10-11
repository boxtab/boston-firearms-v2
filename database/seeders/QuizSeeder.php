<?php

namespace Database\Seeders;

use App\Constants\QuizConstants;
use App\Models\QuizQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    const QUESTION_TABLE = 'quiz_questions';
    const ANSWER_TABLE = 'quiz_answers';
    const ANSWER_QUESTION_PIVOT_TABLE = 'quiz_answer_question';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answers = DB::table(self::ANSWER_TABLE)->upsert([
            [
                'id' => 1,
                'value' => 'Yes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'value' => 'No',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ], ['id'], ['value', 'created_at', 'updated_at']);

        echo "Answers: $answers\n";

        $questions = DB::table(self::QUESTION_TABLE)->upsert([
            [
                'id' => 1,
                'name' => QuizConstants::QUIZ_TYPE_DEFAULT,
                'text' => 'Are you 21 years or older?',
                'type' => QuizQuestion::QUESTION_TYPE_RADIO,
                'correct_answer_id' => 1,
                'position' => 1,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => QuizConstants::QUIZ_TYPE_DEFAULT,
                'text' => 'Do you have your Massachusetts LTC already?',
                'type' => QuizQuestion::QUESTION_TYPE_RADIO,
                'correct_answer_id' => null,
                'position' => 2,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => QuizConstants::QUIZ_TYPE_DEFAULT,
                'text' => 'Have you ever been convicted of a felony?',
                'type' => QuizQuestion::QUESTION_TYPE_RADIO,
                'correct_answer_id' => 2,
                'position' => 3,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => QuizConstants::QUIZ_TYPE_DEFAULT,
                'text' => 'Are you the subject of a restraining order?',
                'type' => QuizQuestion::QUESTION_TYPE_RADIO,
                'correct_answer_id' => 2,
                'position' => 4,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => QuizConstants::QUIZ_TYPE_DEFAULT,
                'text' => 'Have you been dishonorably discharged from the armed forces?',
                'type' => QuizQuestion::QUESTION_TYPE_RADIO,
                'correct_answer_id' => 2,
                'position' => 5,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => QuizConstants::QUIZ_TYPE_DEFAULT,
                'text' => 'Have you been deemed mentally insane by a court of law.',
                'type' => QuizQuestion::QUESTION_TYPE_RADIO,
                'correct_answer_id' => 2,
                'position' => 6,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => QuizConstants::QUIZ_TYPE_DEFAULT,
                'text' => 'Do you have a drug addiction?',
                'type' => QuizQuestion::QUESTION_TYPE_RADIO,
                'correct_answer_id' => 2,
                'position' => 7,
                'active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => QuizConstants::QUIZ_TYPE_DEFAULT,
                'text' => 'Why are you interested in getting your license to carry in Massachusetts?',
                'type' => QuizQuestion::QUESTION_TYPE_TEXTAREA,
                'correct_answer_id' => null,
                'position' => 8,
                'active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'name' => QuizConstants::QUIZ_TYPE_DEFAULT,
                'text' => 'Would you be interested in legally carrying in other states outside of Massachusetts?',
                'type' => QuizQuestion::QUESTION_TYPE_RADIO,
                'correct_answer_id' => null,
                'position' => 9,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'name' => QuizConstants::QUIZ_TYPE_MULTI_STATE,
                'text' => 'Are you 99 years or older?',
                'type' => QuizQuestion::QUESTION_TYPE_RADIO,
                'correct_answer_id' => 1,
                'position' => 1,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ], ['id'], ['text', 'type', 'correct_answer_id', 'position', 'active', 'created_at', 'updated_at']);
        echo "Questions: $questions\n";

        DB::table(self::ANSWER_QUESTION_PIVOT_TABLE)->truncate();
        QuizQuestion::all()->each(function ($question){
            if ( $question->isRadio() ) {
                $question->answers()->sync([1,2]);
            }
        });
    }
}
