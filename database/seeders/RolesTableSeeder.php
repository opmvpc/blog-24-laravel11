<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => Role::ADMIN,
        ]);

        Role::create([
            'name' => Role::AUTHOR,
        ]);

        Role::create([
            'name' => Role::USER,
        ]);
    }
}
