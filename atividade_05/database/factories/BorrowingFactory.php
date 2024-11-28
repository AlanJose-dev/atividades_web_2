<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'book_id' => Book::inRandomOrder()->first()->id,
            'borrowed_at' => $this->faker->dateTimeBetween('-1 month'),
            'returned_at' => $this->faker->optional()->dateTimeBetween('now', '+1 month'),
        ];
    }
}