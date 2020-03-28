<?php

namespace Tests\Unit;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function has_a_path()
    {
        $project = factory(Project::class)->create();

        $this->assertEquals('projects/' . $project->id, $project->path());
    }
}
