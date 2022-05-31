<?php

namespace Database\Factories;

use App\Models\Matter;
use App\Models\MatterType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MatterFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'type' => MatterType::POST,
            'public_at' => now(),
        ];
    }

    public function post(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => MatterType::POST,
            ];
        });
    }

    public function bookmark(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => MatterType::BOOKMARK,
            ];
        });
    }

    public function tool(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => MatterType::TOOL,
            ];
        });
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Matter $matter) {
            $matter->slug = Str::slug($matter->name);
        });
    }
}
