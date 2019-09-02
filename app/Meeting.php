<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    public function task()
    {
        return $this->morphOne(Task::class, 'taskable');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
