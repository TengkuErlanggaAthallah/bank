<?php

namespace Database\Factories;

use App\Models\Transfer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferFactory extends Factory
{
    protected $model = Transfer::class;

    public function definition()
    {
        return [
            'nama_pengirim' => $this->faker->name,
            'nama_penerima' => $this->faker->name,
            'nominal' => $this->faker->randomFloat(2, 1000, 10000), // Random amount between 1000 and 10000
            'tanggal' => $this->faker->date(),
        ];
    }
}