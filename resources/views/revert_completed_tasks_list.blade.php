<html>

<head>


    <script src="https://kit.fontawesome.com/2b29b6dab6.js" crossorigin="anonymous"></script>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div>
        <!-- 
    <div style="text-align: center" class="panel-body">
        <form action="{{ route('store-task') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-sm-6" style="width:300px; margin-left:420px">
                    <input type=" text" name="description" id="task-name" class="form-control">
                </div>
                <div class="form">
                    <button type="submit" class="btnn">
                        <i class="fa fa-btn fa-plus"></i>
                    </button>
                </div>
            </div>
        </form>
    </div> -->
        <div>
            <h4 style="margin-left: 27rem">Completed Tasks</h4>
            <a href="/to-do-list" style="margin-left: 60rem; width: 4rem; margin-top: -2.3rem" class="btn btn-outline-primary btn-sm">Back</a>
        </div>
        <br>
        @if (count($tasks) > 0)
        <div style="text-align: center" class="panel panel-default">

            <div class="panel-body" style="margin-left: 1rem">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Mark as Incompleted</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="navn">
                        @foreach ($tasks as $task)
                        <tr>
                            <td><a href="<?php echo env('app_url'); ?>/edit/task/{{$task->id}}">{{ $task->title }}</a>
                            </td>
                            <td>{{ $task->description }}
                            </td>
                            <td>{{ $task->due_date }}
                            </td>
                            <td><input type="checkbox" style="margin-left: 3.5rem; margin-top: 0.5rem" onClick="Javascript:window.location.href = window.location.origin + '/update-revert-status/{{$task->id}}';" checked>
                            </td>
                            <td>
                                <form action="{{ url('task/'.$task->id) }}" onsubmit="alertDeleteTask()" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>
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

<script type="text/javascript">
    function alertDeleteTask() {
        alert("Are you sure you want to delete this task?");
    }
</script>