@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <a href="/to-do-list" class="btn btn-outline-primary btn-sm">Go back</a>
            <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                <h4 class="display-10" style="margin-left:10px">Create a New Task</h4><br>

                <form action="{{ route('store-task') }}" method="POST">
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
                    </div>
                    <div class="row mt-2">
                        <div class="control-group col-8 text-center">
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