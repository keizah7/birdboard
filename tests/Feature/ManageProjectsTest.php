<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guest_cannot_control_projects()
    {
        $project = factory(Project::class)->create();

        $this->get('projects')->assertRedirect('login');
        $this->get('projects/create')->assertRedirect('login');
        $this->post('projects', $project->toArray())->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->signIn();
        $attributes = [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'notes' => $this->faker->sentence,
        ];

        $this->get('projects/create')->assertOk();

        $response = $this->post('projects', $attributes);
        $project = Project::where($attributes)->first();
        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function a_user_can_update_a_project()
    {
        $this->signIn();

        $project = factory(Project::class)->create(['user_id' => auth()->id()]);

        $attributes = [
            'notes' => 'changed',
        ];
        $this->patch($project->path(), $attributes)
            ->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function a_user_can_view_their_project()
    {
        $this->signIn();

        $project = factory(Project::class)->create(['user_id' => auth()->id()]);
        $this->get($project->path())
            ->assertSee($project->title);
    }

    /** @test */
    public function a_user_cant_view_projects_of_others()
    {
        $this->signIn();
        $project = factory(Project::class)->create();

        $this->get($project->path())
            ->assertStatus(403);
    }

    /** @test */
    public function a_user_cant_update_projects_of_others()
    {
        $this->signIn();
        $project = factory(Project::class)->create();

        $this->patch($project->path(), [])
            ->assertStatus(403);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->signIn();

        $attributes = factory(Project::class)->raw([
            'title' => '',
        ]);

        $this->post('projects', $attributes)
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = factory(Project::class)->raw([
            'description' => '',
        ]);

        $this->post('projects', $attributes)
            ->assertSessionHasErrors('description');
    }

}
