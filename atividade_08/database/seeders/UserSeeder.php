<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'role' => UserRolesEnum::ADMIN,
        ]);

        User::factory(20)->create([
            'role' => UserRolesEnum::LIBRARIAN
        ]);
    }
}
