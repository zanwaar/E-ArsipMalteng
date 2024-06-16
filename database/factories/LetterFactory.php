<?php

namespace Database\Factories;

use App\Enums\LetterType;
use App\Models\Letter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Letter>
 */
class LetterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor_dokument' => $this->faker->ean13(),
            'nomor_agenda' => $this->faker->randomNumber(5),
            'pengirim' => $this->faker->name('male'),
            'penerima' => $this->faker->name('female'),
            'bidang' =>  $this->faker->randomElement(['Bidang 1', 'Bidang 2', 'Bidang 3', 'Bidang 4']),
            'tgl_dokument' => $this->faker->date(),
            'tgl_diterima' => $this->faker->date(),
            'description' => $this->faker->sentence(7),
            'note' => $this->faker->sentence(3),
            'type' => $this->faker->randomElement([LetterType::BIDANG->type(), LetterType::INCOMING->type(), LetterType::OUTGOING->type()]),
            'klasifikasi_kode' => 'ADM',
            'user_id' => 1,
        ];
    }
}
