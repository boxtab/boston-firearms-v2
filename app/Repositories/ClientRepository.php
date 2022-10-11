<?php

namespace App\Repositories;

use App\Models\Client;
use App\Traits\DateTimeTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ClientRepository
 * @package App\Repositories
 */
class ClientRepository extends Repository implements ClientRepositoryInterface
{
    use DateTimeTrait;

    /**
     * ClientRepository constructor.
     * @param Client $model
     */
    public function __construct(Client $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Client $client
     * @param array $clientFields
     */
    public function store(Client $client, array $clientFields)
    {
        $client->fill([
            'first_name' => $clientFields['first_name'],
            'last_name' => $clientFields['last_name'],
            'phone' => $clientFields['phone'],
            'email' => $clientFields['email'],
            'date_of_birth' => $clientFields['date_of_birth'],
            'ip_address' => $clientFields['ip_address'],
            'added_by' => Auth::id(),
        ]);

        $client->save();
    }
}
