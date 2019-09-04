<?php

namespace App\Http\Controllers;

use App\Call;
use App\Customer;
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
        $call = Call::find($request->id);
        $call->delete();
        $customer = New Customer();
        $customer->name = $request->name;
        $customer->company = $request->company;
        $customer->contacts = $request->phone;
        $customer->socials = $request->social;
        $customer->save();

        $task = new Task();
        $task->title = $customer->name ? $customer->company : 'Empty';
        $request->request->remove('date');
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru');
        $request->request->remove('date');
        $request->merge(['date' => $deadline_date]);
        $task->deadline_date = $request->date;
        $task->user_id = auth()->check() ? auth()->id() : 0;

        if($request->status == "true")
        {
            $task->status_id = 1;
        }
        else
        {
            $task->status_id = 0;
        }

        $task->save();
        $customer->task()->save($task);
        if ($request->ajax() && $task->status_id == 1){
            return response()->json([
                'status' => "success",
                'data' => $task,
                'view' => view('tasks.potentials-card', [
                    'customer' => $task,
                ])->render(),
            ], 200);
        }
        else {
            return response()->json([
                'status' => "success",
                'data' => $task
            ]);
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
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $task = Task::find($request->id);
        $customer = $task->taskable;
        $customer->delete();
        $customer->delete();

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
}
