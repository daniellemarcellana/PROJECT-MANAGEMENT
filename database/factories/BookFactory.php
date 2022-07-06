<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bookTitle' => $this->faker->text($maxNbChars = 25),
            'isbn' => $this->faker->isbn13,
            'genre' => $this->faker->randomElement($array = array('Science', 'Mathematics', 'Politics', 'Psychology', 'Arts', 'Entertainment')),
            'author' => $this->faker->name,
            'publisher' => $this->faker->city,
            'publishingDate' => $this->faker->dateTime()->format('d-m-Y'),
            'illustrator' => $this->faker->name,
            'totalPages' => $this->faker->numberBetween($min = 10, $max = 500),
            'quantity' => $this->faker->numberBetween($min = 10, $max = 500),
            'image' => 'bookplaceholder.png'
        ];
    }
}
