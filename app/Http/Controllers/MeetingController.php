<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Meeting;
use App\Plan;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Customer::find($request->id);
        $meeting = New Meeting();
        $meeting->customer_id = $customer->id;
        $meeting->save();
        $task = new Task();
        $task->title = $customer->name ? $customer->company : 'Empty';
        $task->deadline_date = $customer->task->deadline_date;
        $task->user_id = auth()->check() ? auth()->id() : 0;
        $task->save();
        $meeting->task()->save($task);

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $task,
                'view' => view('tasks.meetings-card', [
                    'meeting' => $task,
                ])->render(),
            ], 200);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $meeting = Meeting::find($request->id);
        $task = $meeting->task;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru');
        $request->request->remove('date');
        $request->merge(['date' => $deadline_date]);
        $task->deadline_date = $request->date;
        $task->save();
        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $task
            ]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $meet = Meeting::find($request->id);
        $task = $meet->task;

        $meet->delete();
        $task->delete();

        if ($request->ajax()){
            return response()->json([
                'status' => "success"
            ]);
        }

        return back();
    }

    public function done(Request $request)
    {

        $meet = Meeting::find($request->id);
        $task = $meet->task;
        $task->status_id = 1;
        $task->save();
        $today = Carbon::now()->setTime('00', '00');
        $plan = Plan::where('created_at', '>=', $today)->where('user_id',auth()->id())->where('status',null)->first();
        $plan->meets_score = $plan->meets_score + 1;
        $plan->save();
        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $plan
            ]);
        }

        return back();
    }
}
