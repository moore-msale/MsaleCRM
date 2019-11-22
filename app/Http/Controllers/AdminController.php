<?php

namespace App\Http\Controllers;

use App\Customer;
use App\History;
use App\Meeting;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('changeDB');
    }

    public function create_task(Request $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $deadline_date = Carbon::parseFromLocale($request->deadline_date, 'ru');
        $request->request->remove('deadline_date');
        $request->merge(['deadline_date' => $deadline_date]);
        $task->user_id = $request->user_id;
        $task->status_id = $request->status;
        $task->save();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $task,
            ]);
        }
    }
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

    public function create_meet(Request $request)
    {
        $task = Task::find($request->customer_id);
        $customer = Customer::find($task->taskable->id);
        $meeting = New Meeting();
        $meeting->customer_id = $customer->id;
        $meeting->save();
        $task = new Task();
        $task->title = $customer->company;

        $deadline_date = Carbon::parseFromLocale($request->deadline_date, 'ru');
        $request->request->remove('deadline_date');
        $request->merge(['deadline_date' => $deadline_date]);
        $task->deadline_date = $request->deadline_date;
        $task->description = $request->description;
        $task->user_id = $request->user_id;
        $task->save();
        $meeting->task()->save($task);

        $history = new History();
        $history->description = $task->description;
        $history->user_id = Auth::id();
        $history->customer_id = $customer->id;
        $history->action = "Встреча";
        $history->date = Carbon::now();
        $history->status = $customer->task->status->name;
        $history->save();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
            ]);
        }
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

    public function create_customer(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->title;
        $customer->company = $request->company;
        $customer->contacts = $request->contacts;
        $customer->socials = $request->socials;
        $customer->save();

        $task = new Task();
        $task->title = $customer->name ? $customer->company : 'Empty';
        $task->user_id = $request->user_id;
        $task->description = $request->description;
        $task->status_id = $request->status;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru');
        $request->request->remove('date');
        $request->merge(['date' => $deadline_date]);
        $task->deadline_date = $request->date;
        $task->save();
        $customer->task()->save($task);


        $history = new History();
        $history->description = $task->description;
        $history->action = "Создание";
        $history->date = Carbon::now();
        if($task->status_id == 0)
        {
            $history->status = "В работе";
        }
        else
        {
            $history->status = $task->status->name;
        }
        $history->user_id = $task->user_id;
        $history->customer_id = $customer->id;
        $history->save();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
            ]);
        }
    }


    public function delete_customer(Request $request)
    {
        $task = Task::find($request->id);
        $customer = $task->taskable;

        $histories = History::where('customer_id', $customer->id)->get();

        foreach ($histories as $history)
        {
            $history->delete();
        }

        $task->delete();
        $customer->delete();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
            ]);
        }
    }


    public function edit_customer(Request $request)
    {
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');

        $task = Task::find($request->id);
        $customer = $task->taskable;
        $task->title = $request->name;
        $customer->name = $request->name;
        $customer->company = $request->company;
        $customer->contacts = $request->contacts;
        $customer->socials = $request->socials;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru');
        $request->request->remove('date');
        $request->merge(['date' => $deadline_date]);
        $task->deadline_date = $request->date;
        $task->description = $request->desc;
        $task->user_id = $request->manager;
        $task->status_id = $request->status;
        $customer->save();
        $task->save();

        $history = new History();
        $history->description = $task->description;
        $history->user_id = Auth::id();
        $history->action = 'Изменение';
        if(isset($task->status->name))
        {
            $history->status = $task->status->name;
        }
        else
        {
            $history->status = 'В работе';
        }
        $history->customer_id = $customer->id;
        $history->date = Carbon::now();
        $history->save();
        $date = Carbon::parse($task->deadline_date)->format('M d - H:i');
//        $html = view('history.includes.history')->render();
//        dd($html);
        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'customer' => $customer,
                'html' => view('history.includes.history', ['customer' => $task])->render(),
                'user' => User::find($task->user_id)->name,
                'task' => $task,
                'date' => $date,
            ]);
        }

    }
}
