<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Livre;
use App\Models\categorie;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livre>
 */
class LivreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Livre::class;
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'image' => 'https://res.cloudinary.com/dxn7gskyn/image/upload/v1677273761/books/q5boqmb3y6lugprccxm7.jpg',
            'pdf' => 'https://res.cloudinary.com/dxn7gskyn/image/upload/v1677273777/books/qqcdqj3tizdl1z3upe5n.pdf',
            'isArchived' => 0,
            'id_cat' => categorie::factory()
        ];
    }
}
