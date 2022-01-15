<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create(['email' => env('DEVELOPER_EMAIL', 'admin@pluto.com'), 'name' => env('DEVELOPER_NAME', 'Hapák Józsi')]);
        \App\Models\User::factory(10)->create();
        \App\Models\Todo::factory(20)->create();
        \App\Models\Account::factory(20)->create();
    }
}
