<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(1, 40, 100),
            'calories' => $this->faker->numberBetween(1000, 2500),
            'exercise_time' => $this->faker->time('H:i'),
            'exercise_content' => $this->faker->randomElement([
                'ジョギング',
                '筋トレ',
                'ヨガ',
                'HIIT',
                'ストレッチ',
                '水泳',
                'サイクリング',
            ]),
        ];
    }
}
