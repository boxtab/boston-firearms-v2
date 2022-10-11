<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoSourceSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'info-source.title' => ['string', 'required', 'max:255'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'info_source.title.required' => 'The tittle field must be filled in.',
            'info_source.title.max' => 'The tittle field is too long.',
        ];
    }
}
