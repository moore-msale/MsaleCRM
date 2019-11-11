<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function done_task(Request $request)
    {
        $task = Task::find($request->id);

        $task->status_id = 1;
        $task->save();
        $view = view('pages.Tasks.includes.done_task_admin', [
            'task' => $task,
        ])->render();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $task,
                'view' => $view,
            ]);
        }
    }


    public function delete_task(Request $request)
    {

        $delete = Task::find($request->id);
        $task = $delete;
        $delete->delete();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $task,
            ]);
        }

        return back();
    }

    public function edit_task(Request $request)
    {
        $task = Task::find($request->id);
        $task->title = $request->title;
        $task->description = $request->desc;
        $task->user_id = $request->manage;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru');
        $request->request->remove('date');
        $request->merge(['date' => $deadline_date]);
//        dd($request->date);
        $task->deadline_date = $request->date;
        $task->save();
        $user = User::find($task->user_id)->name;
        if($task->status_id == 0)
        {
            $view = view('pages.Tasks.includes.task_admin', [
            'task' => $task,
        ])->render();
        }
        elseif ($task->status_id == 1)
        {
            $view = view('pages.Tasks.includes.done_task_admin', [
                'task' => $task,
            ])->render();
        }
        elseif ($task->status_id == 2)
        {
            $view = view('pages.Tasks.includes.fail_task_admin', [
                'task' => $task,
            ])->render();
        }
        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $task,
                'view' => $view,
                'user' => $user,
            ]);
        }

        return back();
    }


    public function done_meet(Request $request)
    {
        $task = Task::find($request->id);

        $task->status_id = 1;

        $task->save();
        $view = view('pages.Meets.includes.done_meet_admin', [
            'task' => $task,
        ])->render();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $task,
                'view' => $view,
            ]);
        }
    }


    public function delete_meet(Request $request)
    {

        $delete = Task::find($request->id);
        $task = $delete;
        $delete->delete();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $task,
            ]);
        }

        return back();
    }

    public function edit_meet(Request $request)
    {
        $task = Task::find($request->id);
        $task->description = $request->desc;
        $task->user_id = $request->manage;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru');
        $request->request->remove('date');
        $request->merge(['date' => $deadline_date]);
//        dd($request->date);
        $task->deadline_date = $request->date;
        $task->save();
        $user = User::find($task->user_id)->name;
        if($task->status_id == 0)
        {
            $view = view('pages.Meets.includes.meet_admin', [
                'task' => $task,
            ])->render();
        }
        elseif ($task->status_id == 1)
        {
            $view = view('pages.Meets.includes.done_meet_admin', [
                'task' => $task,
            ])->render();
        }
        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $task,
                'view' => $view,
                'user' => $user,
            ]);
        }

        return back();
    }
}
