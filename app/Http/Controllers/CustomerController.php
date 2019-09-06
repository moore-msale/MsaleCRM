<?php

namespace App\Http\Controllers;

use App\Call;
use App\Customer;
use App\Plan;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Task::where('user_id',auth()->id())->hasMorph(
                'taskable',
                'App\Customer'
            )->get();

        return view('pages.customers',['customers' => $customers]);
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
        if(isset($request->id)){
        $call = Call::find($request->id);
        $call->delete();
            $today = Carbon::now()->setTime('00', '00');
            $plan = Plan::where('created_at', '>=', $today)->where('user_id',auth()->id())->where('status',null)->first();
            $plan->calls_score = $plan->calls_score + 1;
            $plan->save();
        }

        $customer = New Customer();
        $customer->name = $request->name;
        $customer->company = $request->company;
        $customer->contacts = $request->phone;
        $customer->socials = $request->social;

        $customer->save();

        $task = new Task();
        $task->title = $customer->name ? $customer->company : 'Empty';
        $task->user_id = auth()->check() ? auth()->id() : 0;
        $task->description = $request->desc;
        if (!(isset($request->id)))
        {
            if($request->status == "true")
            {
                $task->status_id = 1;
            }
        }
        $task->save();
        $customer->task()->save($task);
        if(isset($request->id))
        {
            if ($request->ajax()){
                return response()->json([
                    'status' => "success",
                    'data' => $task,
                    'plan' => $plan
                ], 200);
            }
        }
        else
        {
            if($task->status_id == 1)
            {
                if ($request->ajax()){
                    return response()->json([
                        'status' => "success",
                        'data' => $task,
                        'view' => view('tasks.potentials-card', [
                            'customer' => $task,
                        ])->render(),
                    ], 200);
                }
            }
            else
            {
                if ($request->ajax()){
                    return response()->json([
                        'status' => "success",
                        'data' => $task,
                    ], 200);
                }
            }

        }


        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $customer = Customer::find($request->id);
        $task = $customer->task;
        $task->title = $request->name;
        $customer->name = $request->name;
        $customer->company = $request->company;
        $customer->contacts = $request->phone;
        $customer->socials = $request->social;
        $customer->save();
        $task->save();
        if(isset($customer->meeting->id)) {
            $id = $customer->meeting->id;
        }
        else
        {
            $id = 0;
        }
        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $customer,
                'id' => $id,
            ]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $customer = Customer::find($request->id);
        $task = $customer->task;
        $task->status_id = 0;
        $task->save();

        if ($request->ajax()){
            return response()->json([
                'status' => "success"
            ]);
        }

        return back();
    }

    public function destroy(Customer $customer)
    {
        //
    }

    public function change(Request $request)
    {
        $customer = Customer::find($request->id);
        $task = $customer->task;
        $task->description = $request->desc;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru');
        $request->request->remove('date');
        $request->merge(['date' => $deadline_date]);
        $task->deadline_date = $request->date;
        $task->status_id = 1;
        $task->save();

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
}
