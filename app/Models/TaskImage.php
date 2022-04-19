<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TaskImage extends Model
{
    use SoftDeletes;

    protected $fillable = ['id','task_id','image_original_name','image_hash_name','extention','image_size'];
}