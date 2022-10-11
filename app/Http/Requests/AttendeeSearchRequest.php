<?php

namespace App\Http\Requests;

use App\Constants\ResultPerPageConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttendeeSearchRequest extends FormRequest
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
            'search_attendee' => ['required', 'array', ],
            'search_attendee.by_keyword' => ['nullable', 'string', 'max:255', ],
            'search_attendee.by_event' => ['nullable', ],
            'search_attendee.results_per_page' => ['nullable',],
            'search_attendee.by_date_start' => ['nullable', 'string', 'date_format:Y-m-d', ],
            'search_attendee.by_date_and' => ['nullable', 'string', 'date_format:Y-m-d', ],
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
            'search_attendee.required' => 'The attendee search field must be filled in.',
            'search_attendee.by_keyword.max' => 'The attendee search string is too long.',
            'search_attendee.by_date_start.date_format' => 'Invalid start date format.',
            'search_attendee.by_date_and.date_format' => 'Invalid end date format.',
        ];
    }
}
