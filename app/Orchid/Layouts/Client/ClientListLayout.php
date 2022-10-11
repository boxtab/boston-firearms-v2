<?php

namespace App\Orchid\Layouts\Client;

use App\Models\Client;
use App\Models\Event;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ClientListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'clients';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'S.No.')
            ,

            TD::make('name', 'Name')
                ->filter(Input::make())
                ->render(function (Client $client) {
                    return Link::make($client->full_name_format)
                        ->route('platform.systems.clients.edit', $client->id);
                })
            ,

            TD::make('Email/Phone')
                ->render(function (Client $client) {
                    return $client->email . '/' . $client->phone;
                })
            ,

            TD::make('When')
                ->render(function () {
                    return 'STUB';
                })
            ,

            TD::make('Live Fire')
                ->render(function (Client $client) {
                    return 'STUB';/*$client->has_live_fire_format;*/
                })
            ,

            TD::make('Attendance')
                ->render(function () {
                    return 'STUB';
                })
            ,

            TD::make('Blacklist')
                ->render(function () {
                    return 'Add to STUB';
                })
            ,

            TD::make(__('Delete'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Client $client) {
                    return Button::make(__('Delete'))
                        ->icon('trash')
                        ->confirm(__('Are you sure you want to delete the client?'))
                        ->method('remove', [
                            'id' => $client->id,
                        ]);
                })
            ,

        ];
    }
}
