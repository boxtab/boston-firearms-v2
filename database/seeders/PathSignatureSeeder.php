<?php

namespace Database\Seeders;

use App\Constants\SignaturesPathConstant;
use App\Models\User;
use Illuminate\Database\Seeder;

class PathSignatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (SignaturesPathConstant::SIGNATURES_PATH as $name => $signaturePath) {

            if ( empty($signaturePath) ) {
                continue;
            }

            if ( ! file_exists(storage_path($signaturePath)) ) {
                continue;
            }

            $users = User::on()->where('name', '=', $name)->get();
            if ( $users->count() !== 1 ) {
                continue;
            }

            $user = $users->first();
            $user->signature_path = $signaturePath;
            $user->save();

            $this->command->info('The paths to the caption images are spelled out');
        }
    }
}
