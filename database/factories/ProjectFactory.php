<?php

namespace Database\Factories;

use App\Project;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $user = User::query()->inRandomOrder()->first();

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(6),
            'notes' => $this->faker->sentence(2),
            'user_id' => $this->faker->boolean ? ($user->id ?? User::factory()) : User::factory(),
        ];
    }
}
