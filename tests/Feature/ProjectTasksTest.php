<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = factory(Project::class)->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test */
    public function only_a_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();
        $project = factory(Project::class)->create();

        $attributes = ['body' => 'Test task'];
        $this->post($project->path() . '/tasks', $attributes)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $attributes);
    }

    /** @test */
    public function only_a_owner_of_a_project_may_update_a_task()
    {
        $this->signIn();

        $project = ProjectFactory::withTasks(1)->create();

        $attributes = ['body' => 'changed'];
        $this->patch($project->tasks->first()->path(), $attributes)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $attributes);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->user)
            ->post($project->path() . '/tasks', ['body' => 'Test task']);

        $this->get($project->path())
            ->assertSee('Test task');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $attributes = ['body' => 'changed'];
        $this->actingAs($project->user)
            ->patch($project->tasks->first()->path(), $attributes);
        $this->assertDatabaseHas('tasks', $attributes);
    }

    /** @test */
    public function a_task_can_be_completed()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $attributes = [
            'body' => 'changed',
            'completed' => true,
        ];
        $this->actingAs($project->user)
            ->patch($project->tasks->first()->path(), $attributes);
        $this->assertDatabaseHas('tasks', $attributes);
    }

    /** @test */
    public function a_task_can_be_incompleted()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $attributes = [
            'body' => 'changed',
            'completed' => true,
        ];
        $this->actingAs($project->user)
            ->patch($project->tasks->first()->path(), $attributes);

        $this->patch($project->tasks->first()->path(), $attributes = [
            'body' => 'changed',
            'completed' => false,
        ]);
        $this->assertDatabaseHas('tasks', $attributes);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::create();

        $attributes = factory(Task::class)->raw(['body' => '']);

        $this->actingAs($project->user)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
