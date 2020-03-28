<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function has_a_projects()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}
