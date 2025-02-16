<?php

namespace Database\Factories;

use App\Models\Influencer;
use Illuminate\Database\Eloquent\Factories\Factory;

class InfluencerFactory extends Factory
{
    protected $model = Influencer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'instagram_user' => $this->faker->userName,
            'followers_count' => $this->faker->numberBetween(1000, 100000),
            'category' => $this->faker->word,
        ];
    }
}