@extends('layouts.app')

@section('content')
    <form action="{{ route('projects.store') }}" method="post">
        @csrf
        <label for="">
            Title
            <input type="text" name="title" id="">
        </label>
        <label for="">
            Description
            <textarea name="description" id="" cols="30" rows="10"></textarea>
        </label>
        <button type="submit">Save</button>
    </form>
@endsection
