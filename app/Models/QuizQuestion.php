<?php

namespace App\Models;

use App\Models\Traits\Method\QuizQuestionMethod;
use App\Models\Traits\Relationship\QuizQuestionRelationship;
use App\Models\Traits\Scope\QuizQuestionScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory,
        QuizQuestionRelationship,
        QuizQuestionMethod,
        QuizQuestionScope;

    const QUESTION_TYPE_RADIO = 1;
    const QUESTION_TYPE_TEXTAREA = 2;

    protected $fillable = [
        'text',
        'name',
        'type',
        'active',
        'position',
        'correct_answer_id',
        'order'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];

}
