<html>

<head>
    <style>
    .hars {
        background-color: black;
        color: white;
        height: 2rem;
        padding-top: 1rem;
    }

    .btnn {
        margin-left: 13rem;
        margin-top: -1.2rem;

    }

    .navn {
        margin-left: 36rem;
    }
    </style>

    <script src="https://kit.fontawesome.com/2b29b6dab6.js" crossorigin="anonymous"></script>
</head>

<body>
    @extends('layouts.app')

    @section('content')

    <!-- Bootstrap Boilerplate... -->

    <div style="text-align: center" class="panel-body">
        <!-- Display Validation Errors -->

        <!-- New Task Form -->
        <form action="{{ route('store-task') }}" method="POST">
            {{ csrf_field() }}

            <!-- Task Name -->
            <div class="form-group" style="">
                <div class="col-sm-6">
                    <input type="text" name="description" id="task-name" class="form-control">
                </div>

            </div>

            <!-- Add Task Button -->
            <div class="form-group-1">
                <div class="form">
                    <button type="submit" class="btnn">
                        <i class="fa fa-btn fa-plus"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>


    <!-- TODO: Current Tasks -->
    @if (count($tasks) > 0)
    <div style="text-align: center" class="panel panel-default">
        <!-- <div class="panel-heading">
        Current Tasks
    </div> -->

        <div class="panel-body">
            <table class="navn">

                <!-- Table Headings -->
                <div>
                    <thead>
                        <th>&nbsp;</th>
                    </thead>
                </div>


                <!-- Table Body -->
                <tbody class="navn">
                    @foreach ($tasks as $task)
                    <tr>
                        <!-- Task Name -->
                        <td><a href="<?php echo env('app_url'); ?>/edit/task/{{$task->id}}">{{ $task->description }}</a>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <form action="{{ url('task/'.$task->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button style="margin-left: 3.5rem" type="submit" id="delete-task-{{ $task->id }}"
                                    class="btn btn-danger">
                                    <i style="color: #FF0000" class="fa fa-btn fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    @endsection
</body>

</html>