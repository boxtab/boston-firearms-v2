<?php

namespace App\Models\Traits\Relationship;

use App\Models\QuizAnswer;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Trait QuizQuestionRelationship
 * @package App\Models\Traits\Relationship
 */
trait QuizQuestionRelationship
{
    public function answers()
    {
        return $this->belongsToMany(QuizAnswer::class, 'quiz_answer_question');
    }

    public function correctAnswer()
    {
        return $this->hasOne(QuizAnswer::class, 'id', 'correct_answer_id');
    }
}
