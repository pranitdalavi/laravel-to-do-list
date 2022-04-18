@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-8 pt-2">
            <a href="/to-do-list" class="btn btn-outline-primary btn-sm">Go back</a>
            <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                <h4 class="display-20" style="margin-left:10px">Edit Post</h4><br>

                <form action="{{ route('store-task') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="control-group col-8">
                            <input type="hidden" name="id" value="{{ $task->id }}">
                        </div>
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="title">Task Title :</label><br>
                            <input type="text" id="title" class="form-control" name="title"
                                placeholder="Enter Task Title" value="{{ $task->title }}"><br>
                        </div>
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="title">Task Description :</label><br>
                            <input type="text" id="description" class="form-control" name="description"
                                placeholder="Enter Task Description" value="{{ $task->description }}"><br>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="control-group col-8 text-center">
                            <button id="btn-submit" class="btn btn-primary">
                                Update Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection