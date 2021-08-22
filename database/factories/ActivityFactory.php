<?php

namespace Database\Factories;

use App\Activity;
use App\Project;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $project = Project::query()->inRandomOrder()->first();
        $user = User::query()->inRandomOrder()->first();

        return [
            'project_id' => $this->faker->boolean ? ($project->id ?? Project::factory()) : Project::factory(),
            'user_id' => $this->faker->boolean ? ($user->id ?? User::factory()) : User::factory(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
