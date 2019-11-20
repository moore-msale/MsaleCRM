<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    public function task()
    {
        return $this->morphOne(Task::class, 'taskable');
    }

    public function meeting()
    {
        return $this->hasOne(Meeting::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

}
