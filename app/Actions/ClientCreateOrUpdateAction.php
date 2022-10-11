<?php

namespace App\Actions;

use App\Constants\UserSuperAdminConstant;

use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientCreateOrUpdateAction {

    /**
     * @param array $clientData
     *
     * @return Client
     */
    public function handle(?int $clientId, array $clientData): Client
    {
        $client = Client::query()
                        ->when(!empty($clientId), function($query) use ($clientData, $clientId) {
                            return $query->where('id', $clientId);
                        })
                        ->when(empty($clientId), function($query) use ($clientData) {
                            return $query->where('email', $clientData['email']);
                        })
                        ->first();

        if (is_null($client)) {
            $client = DB::transaction(function () use ($clientData){
                return Client::create(array_merge($clientData, ['added_by' => UserSuperAdminConstant::ID]));
            });
        } else {
            $client->update($clientData);
        }

        return $client->refresh();
    }
}
