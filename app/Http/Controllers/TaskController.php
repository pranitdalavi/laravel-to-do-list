<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Auth;


class TaskController extends Controller
{

    //tasks listing
    public function listTasks()
    {
        $task = new Task();
        $task = $task->get();
        return view('to_do_list', ['tasks' => $task]);
    }



    //Store or udpate the task
    public function storeTask(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $task = new Task();
        $id = $request->id;

        $task->updateOrCreate(
            [
                'id' => $id,
            ],
            [
                'description' => $request->description,
                'created_by' => Auth::user()->id,
            ]
        );
    
        return redirect('to-do-list');
    }

    //Edit task
    public function editTask($id)
    {
        $task = Task::find($id);
        return view('edit_task', ['task' => $task]);
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
}