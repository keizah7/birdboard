<?php

namespace Tests\Setup;

use App\Project;
use App\Task;
use App\User;

class ProjectFactory
{
    protected $tasksCount = 0;
    protected $user;

    /**
     * @param $count
     * @return $this
     */
    public function withTasks($count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    /**
     * @param $user
     * @return $this
     */
    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function create()
    {
        $project = Project::factory([
            'user_id' => $this->user ?? User::factory()->create()->id,
        ])
            ->create();

        Task::factory([
            'project_id' => $project->id,
        ])
            ->count($this->tasksCount)
            ->create();

        return $project;
    }
}
