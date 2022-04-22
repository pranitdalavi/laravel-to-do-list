<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag & Drop or Browse: File Upload | CodingNepal</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 60vh;
            background: #5256ad;
        }

        .drag-area {
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
    </style>
</head>



<body>
    @extends('layouts.app')

    @section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/to-do-list" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h4 class="display-10" style="margin-left:10px">Create a New Task</h4><br>

                    <form action="{{ route('store-task') }}" enctype="multipart/form-data" class="dropzone" id="dropzone" method="POST">
                        @csrf
                        <div class="row">
                            <div class="control-group col-8" style="margin-left:10px">
                                <label for="title">Task Title :</label>
                                <input type="text" id="title" class="form-control" name="title" placeholder="Enter Task Title">
                                @if($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif<br>
                            </div>
                            <div class="control-group col-8" style="margin-left:10px">
                                <label for="title">Task Description :</label>
                                <input type="text" id="description" class="form-control" name="description" placeholder="Enter Task Description">
                                @if($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif<br>
                            </div>
                            <div class="control-group col-8" style="margin-left:10px">
                                <label for="title">Task Due Date :</label>
                                <input type="text" id="due_date" class="form-control" name="due_date" placeholder="Enter Task Due Date">
                                @if($errors->has('due_date'))
                                <span class="text-danger">{{ $errors->first('due_date') }}</span>
                                @endif<br>
                            </div>
                            <form method="post" action="{{url('store-task')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                @csrf
                            </form>


                            <!-- <div class="control-group col-8" style="margin-left:10px">
                                <label for="title">Task Image :</label><br>
                                <input type="file" id="task_image" class="form-control" name="task_image[]" multiple>
                                @if($errors->has('task_image'))
                                <span class="text-danger">{{ $errors->first('task_image') }}</span>
                                @endif<br>
                            </div> -->
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
</body>

</html>

<script type="text/javascript">
    Dropzone.options.dropzone = {
        maxFilesize: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        autoProcessQueue: false,
        timeout: 5000,
        success: function(file, response) {
            console.log(response);
        },
        error: function(file, response) {
            return false;
        }
    };
</script>