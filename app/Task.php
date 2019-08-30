<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function taskable()
    {
        return $this->morphTo();
    }
    
    protected $fillable = ['name','description','deadline_date'];
}
