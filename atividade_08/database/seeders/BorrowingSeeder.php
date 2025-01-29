<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BorrowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(50)->create(['role' => UserRolesEnum::CLIENT])->each(function (User $user) {
            Borrowing::factory(rand(1,5))->create([
                'user_id' => $user->id,
                'book_id' => Book::inRandomOrder()->first()->id,
            ]);
        });
    }
}
