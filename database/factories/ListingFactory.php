<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //MATERI DATABASE IN LARAVEL - Penggunaan Model, Migration, Seeder, Factory Terkoneksi MySQL
        //diisi key-nya sesuai field di table pada database (table listings) untuk men-generate (menyiapkan) data fake
        return [
            'title' => $this->faker->sentence(),
            'tags' => 'laravel, api, backend',
            'company' => $this->faker->company(),
            'location' => $this->faker->city(),
            'email' => $this->faker->companyEmail(),
            'website' => $this->faker->url(),
            'description' => $this->faker->paragraph(5) //untuk teks panjang, value number itu adalah jumlah paragraf-nya
        ];
    }
}
