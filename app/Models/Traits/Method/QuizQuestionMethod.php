<?php

namespace App\Models\Traits\Method;

/**
 * Trait ClientMethod
 * @package App\Models\Traits\Method
 */
trait QuizQuestionMethod
{
    /**
     * @return bool
     */
    public function isRadio(): bool
    {
        return (bool) ($this->type == $this::QUESTION_TYPE_RADIO);
    }

    /**
     * @return bool
     */
    public function isTextarea(): bool
    {
        return (bool) ($this->type == $this::QUESTION_TYPE_TEXTAREA);
    }
}
