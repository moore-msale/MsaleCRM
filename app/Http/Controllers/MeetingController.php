<?php

namespace App\Http\Controllers;

use App\Customer;
use App\History;
use App\Meeting;
use App\Plan;
use App\Report;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('changeDB');
    } 
    public function index()
    {
        //
    }
     public function filter(Request $request)
    {
//        dd($request->all());

        if($request->status != null && $request->manager != null)
        {
            $tasks = Task::where('taskable_type', 'App\Meeting')->where('user_id',$request->manager)->where('status_id',$request->status)->get()->reverse();
        }
        elseif($request->status != null)
        {
            $tasks = Task::where('taskable_type', 'App\Meeting')->where('status_id',$request->status)->get()->reverse();
        }
        elseif($request->manager != null)
        {
            $tasks = Task::where('taskable_type', 'App\Meeting')->where('user_id',$request->manager)->get()->reverse();
        }
        else
        {
            $tasks = Task::where('taskable_type','App\Meeting')->get()->reverse();
        }

        return view('pages.Meets.meet_page_admin', ['tasks' => $tasks, 'manager' => $request->manager, 'status' => $request->status]);
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
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');
        
        
        $customer = Customer::find($request->id);
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

        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['meet_store'])) {$item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($task);
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $tts = collect(['meet_store' => new Collection()]);
                $result = $tts['meet_store']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['meet_store' => $tts]));
                } else {
                    $report->data = collect(['meet_store' => $tts]);
                }
            } else {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $tts = collect(['meet_store' => collect($report->data['meet_store'])]);
                $result = $tts['meet_store']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['meet_store' => $tts]));
                } else {
                    $report->data = collect(['meet_store' => $tts]);
                }
            }
            $report->save();
        }

        $history = new History();
        $history->description = $task->description;
        $history->action = 'Встреча';
        $history->date = $request->deadline_date;
        if(isset($task->status->name))
        {
            $history->status = $task->status->name;
        }
        else
        {
            $history->status = 'В работе';
        }
        $history->user_id = $task->user_id;
        $history->customer_id = $customer->id;
        $history->save();
        
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
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');

        $meeting = Meeting::find($request->id);
        $task = $meeting->task;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru');
        $request->request->remove('date');
        $request->merge(['date' => $deadline_date]);
        $task->deadline_date = $request->date;
        $task->save();
        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['meet_update'])) {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($task);
                $item = $item->push($request->details);
                $tts = collect(['meet_update' => new Collection()]);
                $result = $tts['meet_update']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['meet_update' => $tts]));
                } else {
                    $report->data = collect(['meet_update' => $tts]);
                }
            } else {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($task);
                $item = $item->push($request->details);
                $tts = collect(['meet_update' => collect($report->data['meet_update'])]);
                $result = $tts['meet_update']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['meet_update' => $tts]));
                } else {
                    $report->data = collect(['meet_update' => $tts]);
                }
            }
            $report->save();
        }
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
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');

        $meet = Meeting::find($request->id);
        $task = $meet->task;

        $meet->delete();
        $task->delete();

        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['meet_delete'])) {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
                $tts = collect(['meet_delete' => new Collection()]);
                $result = $tts['meet_delete']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['meet_delete' => $tts]));
                } else {
                    $report->data = collect(['meet_delete' => $tts]);
                }
            } else {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
                $tts = collect(['meet_delete' => collect($report->data['meet_delete'])]);
                $result = $tts['meet_delete']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['meet_delete' => $tts]));
                } else {
                    $report->data = collect(['meet_delete' => $tts]);
                }
            }
            $report->save();
        }

        if ($request->ajax()){
            return response()->json([
                'status' => "success"
            ]);
        }

        return back();
    }

    public function done(Request $request)
    {
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');



        $meet = Meeting::find($request->id);
        $task = $meet->task;
        $task->status_id = 1;
        $task->save();

        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['meet_done'])) {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($task);
                $item = $item->push($request->details);
                $tts = collect(['meet_done' => new Collection()]);
                $result = $tts['meet_done']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['meet_done' => $tts]));
                } else {
                    $report->data = collect(['meet_done' => $tts]);
                }
            } else {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($task);
                $item = $item->push($request->details);
                $tts = collect(['meet_done' => collect($report->data['meet_done'])]);
                $result = $tts['meet_done']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['meet_done' => $tts]));
                } else {
                    $report->data = collect(['meet_done' => $tts]);
                }
            }
            $report->save();
        }


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
