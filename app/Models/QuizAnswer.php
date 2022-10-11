<?php

namespace App\Models;

use App\Models\Traits\Relationship\QuizAnswerRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory,
        QuizAnswerRelationship;


    protected $fillable = [
        'value',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];
}
