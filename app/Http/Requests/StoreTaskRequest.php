<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 
        $rules =  [
             'title' => 'required',
             'description' => 'required',
             'task_image' => request()->id ? 'max:2M' : 'required|max:2M',
        ];
    
        return $rules;
    }

    public function messages()
    {
    return [
        'title.required' => 'Title is required',
        'description.required' => 'Description is required',
        'task_image.required' => 'Task image is required',
        'task_image.max' => 'Task image file size should be less than 2 MB',
    ];
    }

}