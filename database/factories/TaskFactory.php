<?php


namespace Database\Factories;

use App\Project;
use App\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $project = Project::query()->inRandomOrder()->first();

        return [
            'project_id' => $this->faker->boolean ? ($project->id ?? Project::factory()) : Project::factory(),
            'body' => $this->faker->sentence(),
            'completed' => $this->faker->boolean,
        ];
    }
}
