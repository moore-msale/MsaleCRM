<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['user_id', 'data', 'type', 'status'];

    protected $casts = [
        'data' => 'collection',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
