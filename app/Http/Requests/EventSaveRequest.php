<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;

/**
 * Class EventSaveRequest
 * @package App\Http\Requests
 */
class EventSaveRequest extends FormRequest
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
            'event.title'                       => ['required', 'max:255'],
            'event.price'                       => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'event.slug'                        => [
                'required',
                'max:255',
                'alpha_dash',
            ],
            'event.radiobutton_active'          => ['required', 'between:1,2'],
            'event.radiobutton_has_live_fire'   => ['required', 'between:1,2'],

            'event.course_certification_number' => ['string', 'nullable', 'max:255'],
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
            'event.title.required' => 'The title field must be filled in.',
            'event.title.max' => 'The title field is too long.',

            'event.price.required' => 'The price field must be filled in.',
            'event.price.regex' => 'The price field must be a number.',

            'event.slug.required' => 'The slug field must be filled in.',
            'event.slug.max' => 'The slug field is too long.',
            'event.slug.alpha_dash' => 'The slug field can contain only alphanumeric characters, as well as hyphens and underscores.',

            'event.position.integer' => 'The order field must be a number.',
            'event.position.min' => 'The order field must be greater than zero.',

            'event.radiobutton_active.required' => 'The active field must be selected.',
            'event.radiobutton_active.between' => 'The active field can take two values yes or no.',

            'event.radiobutton_has_live_fire.required' => 'The live fire field must be selected.',
            'event.radiobutton_has_live_fire.between' => 'The live fire field can take two values yes or no.',

            'event.course_certification_number.max' => 'The course certification number field is too long.',
        ];
    }
}
