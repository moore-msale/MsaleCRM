<?php

namespace App\Http\Controllers;

use App\History;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function DeepCopy\deep_copy;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('changeDB');
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
        $task->status_id = $request->status;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru')->format('Y-m-d H:i:s');
        $task->deadline_date = $deadline_date;
        $task->save();
        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'task' => $task,
                'user' => User::find($task->user_id)->name,
                'deadline_date'=>Carbon::parse($deadline_date)->format('M d - H:i'),
                'status'=>$task->status,
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
        $task2 = deep_copy($task);
        $task->title = $request->title;
        $task->description = $request->desc;
        $task->user_id = $request->manage;
        $task->status_id = $request->status;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru')->format('Y-m-d H:i:s');
        $task->deadline_date = $deadline_date;
        if($task==$task2){
            return response()->json([
                'status' => "error",
                'task2'=>$task2,
                'task'=>$task,
            ]);
        }
        $task->save();
        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'meet' => $task,
                'user' => User::find($task->user_id)->name,
                'deadline_date'=>Carbon::parse($deadline_date)->format('M d - H:i'),
                'status'=>$task->status,
            ]);
        }

        return back();
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
        $task2 = deep_copy($task);
        $customer2 = deep_copy($customer);
        $task->title = $request->name;
        $customer->name = $request->name;
        $customer->company = $request->company;
        $customer->contacts = $request->contacts;
        $customer->socials = $request->socials;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru')->format('Y-m-d H:i:s');
        $task->deadline_date = $deadline_date;
        $task->description = $request->desc;
        $task->user_id = $request->manager;
        $task->status_id = $request->status;
        $contacts = $request->contacts;
        $socials = $request->soocials;
        $customer->save();
        $task->save();
        if($customer==$customer2 and  $task==$task2){
            return response()->json([
                'status' => "error",
                'task'=>$task,
                'task2'=>$task2,
                'customer'=> $contacts,
                'customer2'=>$socials,
            ]);
        }
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

//        $html = view('history.includes.history')->render();
//        dd($html);
        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'html' => view('history.includes.history', ['customer' => $task])->render(),
                'user' => User::find($task->user_id)->name,
                'task' => $task,
                'customer' => $customer,
            ]);
        }

    }
}
