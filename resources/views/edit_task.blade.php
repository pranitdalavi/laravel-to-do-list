
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Drag & Drop or Browse: File Upload | CodingNepal</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    
    
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body{
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 60vh;
  background: #5256ad;
}
.drag-area{
margin-left: 1.8rem;
  border: 2px dashed #000000;
  height: 190px;
  width: 700px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
.drag-area.active{
  border: 2px solid #fff;
}
.drag-area .icon{
  font-size: 60px;
  color: #000000;
}
.drag-area header{
  font-size: 10px;
  font-weight: 500;
  color: #000000;
}
.drag-area span{
  font-size: 15px;
  font-weight: 500;
  color: #000000;
  margin: 10px 0 15px 0;
}
.drag-area button{
  padding: 10px 25px;
  font-size: 10px;
  font-weight: 500;
  border: none;
  outline: none;
  background: #000000;
  color: #fff;
  border-radius: 5px;
  cursor: pointer;
}
.drag-area img{
  height: 100%;
  width: 100%;
  object-fit: cover;
  border-radius: 5px;
}
        </style>
    </head>
    
    
    
<body>


@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-8 pt-2">
            <a href="/to-do-list" class="btn btn-outline-primary btn-sm">Go back</a>
            <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                <h4 class="display-20" style="margin-left:10px">Edit Task</h4><br>

                <form action="{{ route('store-task') }}" enctype='multipart/form-data' method="POST">
                    @csrf
                    <div class="row">
                        <div class="control-group col-8">
                            <input type="hidden" name="id" value="{{ $task->id }}">
                        </div>
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="title">Task Title :</label><br>
                            <input type="text" id="title" class="form-control" name="title"
                                placeholder="Enter Task Title" value="{{ $task->title }}">
                            @if($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif<br>
                        </div>
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="title">Task Description :</label><br>
                            <input type="text" id="description" class="form-control" name="description"
                                placeholder="Enter Task Description" value="{{ $task->description }}">
                            @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif<br>
                        </div>
                        <div class="control-group col-8" style="margin-left:10px">
                            <label for="title">Task Due Date :</label><br>
                            <input type="text" id="due_date" class="form-control" name="due_date"
                                placeholder="Enter Task Due Date" value="{{ $task->due_date }}">
                            @if($errors->has('due_date'))
                            <span class="text-danger">{{ $errors->first('due_date') }}</span>
                            @endif<br>
                        </div>

                        <div class="drag-area">
                            <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <header>Drag & Drop to Upload File</header>
                            <span>OR</span>
                            <button>Browse File</button>
                            <input type="file" hidden>
                          </div>

                        {{-- <div class="control-group col-8" style="margin-left:10px">
                            <label for="title">Task Image :</label><br>
                            <input type="file" id="due_date" class="form-control" name="task_image[]"
                                value="{{ $task->due_date }}" multiple>
                            @if($errors->has('task_image'))
                            <span class="text-danger">{{ $errors->first('task_image') }}</span>
                            @endif<br>
                        </div> --}}
                    </div>
                    <div class="row mt-2">
                        <div class="control-group col-8 text-center">
                            @if(session()->has('message'))
                            <div id="success" class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif
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