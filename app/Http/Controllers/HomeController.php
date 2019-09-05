<?php

namespace App\Http\Controllers;

use App\Call;
use App\Customer;
use App\Meeting;
use App\Plan;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');
        $plan = Plan::where('created_at', '>=', $today)->where('user_id',auth()->id())->first();
            if($plan == null)
            {
                $plan = New Plan();
                $plan->calls_goal = 100;
                $plan->calls_score = 0;
                $plan->meets_goal = 3;
                $plan->meets_score = 0;
                $plan->user_id = auth()->id();
                $plan->save();
            }
            if($plan->calls_score >= 100 && $plan->meets_score >= 0 && $plan->status != 1)
            {
                $plan->status = 1;
                $plan->save();
            }
            elseif($plan->calls_score >= 66 && $plan->meets_score >= 1 && $plan->status != 1)
            {
                $plan->status = 1;
                $plan->save();
            }
            elseif($plan->calls_score >= 33 && $plan->meets_score >= 2 && $plan->status != 1)
            {
                $plan->status = 1;
                $plan->save();
            }
            elseif($plan->calls_score >= 0 && $plan->meets_score >= 3 && $plan->status != 1)
            {
                $plan->status = 1;
                $plan->save();
            }
            elseif($endday <= Carbon::now() && $plan->status != 1)
            {
                $plan->status = 2;
                $plan->save();
            }
        $week = Carbon::now()->addWeek()->setTime('23', '59', '59');
        $tasks = Task::where('taskable_type', null)->where('user_id',auth()->id())->where('deadline_date', '>=', $today)
            ->where('deadline_date', '<=', $week)->where('status_id','!=','1')->get();
        $customers = Task::where('user_id',auth()->id())->where('deadline_date', '>=', $today)
            ->where('deadline_date', '<=', $week)->where('status_id',1)->hasMorph(
            'taskable',
            'App\Customer'
        )->get();
        $meetings = Task::where('user_id',auth()->id())->where('deadline_date', '>=', $today)
            ->where('deadline_date', '<=', $week)->where('status_id','!=','1')->hasMorph(
            'taskable',
            'App\Meeting'
        )->get();

        $calls = Call::where('user_id', auth()->id())->get()->reverse();
        return view('home',[
            'plan' => $plan,
            'tasks' => $tasks,
            'customers' => $customers,
            'meetings' => $meetings,
            'calls' => $calls,
        ]);
    }
}
