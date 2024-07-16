<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientRepo = new ClientRepository();
        // Create personal access client
        $clientRepo->createPersonalAccessClient(
            null,
            'Personal Access Client',
            'http://localhost'
        );

        // Create password grant client if necessary
        $clientRepo->createPasswordGrantClient(
            null,
            'Password Grant Client',
            'http://localhost'
        );
    }
}
