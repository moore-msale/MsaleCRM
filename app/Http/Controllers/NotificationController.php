<?php

namespace App\Http\Controllers;

use App\Mail\ManagerNotification;
use App\Mail\ManagerTaskNotification;
use App\Mail\PenaltyNotificationToChief;
use App\Mail\TaskPenaltyByChief;
use App\Task;
use App\User;
use Carbon\Carbon;
use function GuzzleHttp\Promise\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{

    public function notification()
    {
        $now = Carbon::now();
        $next = Carbon::now()->addHours(2);
        $tasks = Task::all();

        foreach ($tasks as $task)
        {
            if($task->deadline_date > $now && $task->deadline_date < $next)
            {
                if($task->status_id != 1 && $task->notification_status != 1){
                if(User::find($task->user_id)->role != 'admin')
                {
                if($task->taskable_type == 'App\Meeting')
                {
                    Mail::to(User::find($task->user_id)->email)->send(new ManagerNotification($task));
                    $task->notification_status = 1;
                }
                elseif ($task->taskable_type == null)
                {
                    Mail::to(User::find($task->user_id)->email)->send(new ManagerTaskNotification($task));
                    $task->notification_status = 1;
                }
                $task->save();
                }
                }
            }
            if($task->status_id != 1 && User::find($task->user_id)->role != 'admin' && $task->deadline_date < $now && $task->chief == 1)
            {
                $user = User::find($task->user_id);
                $user->balance = $user->balance - 200;
                $task->chief = 2;
                $user->save();
                $task->save();
                Mail::to($user->email)->send(new TaskPenaltyByChief($task));
                Mail::to('buvladi@gmail.com')->send(new PenaltyNotificationToChief($task));
            }
        }
    }
}
