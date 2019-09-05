<?php

namespace App\Http\Controllers;

use App\Call;
use App\Cron\DeleteCalls;
use App\Customer;
use App\Plan;
use App\Report;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class CallController extends Controller
{
    //

    public function call_to_customer(Request $request)
    {
        $call = Call::find($request->id);
        $customer = New Customer();
        $customer->name = $call->name;
        $customer->contacts = $call->phone;
        $customer->company = $call->company;
        $customer->save();
        $task = new Task();
        $task->title = $customer->name ? $customer->company : 'Empty';
        $task->deadline_date = Carbon::now()->addWeek()->format('Y-m-d H:i:s');
        $task->user_id = auth()->check() ? auth()->id() : 0;
        $task->save();
        $customer->task()->save($task);


        $report = new Report([
            'user_id' => auth()->id(),
            'type' => 'call',
            'status' => true,
            'data' => $call,
            'plan' => $plan
        ]);
        $report->save();
        $call->delete();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $task,
                'view' => view('tasks.potentials-card', [
                    'customer' => $task,
                ])->render(),
            ], 200);
        }

        return back();
    }

    public function cronDelete()
    {
        DeleteCalls::delete();
        return 0;
    }

    public function delete(Request $request)
    {
        $call = Call::find($request->id);
        $call->delete();
        $today = Carbon::now()->setTime('00', '00');
        $plan = Plan::where('created_at', '>=', $today)->where('user_id',auth()->id())->where('status',null)->first();
        $plan->calls_score = $plan->calls_score + 1;
        $plan->save();
        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $plan
            ]);
        }

        return back();
    }

    public function add_1_call(Request $request)
    {
        $call = new Call();
        $call->company = $request->company;
        $call->phone = $request->phone;
        $call->user_id = auth()->check() ? auth()->id() : 0;
        $call->save();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $call,
                'view' => view('tasks.calls-card', [
                    'call' => $call,
                ])->render(),
            ], 200);
        }
    }
}
