<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'id_user','task_name','priority', 'date', 'hour','description','status',
    ];
}
