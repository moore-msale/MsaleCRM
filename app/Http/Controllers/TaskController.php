<?php

namespace App\Http\Controllers;

use App\Report;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        
        $deadline_date = Carbon::parseFromLocale($request->deadline_date, 'ru');
        $request->request->remove('deadline_date');
        $request->merge(['deadline_date' => $deadline_date]);
        $task = Task::create($request->all());

        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['task_store'])) {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $tts = collect(['task_store' => new Collection()]);
                $result = $tts['task_store']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['task_store' => $tts]));
                } else {
                    $report->data = collect(['task_store' => $tts]);
                }
            } else {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $tts = collect(['task_store' => collect($report->data['task_store'])]);
                $result = $tts['task_store']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['task_store' => $tts]));
                } else {
                    $report->data = collect(['task_store' => $tts]);
                }
            }
            $report->save();
        }
        
        
        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $task,
                'inWeek' => $task->between(),
                'view' => view('tasks.tasks-card', [
                    'task' => $task,
                ])->render(),

            ], 200);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');


        $task = Task::find($request->id);
        $task->title = $request->title;
        $task->description = $request->desc;
        $task->deadline_date = $request->date;
        $task->save();

        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['task_update'])) {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
                $tts = collect(['task_update' => new Collection()]);
                $result = $tts['task_update']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['task_update' => $tts]));
                } else {
                    $report->data = collect(['task_update' => $tts]);
                }
            } else {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
                $tts = collect(['task_update' => collect($report->data['task_update'])]);
                $result = $tts['task_update']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['task_update' => $tts]));
                } else {
                    $report->data = collect(['task_update' => $tts]);
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

        $task = Task::find($request->id);
        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['task_delete'])) {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
                $tts = collect(['task_delete' => new Collection()]);
                $result = $tts['task_delete']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['task_delete' => $tts]));
                } else {
                    $report->data = collect(['task_delete' => $tts]);
                }
            } else {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
                $tts = collect(['task_delete' => collect($report->data['task_delete'])]);
                $result = $tts['task_delete']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['task_delete' => $tts]));
                } else {
                    $report->data = collect(['task_delete' => $tts]);
                }
            }
            $report->save();
        }

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
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');

        $task = Task::find($request->id);
        $task->status_id = 1;
        $task->save();

        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['task_done'])) {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
                $tts = collect(['task_done' => new Collection()]);
                $result = $tts['task_done']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['task_done' => $tts]));
                } else {
                    $report->data = collect(['task_done' => $tts]);
                }
            } else {
                $item = collect($task);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
                $tts = collect(['task_done' => collect($report->data['task_done'])]);
                $result = $tts['task_done']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['task_done' => $tts]));
                } else {
                    $report->data = collect(['task_done' => $tts]);
                }
            }
            $report->save();
        }


        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'view' => view('pages.Tasks.includes.done_task', [
                    'task' => $task,
                ])->render(),
            ]);
        }

        return back();
    }


}
