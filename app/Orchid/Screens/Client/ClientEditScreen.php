<?php

namespace App\Orchid\Screens\Client;

use App\Http\Requests\ClientSaveRequest;
use App\Models\Client;
use App\Orchid\Layouts\Client\ClientEditLayout;
use App\Repositories\ClientRepositoryInterface;
use App\Traits\PreviousPageTrait;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

/**
 * Class ClientEditScreen
 * @package App\Orchid\Screens\Client
 */
class ClientEditScreen extends Screen
{
    use PreviousPageTrait;

    /**
     * @var Client
     */
    public $client;

    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;

    /**
     * ClientEditScreen constructor.
     * @param ClientRepositoryInterface $clientRepository
     */
    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->rememberPage('client');

        $this->clientRepository = $clientRepository;
    }

    /**
     * Query data.
     *
     * @param Client $client
     *
     * @return iterable
     */
    public function query(Client $client): iterable
    {
        return [
            'client' => $client,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Manage client';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return $this->client->exists ? 'Edit Client' : 'Create Client';
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
            Button::make(__('Cancel'))
                ->icon('close')
                ->novalidate()
                ->method('cancel'),

            Button::make(__('Save'))
                ->icon('check')
                ->novalidate()
                ->method('save'),
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
            Layout::block([
                ClientEditLayout::class,
            ])
                ->title('Attendee Management')
                ->vertical(true),
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel()
    {
        return $this->redirectBack('client');
    }

    /**
     * @param Client $client
     * @param ClientSaveRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Client $client, ClientSaveRequest $request)
    {
        $clientFields = $request->get('client');
        $clientFields['ip_address'] = $request->ip();
        $this->clientRepository->store($client, $clientFields);

        Toast::info(__('Client was saved'));

        return $this->redirectBack('client');
    }
}
