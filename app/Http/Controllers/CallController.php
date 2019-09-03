<?php

namespace App\Http\Controllers;

use App\Call;
use App\Customer;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CallController extends Controller
{
    //

    public function call_to_customer(Request $request)
    {
        $call = Call::find($request->id);
        $customer = New Customer();
        $customer->name = $call->title;
        $customer->contacts = $call->phone;
        $customer->company = $call->company;
        $customer->save();
        $task = new Task();
        $task->title = $customer->name ? $customer->company : 'Empty';
        $task->deadline_date = Carbon::now()->addWeek()->format('Y-m-d H:i:s');
        $task->user_id = auth()->check() ? auth()->id() : 0;
        $task->save();
        $customer->task()->save($task);

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $customer,
                'view' => view('tasks.potentials-card', [
                    'customer' => $customer,
                ])->render(),
            ], 200);
        }

        return back();
    }
}
