@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <a href="/to-do-list" class="btn btn-outline-primary btn-sm">Go back</a>
            <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                <h4 class="display-10" style="margin-left:10px">Create a New Task</h4><br>

                <form action="{{ route('store-task') }}" enctype='multipart/form-data' method="POST">
                    @csrf
                    <div class="row">
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="title">Task Title :</label>
                            <input type="text" id="title" class="form-control" name="title"
                                placeholder="Enter Task Title">
                            @if($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif<br>
                        </div>
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="title">Task Description :</label>
                            <input type="text" id="description" class="form-control" name="description"
                                placeholder="Enter Task Description">
                            @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif<br>
                        </div>
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="title">Task Due Date :</label>
                            <input type="text" id="due_date" class="form-control" name="due_date"
                                placeholder="Enter Task Due Date">
                            @if($errors->has('due_date'))
                            <span class="text-danger">{{ $errors->first('due_date') }}</span>
                            @endif<br>
                        </div>
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="title">Task Image :</label><br>
                            <input type="file" id="task_image" class="form-control" name="task_image[]" multiple>
                            @if($errors->has('task_image'))
                            <span class="text-danger">{{ $errors->first('task_image') }}</span>
                            @endif<br>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="control-group col-8 text-center">
                            @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                            <button id="btn-submit" class="btn btn-primary">
                                Create Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>




@endsection