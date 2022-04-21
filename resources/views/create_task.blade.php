<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag & Drop or Browse: File Upload | CodingNepal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


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

    .drag-area.active {
        border: 2px solid #fff;
    }

    .drag-area .icon {
        font-size: 60px;
        color: #000000;
    }

    .drag-area header {
        font-size: 10px;
        font-weight: 500;
        color: #000000;
    }

    .drag-area span {
        font-size: 15px;
        font-weight: 500;
        color: #000000;
        margin: 10px 0 15px 0;
    }

    .drag-area button {
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

    .drag-area img {
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

                            <!-- <div class="drag-area">
                                <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <header>Drag & Drop to Upload File</header>
                                <span>OR</span>
                                <button>Browse File</button>
                                <input type="file" hidden>
                            </div> -->

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
    <script>
    //selecting all required elements
    const dropArea = document.querySelector(".drag-area"),
        dragText = dropArea.querySelector("header"),
        button = dropArea.querySelector("button"),
        input = dropArea.querySelector("input");
    let file; //this is a global variable and we'll use it inside multiple functions
    button.onclick = () => {
        input.click(); //if user click on the button then the input also clicked
    }
    input.addEventListener("change", function() {
        //getting user select file and [0] this means if user select multiple files then we'll select only the first one
        file = this.files[0];
        dropArea.classList.add("active");
        showFile(); //calling function
    });
    //If user Drag File Over DropArea
    dropArea.addEventListener("dragover", (event) => {
        event.preventDefault(); //preventing from default behaviour
        dropArea.classList.add("active");
        dragText.textContent = "Release to Upload File";
    });
    //If user leave dragged File from DropArea
    dropArea.addEventListener("dragleave", () => {
        dropArea.classList.remove("active");
        dragText.textContent = "Drag & Drop to Upload File";
    });
    //If user drop File on DropArea
    dropArea.addEventListener("drop", (event) => {
        event.preventDefault(); //preventing from default behaviour
        //getting user select file and [0] this means if user select multiple files then we'll select only the first one
        file = event.dataTransfer.files[0];
        showFile(); //calling function
    });

    function showFile() {
        let fileType = file.type; //getting selected file type
        let validExtensions = ["image/jpeg", "image/jpg", "image/png"]; //adding some valid image extensions in array
        if (validExtensions.includes(fileType)) { //if user selected file is an image file
            let fileReader = new FileReader(); //creating new FileReader object
            fileReader.onload = () => {
                let fileURL = fileReader.result; //passing user file source in fileURL variable
                // UNCOMMENT THIS BELOW LINE. I GOT AN ERROR WHILE UPLOADING THIS POST SO I COMMENTED IT
                // let imgTag = `<img src="${fileURL}" alt="image">`; //creating an img tag and passing user selected file source inside src attribute
                dropArea.innerHTML = imgTag; //adding that created img tag inside dropArea container
            }
            fileReader.readAsDataURL(file);
        } else {
            alert("This is not an Image File!");
            dropArea.classList.remove("active");
            dragText.textContent = "Drag & Drop to Upload File";
        }
    }
    </script>



    @endsection
</body>

</html>