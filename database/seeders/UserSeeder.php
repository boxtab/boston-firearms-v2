<?php

namespace Database\Seeders;

use App\Services\CreateUserService;
use Illuminate\Database\Seeder;

/**
 * Class UserSeeder
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
{
    protected function createUser($userName)
    {
        $createUserService = new CreateUserService($userName);

        if ( $createUserService->emailIsNull() ) {
            $this->command->error( $createUserService->getEmailErrorMessage() );
            return;
        }

        if ( $createUserService->passwordIsNull() ) {
            $this->command->error( $createUserService->getPasswordErrorMessage() );
            return;
        }

        try {
            $createUserService->seeding();
            $this->command->info($createUserService->getTextSuccessMessage());
        } catch (\Exception $e) {
            $this->command->error($e->getMessage());
        }
    }
}
