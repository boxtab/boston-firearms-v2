<?php

namespace App\Orchid\Layouts\InfoSource;

use App\Models\InfoSource;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class InfoSourceListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'infoSource';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'S.No.'),

            TD::make('title', 'Info Source'),

            TD::make('created_at', 'Created On')
                ->render(function (InfoSource $infoSource) {
                    return $infoSource->created_at_format;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (InfoSource $infoSource) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.systems.info-source.edit', $infoSource->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Are you sure you want to delete the info source?'))
                                ->novalidate()
                                ->method('remove', [
                                    'infoSourceId' => $infoSource->id,
                                ]),
                        ]);
                }),
        ];
    }
}
