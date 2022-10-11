<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('First name')),

            Input::make('user.last_name')
                ->type('text')
                ->max(255)
                ->title(__('Last name')),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email')),
        ];
    }
}
