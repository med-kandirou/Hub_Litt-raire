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
            'image' => 'https://res.cloudinary.com/dxn7gskyn/image/upload/v1680001696/book3_bvizxs.png',
            'pdf' => 'https://res.cloudinary.com/dxn7gskyn/image/upload/v1680001865/nodejs_o20sfo.pdf',
            'isArchived' => 0,
            'id_cat' => categorie::factory()
        ];
    }
}
