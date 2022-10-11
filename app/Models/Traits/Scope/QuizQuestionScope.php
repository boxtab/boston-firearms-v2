<?php

namespace App\Models\Traits\Scope;

use App\Constants\QuizConstants;

/**
 * Trait QuizQuestionScope
 * @package App\Models\Traits\Scope
 */
trait QuizQuestionScope
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query): mixed
    {
        return $query->where('active', 1);
    }

    /**
     * @param $query
     * @param string $name
     *
     * @return mixed
     */
    public function scopeByName($query, $name = QuizConstants::QUIZ_TYPE_DEFAULT): mixed
    {
        return $query->where('name', '=', $name);
    }
}
