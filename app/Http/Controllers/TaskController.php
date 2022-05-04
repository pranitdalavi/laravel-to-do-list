<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use Auth;


class TaskController extends Controller
{
    //tasks listing
    public function listTasks()
    {
        $task = new Task();
        $tasks = $task->whereNull('status')->get();
        $title = "To Do App";
        return view('to_do_list', ['tasks' => $tasks, 'title' => $title]);
    }

    //completed tasks listing
    public function showCompletedTasks()
    {
        $task = new Task();
        $tasks = $task->whereNotNull('status')->get();
        $title = "To Do App";
        return view('revert_completed_tasks_list', ['tasks' => $tasks, 'title' => $title]);
    }

    //create task
    public function createTask()
    {
        $task = new Task();
        $task = $task->get();
        $title = "Add Task";
        return view('create_task', ['tasks' => $task, 'title' => $title]);
    }



    //Store or udpate the task
    public function storeTask(StoreTaskRequest $request)
    {
        $task = new Task();
        $id = $request->id;

        $task = $task->updateOrCreate(
            [
                'id' => $id,
            ],
            [
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'created_by' => Auth::user()->id,
            ]
        );

        if ($request->id) {
            if (count($task->getMedia('task')) > 0) {
                foreach ($task->getMedia('task') as $media) {
                    if (!in_array($media->file_name, $request->input('task_images', []))) {
                        $media->delete();
                    }
                }
            }
            $media = $task->getMedia('task')->pluck('file_name')->toArray();
            $media = $task->getMedia('task')->toArray();

            foreach ($request->input('task_images', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $task->addMedia(public_path('task_images/' . $file))->toMediaCollection('task');
                }
            }
        } else {
            foreach ($request->input('task_images', []) as $file) {
                $task->addMedia(public_path('task_images/' . $file))->toMediaCollection('task');
            }
        }

        return redirect()->back()->with('message', 'Task Submitted Successfully');
    }

    //Edit task
    public function editTask($id)
    {
        $task = Task::find($id);
        $taskImages[] = $task->getMedia('task');

        $title = "Edit Task";
        return view('edit_task', ['task' => $task, 'title' => $title, 'taskImages' => $taskImages[0]]);
    }

    //Delete task
    public function destroy($id)
    {
        $task = Task::find($id);
        $taskDeleted = $task->delete();
        if ($taskDeleted) {
            return redirect('to-do-list');
        }
    }

    //Update task status as completed
    public function completedTask($id, Request $request)
    {
        $task = Task::find($id);

        $task->update([
            'status' => 1,
        ]);

        return redirect('to-do-list');
    }

    //Update task status as incompleted
    public function revertCompletedTask($id, Request $request)
    {
        $task = Task::find($id);

        $task->update([
            'status' => null,
        ]);

        return redirect('completed-tasks');
    }

    //Stores all the image files to specified path
    public function storeMedia(Request $request)
    {
        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $destinationPath = 'task_images';
        $file->move($destinationPath, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
