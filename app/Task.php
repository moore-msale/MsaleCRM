<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function taskable()
    {
        return $this->morphTo();
    }
}
