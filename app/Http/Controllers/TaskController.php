<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskImage;
use App\Http\Requests\StoreTaskRequest;
use Auth;


class TaskController extends Controller
{

    //tasks listing
    public function listTasks()
    {
        $task = new Task();
        $task = $task->get();
        $title = "To Do App";
        return view('to_do_list', ['tasks' => $task, 'title'=>$title]);
    }

    //create task
    public function createTask()
    {
        $task = new Task();
        $task = $task->get();
        $title = "Add Task";
        return view('create_task', ['tasks' => $task, 'title'=>$title]);
    }



    //Store or udpate the task
    public function storeTask(StoreTaskRequest $request)
    {dd(request()->all());
        $request->validate([
            //  'title' => 'required',
            //  'description' => 'required',
            'task_image' => 'required|max:0.7M',
        ]);
dd(9);
        $task = new Task();
        $taskImage = new TaskImage();
        $id = $request->id;
        $taskImages = $request->task_image;
        
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
       
        if($request->hasFile('task_image')){
            foreach($taskImages as $images => $image){
            $taskImageHashName = $image->hashName();
            $taskImageSize =  $image->getSize();
            $destinationPath = 'task_images';
            $image->move($destinationPath, $taskImageHashName);

            $taskImage->updateOrCreate(
            [
                'id' => $id,
            ],
            [
                'task_id' =>  $task->id,
                'image_original_name' => $image->getClientOriginalName(),
                'image_hash_name' => $taskImageHashName,
                'extention' => $image->getClientOriginalExtension(),
                'image_size' => number_format( $taskImageSize / 1048576, 2) . ' MB',
                'created_by' => Auth::user()->id,
            ]);
            }
        }
       
        return redirect()->back()->with('message', 'Task Submitted Successfully');
    }

    //Edit task
    public function editTask($id)
    {
        $task = Task::find($id);
          $title = "Edit Task";
        return view('edit_task', ['task' => $task,'title'=>$title]);
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