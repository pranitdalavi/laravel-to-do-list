<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag & Drop or Browse: File Upload | CodingNepal</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />


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
                                <input type="text" id="title" class="form-control" name="title" placeholder="Enter Task Title" value="{{ $task->title }}">
                                @if($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif<br>
                            </div>
                            <div class="control-group col-8" style="margin-left:10px">
                                <label for="title">Task Description :</label><br>
                                <input type="text" id="description" class="form-control" name="description" placeholder="Enter Task Description" value="{{ $task->description }}">
                                @if($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif<br>
                            </div>
                            <div class="control-group col-8" style="margin-left:10px">
                                <label for="title">Task Due Date :</label><br>
                                <input type="text" id="due_date" class="form-control" name="due_date" placeholder="Enter Task Due Date" value="{{ $task->due_date }}">
                                @if($errors->has('due_date'))
                                <span class="text-danger">{{ $errors->first('due_date') }}</span>
                                @endif<br>
                            </div>
                            <div class="form-group">
                                <label for="document">Task Images : </label>
                                <div class="needsclick dropzone" id="document-dropzone">
                                </div>
                                @if($errors->has('task_images'))
                                <span class="text-danger">{{ $errors->first('task_images') }}</span>
                                @endif<br>
                            </div>
                            <button type="submit" value="Submit">Update Task</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @endsection

</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: 'projects/media',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(file, response) {
            $('form').append('<input type="hidden" name="task_images[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="task_images[]"][value="' + name + '"]').remove()
        },
        init: function() {

            for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="task_images[]" value="' + file.file_name + '">')
            }

        }
    }
</script>