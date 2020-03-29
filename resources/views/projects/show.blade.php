@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey text-sm font-normal">
                <a href="/projects" class="text-grey text-sm font-normal no-underline hover:underline">My Projects</a> / {{ $project->title }}
            </p>

            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img
                        src="{{ gravatar_url($member->email) }}"
                        alt="{{ $member->name }}'s avatar"
                        class="rounded-full w-8 mr-2">
                @endforeach

                <img
                    src="{{ gravatar_url($project->owner->email) }}"
                    alt="{{ $project->owner->name }}'s avatar"
                    class="rounded-full w-8 mr-2">

                <a href="{{ $project->path().'/edit' }}" class="button ml-4">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>

                    {{-- tasks --}}
                    @foreach($project->tasks as $task)
                        <form action="{{ $task->path() }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="card mb-3 flex">
                                <input type="text" name="body" id="" class="w-full {{ $task->completed ? 'text-grey' : '' }}" value="{{ $task->body }}">
                                <input type="checkbox" name="completed" id="" value="1" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                            </div>
                        </form>
                    @endforeach
                    <div class="card mb-3">
                        <form action="{{ route('tasks.store', $project) }}" method="post">
                            @csrf
                            <input type="text" name="body" id="" class="w-full" placeholder="Add a new task...">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>

                    {{-- general notes --}}
                    <form action="{{ $project->path() }}" method="post">
                        @csrf
                        @method('patch')

                        <textarea name="notes" class="card w-full" style="min-height: 200px" placeholder="Anything special that you want to make a note of?">{{ $project->notes }}</textarea>

                        <button type="submit" class="button">Submit</button>
                    </form>
                </div>
            </div>

            <div class="lg:w-1/4 px-3 lg:py-8">
                @include ('projects.card')
                @include ('projects.activity.card')

                @can ('manage', $project)
                    @include ('projects.invite')
                @endcan
            </div>
        </div>
    </main>
@endsection
