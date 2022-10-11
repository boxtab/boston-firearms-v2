<?php

namespace App\Orchid\Screens\Client;

use App\Models\Client;
use App\Models\Event;
use App\Orchid\Layouts\Client\ClientListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ClientListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'clients' => Client::filters()->defaultSort('id', 'asc')->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Clients';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All clients';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'client.create',
            'client.edit',
            'client.show',
            'client.delete',
            'client.access',
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->href(route('platform.systems.clients.create')),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ClientListLayout::class,
        ];
    }
}
