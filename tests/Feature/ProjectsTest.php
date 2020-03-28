<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $this->post('projects', $attributes)
            ->assertRedirect('projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('projects')
            ->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $attributes = factory(Project::class)->raw([
            'title' => '',
        ]);

        $this->post('projects', $attributes)
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $attributes = factory(Project::class)->raw([
            'description' => '',
        ]);

        $this->post('projects', $attributes)
            ->assertSessionHasErrors('description');
    }

}
