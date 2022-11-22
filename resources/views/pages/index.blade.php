@extends('layout')
@section('title', 'Dashboard')

@section('content')

@if (session('message'))
    <div class="" style="padding-top: 20px;">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <div class="text-center text-success">{{ session('message') }}</div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="" style="margin-bottom: 30px;">
            <div class="row">
                <div class="col-md-8">
                    <h3>All Tasks</h3>
                </div>
                <div class="col-md-4">
                    <a href="#addTask" data-toggle="modal" class="btn btn-primary">Create Task</a>
                </div>
            </div>
        </div>
        @if (count($tasks) > 0)
            
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Created By</th>
                        <th>Date Created</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->user->name }}</td>
                        <td>{{ $task->created_at }}</td>
                        <td><a href="{{ route('task.edit', [$task->id]) }}" class="btn btn-default btn-sm border border-dark rounded">Edit</a></td>
                        <td>
                            <form action="{{ route('task.delete', [$task->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm border border-dark rounded">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3>No task</h3>
        @endif
    </div>
</div>

<!-- start modal -->
<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="addTask" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        <form action="{{ route('post.task') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required 
                class="form-control{{ $errors->has('name') ? ' is-invalid' : ''  }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary m-b-20">Submit</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>
<!-- end modal -->

@endsection