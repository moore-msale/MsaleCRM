<?php

namespace App\Http\Controllers;

use App\Call;
use App\Customer;
use App\Plan;
use App\Report;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::id() == 1)
        {
            $customers = Task::where('taskable_type','App\Customer')->get();
        }
        else
        {
        $customers = Task::where('user_id',auth()->id())->hasMorph(
                'taskable',
                'App\Customer'
            )->get();
        }

        return view('pages.customer',['customers' => $customers]);
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
        if(Carbon::now() < $endday) {
            if(isset($request->id)){
                $call = Call::find($request->id);

                $plan = Plan::where('created_at', '>=', $today)->where('user_id',auth()->id())->first();
                $plan->calls_score = $plan->calls_score + 1;
                $plan->save();

                $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
                if (!isset($report->data['calls'])) {
                    $item = collect($call);
                    $item = $item->push(Carbon::now()->format('H:i:s'));
                    $item = $item->push($task);
                    $tts = collect(['calls' => new Collection()]);
                    $result = $tts['calls']->push($item);
                    $tts = collect($result);
                    if (isset($report->data)) {
                        $report->data = $report->data->merge(collect(['calls' => $tts]));
                    } else {
                        $report->data = collect(['calls' => $tts]);
                    }
                } else {
                    $tts = collect(['calls' => collect($report->data['calls'])]);
                    $result = $tts['calls']->push($call);
                    $tts = collect($result);
                    if (isset($report->data)) {
                        $report->data = $report->data->merge(collect(['calls' => $tts]));
                    } else {
                        $report->data = collect(['calls' => $tts]);
                    }
                }
                if (!isset($report->data['custom_store'])) {
                    $item = collect($customer);
                    $item = $item->push(Carbon::now()->format('H:i:s'));
                    $item = $item->push($task);
                    $tts = collect(['custom_store' => new Collection()]);
                    $result = $tts['custom_store']->push($item);
                    $tts = collect($result);
                    if (isset($report->data)) {
                        $report->data = $report->data->merge(collect(['custom_store' => $tts]));
                    } else {
                        $report->data = collect(['custom_store' => $tts]);
                    }
                } else {
                    $item = collect($customer);
                    $item = $item->push(Carbon::now()->format('H:i:s'));
                    $item = $item->push($task);
                    $tts = collect(['custom_store' => collect($report->data['custom_store'])]);
                    $result = $tts['custom_store']->push($item);
                    $tts = collect($result);
                    if (isset($report->data)) {
                        $report->data = $report->data->merge(collect(['custom_store' => $tts]));
                    } else {
                        $report->data = collect(['custom_store' => $tts]);
                    }
                }
                $report->save();

                $call->delete();
            }
            else {
                $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
                if (!isset($report->data['custom_store'])) {
                    $item = collect($customer);
                    $item = $item->push(Carbon::now()->format('H:i:s'));
                    $item = $item->push($task);
                    $tts = collect(['custom_store' => new Collection()]);
                    $result = $tts['custom_store']->push($item);
                    $tts = collect($result);
                    if (isset($report->data)) {
                        $report->data = $report->data->merge(collect(['custom_store' => $tts]));
                    } else {
                        $report->data = collect(['custom_store' => $tts]);
                    }
                } else {
                    $item = collect($customer);
                    $item = $item->push(Carbon::now()->format('H:i:s'));
                    $item = $item->push($task);
                    $tts = collect(['custom_store' => collect($report->data['custom_store'])]);
                    $result = $tts['custom_store']->push($item);
                    $tts = collect($result);
                    if (isset($report->data)) {
                        $report->data = $report->data->merge(collect(['custom_store' => $tts]));
                    } else {
                        $report->data = collect(['custom_store' => $tts]);
                    }
                }
                $report->save();
            }
        }
        if(isset($request->id) && Carbon::now() < $endday)
        {
            if ($request->ajax()){
                return response()->json([
                    'status' => "success",
                    'data' => $task,
                    'plan' => $plan,
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
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');

        $customer = Customer::find($request->id);
        $task = $customer->task;
        $task->title = $request->name;
        $customer->name = $request->name;
        $customer->company = $request->company;
        $customer->contacts = $request->phone;
        $customer->socials = $request->social;
        $customer->save();
        $task->save();
        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['custom_update'])) {
                $item = collect($customer);
                $item = $item->push($request->details);
                $tts = collect(['custom_update' => new Collection()]);
                $task = $item->push(Carbon::now()->format('H:i:s'));
                $result = $tts['custom_update']->push($task);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['custom_update' => $tts]));
                } else {
                    $report->data = collect(['custom_update' => $tts]);
                }
            } else {
                $item = collect($customer);
                $item = $item->push($request->details);
                $tts = collect(['custom_update' => collect($report->data['custom_update'])]);
                $task = $item->push(Carbon::now()->format('H:i:s'));
                $result = $tts['custom_update']->push($task);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['custom_update' => $tts]));
                } else {
                    $report->data = collect(['custom_update' => $tts]);
                }
            }
            $report->save();
        }
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
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');
        $customer = Customer::find($request->id);
        $task = $customer->task;
        $task->status_id = 0;
        $task->save();
        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['custom_delete'])) {
                $item = collect($customer);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
//                $item = $item->push($task);
                $tts = collect(['custom_delete' => new Collection()]);
                $result = $tts['custom_delete']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['custom_delete' => $tts]));
                } else {
                    $report->data = collect(['custom_delete' => $tts]);
                }
            } else {
                $item = collect($customer);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
//                $item = $item->push($task);
                $tts = collect(['custom_delete' => collect($report->data['custom_delete'])]);;
                $result = $tts['custom_delete']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['custom_delete' => $tts]));
                } else {
                    $report->data = collect(['custom_delete' => $tts]);
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

    public function destroy(Customer $customer)
    {
        //
    }

    public function change(Request $request)
    {
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');
        $customer = Customer::find($request->id);
        $task = $customer->task;
        $task->description = $request->desc;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru');
        $request->request->remove('date');
        $request->merge(['date' => $deadline_date]);
        $task->deadline_date = $request->date;
        $task->status_id = 1;
        $task->save();
        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['custom_potencial'])) {
                $item = collect($customer);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($task);
                $tts = collect(['custom_potencial' => new Collection()]);
                $result = $tts['custom_potencial']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['custom_potencial' => $tts]));
                } else {
                    $report->data = collect(['custom_potencial' => $tts]);
                }
            } else { $item = collect($customer);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($task);
                $tts = collect(['custom_potencial' => collect($report->data['custom_potencial'])]);
                $result = $tts['custom_potencial']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['custom_potencial' => $tts]));
                } else {
                    $report->data = collect(['custom_potencial' => $tts]);
                }
            }
            $report->save();
        }
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
