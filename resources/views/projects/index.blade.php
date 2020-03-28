@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center mb-3">
        <h1 class="mr-auto">Birdboard</h1>
        <a href="{{ route('projects.create') }}">Create</a>
    </div>

    @forelse($projects as $project)
        <a href="{{ $project->path() }}">{{ $project->title }}</a>
    @empty
        No projects yet
    @endforelse
@endsection
