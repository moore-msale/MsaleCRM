<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function taskable()
    {
        return $this->morphTo();
    }

    protected $fillable = ['title','description','deadline_date','user_id'];
}
