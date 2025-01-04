<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CentralDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name'  => 'centrale admin',
            'email' => 'centraladmin@taxiklik.nl',
            'role'  => 'admin',
            'password'  => Hash::make('111111'),
        ]);
    }
}
