<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Layouts\Rows;

class UserInstructorLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.certification_number')
                ->type('text')
                ->max(255)
                ->title(__('Certification number')),

            Input::make('user.certification_expiration')
                ->type('date')
                ->title(__('Certification expiration date')),

            Input::make('user.ltc_expiration')
                ->type('date')
                ->title(__('LTC expiration date')),

            Picture::make('user.signature_path'),
        ];
    }
}
