<?php

namespace App\Http\Requests\Quiz;


use Illuminate\Foundation\Http\FormRequest;

class AjaxActionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $allowedActions = ['question'];
        return [
            'action' => ['required', 'in:' . implode(',', $allowedActions)]
        ];
    }
}
