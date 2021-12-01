@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex bd-highlight mb-4">
        <div class="p-2 w-100 bd-highlight">
            <h2>Tasks List</h2>
        </div>
        <div class="p-2 flex-shrink-0 bd-highlight">
            <button class="btn btn-success" id="btn-add">
                Add task
            </button>
        </div>
    </div>

    <div>
        <table class="table table-inverse">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody id="tasks-list" name="tasks-list">
                @foreach ($tasks as $task)
                <tr id="task{{$task->id}}">
                    <td>{{$task->id}}</td>
                    <td>{{$task->user->name}}</td>
                    <td>{{$task->title}}</td>
                    <td>{{$task->description}}</td>
                    <td>
                        <button type="button" class="btn btn-primary" id="btn-edit" value="edit">Edit</button>
                        <button type="button" class="btn btn-danger" id="btn-delete" value="delete">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
           
        </table>
        <div style="float: right;">{{ $tasks->links() }}</div>
        
        <div class="modal fade" id="formModalCreate" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="formModalLabel">Create Task</h4>
                    </div>
                    <div class="modal-body">
                        <form id="myForm" name="myForm" class="form-horizontal" novalidate="">

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter title" value="">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Enter Description" value="">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes
                        </button>
                        <input type="hidden" id="task_id" name="task_id" value="0">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
