@extends('layouts.app')

@section('title')
    @lang('todo.todos')
@endsection

@section('content')

    <div class="card">
        <div class="card-content">
            {{-- Link to create new todo --}}
            <a href="{{ route('todos.create') }}" class="btn right">
                @lang('todo.create')
            </a>
            {{-- Show how much todo has been completed --}}
            <blockquote>
                @lang('todo.stat', ['completed' => $completed_count, 'expired' => $expired_count])
            </blockquote>
        </div>
    </div>

    @foreach ($todos as $todo)
        @include('todos.show', ['todo' => $todo])
    @endforeach
@endsection
