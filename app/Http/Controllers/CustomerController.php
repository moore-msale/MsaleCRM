<?php

namespace App\Http\Controllers;

use App\Call;
use App\Customer;
use App\History;
use App\Plan;
use App\Report;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use function DeepCopy\deep_copy;

class   CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('changeDB');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'admin')
        {
            $customers = Task::where('taskable_type','App\Customer')->get()->reverse();
//            dd($customers->groupBy('user_id'));

            return view('pages.Customers.customer_page_admin',['customers' => $customers]);
        }
        else
        {
        $customers = Task::where('user_id',auth()->id())->hasMorph(
                'taskable',
                'App\Customer'
            )->get();
            return view('pages.Customers.customer',['customers' => $customers]);
        }
    }

    public function filter(Request $request)
    {
//        dd($request->all());
        if($request->status != null && $request->manager != null)
        {
            $customers = Task::where('taskable_type', 'App\Customer')->where('user_id',$request->manager)->where('status_id',$request->status)->get()->reverse();
        }
        elseif($request->status != null)
        {
            $customers = Task::where('taskable_type', 'App\Customer')->where('status_id',$request->status)->get()->reverse();
        }
        elseif($request->manager != null)
        {
            $customers = Task::where('taskable_type', 'App\Customer')->where('user_id',$request->manager)->get()->reverse();
        }elseif(auth()->user()->role=='admin'){
            $customers = Task::where('taskable_type','App\Customer')->get()->reverse();
        }
        else
        {
            $customers = Task::where('taskable_type','App\Customer')->where('user_id',auth()->id())->get()->reverse();
        }
        if(auth()->user()->role=='admin'){
            return view('pages.Customers.customer_page_admin', ['customers' => $customers, 'manager' => $request->manager, 'status' => $request->status]);
        }
        return view('pages.Customers.customer_page', ['customers' => $customers, 'manager' => $request->manager, 'status' => $request->status]);
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
                    'view'=>view('tasks.potentials-card', [
                        'customer' => $task,
                    ])->render(),
                    'view2' => view('pages.Customers.includes.customer_admin', [
                        'customer' => $task,
                    ])->render(),
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
                        'view2' => view('pages.Customers.includes.customer_admin', [
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
                        'view' => view('tasks.potentials-card', [
                            'customer' => $task,
                        ])->render(),
                        'view2' => view('pages.Customers.includes.customer_admin', [
                            'customer' => $task,
                        ])->render(),
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
//        dd($request->all());
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');
        $task = Task::find($request->id);
        $customer =  $task->taskable;
        $task2 = deep_copy($task);
        $customer2 = deep_copy($customer);
        $task->title = $request->name;
        $customer->name = $request->name;
        $customer->company = $request->company;
        $customer->contacts = $request->phone;
        $customer->socials = $request->social;
        $deadline_date = Carbon::parseFromLocale($request->date, 'ru');
        $request->request->remove('date');
        $request->merge(['date' => $deadline_date]);
        $task->deadline_date = $request->date;
        $task->status_id =  $request->status;
        if (isset($request->desc))
        {
            $task->description = $request->desc;
        }
        if($task==$task2 and $customer==$customer2){
            return response()->json([
                'status' => "error",
                'task2'=>$task2,
                'task'=>$task,
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

        $customer->save();
        $task->save();
        if(isset($request->details)){
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
                'customer' => $customer,
                'task' => $task,
                'id' => $id,
                'html' => view('history.includes.history', ['customer' => $task])->render(),
                'deadline_date'=>Carbon::parse($deadline_date)->format('M d - H:i'),
                'status_id'=>$task->status,
                'date1'=>Carbon::parse($deadline_date)->format('d M'),
                'date2'=>Carbon::parse($deadline_date)->format('H:i'),
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
        $task->status_id = 5;
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

    public function done(Request $request)
    {
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');
        $customer = Customer::find($request->id);
        $task = $customer->task;
        $task->status_id = 2;
        $task->save();
        if(Carbon::now() < $endday) {
            $report = Report::where('created_at', '>=', $today)->where('user_id', \auth()->id())->first();
            if (!isset($report->data['custom_done'])) {
                $item = collect($customer);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
//                $item = $item->push($task);
                $tts = collect(['custom_done' => new Collection()]);
                $result = $tts['custom_done']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['custom_done' => $tts]));
                } else {
                    $report->data = collect(['custom_done' => $tts]);
                }
            } else {
                $item = collect($customer);
                $item = $item->push(Carbon::now()->format('H:i:s'));
                $item = $item->push($request->details);
//                $item = $item->push($task);
                $tts = collect(['custom_done' => collect($report->data['custom_done'])]);;
                $result = $tts['custom_done']->push($item);
                $tts = collect($result);
                if (isset($report->data)) {
                    $report->data = $report->data->merge(collect(['custom_done' => $tts]));
                } else {
                    $report->data = collect(['custom_done' => $tts]);
                }
            }
            $report->save();
        }

        if ($request->ajax()){
            return response()->json([
                'status' => "success"
            ]);
        }
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

        $history = new History();
        $history->description = $task->description;
        $history->action = "Изменение";
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
                'something' =>"something",
            ], 200);
        }

        return back();
    }
}
