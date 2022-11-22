@extends('layout')
@section('title', 'Edit Task')

@section('content')


<div class="row">
    <div class="col-md-6 offset-md-3">
        <h3 class="text-center">Edit Task</h3>
        <form action="{{ route('task.update', [$task->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $task->name }}" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" value="Save" class="btn btn-primary btn-block">
            </div>
        </form>
    </div>
</div>

@endsection