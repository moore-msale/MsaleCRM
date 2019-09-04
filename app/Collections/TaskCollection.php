<?php


namespace App\Collections;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class TaskCollection extends Collection
{
    public function between()
    {
        $now = Carbon::now()->setTime('00', '00');
        $week = Carbon::now()->addWeek()->setTime('23', '59', '59');

        return $this->where('deadline_date', '>=', $now)->where('deadline_date', '<=', $week);

    }
}
