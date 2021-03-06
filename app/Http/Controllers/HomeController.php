<?php

namespace App\Http\Controllers;

use App\Call;
use App\Customer;
use App\Meeting;
use App\Plan;
use App\Report;
use App\Status;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','changeDB']);
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
        $tomorrow = Carbon::tomorrow()->setTime('00','00','00');


        $report = Report::where('created_at','>=',$today)->where('user_id', \auth()->id())->first();
        if ($report == null)
        {
            $report = new Report();
            $report->user_id = \auth()->id();
            $report->type = 0;
            $report->data = collect([
                'calls_not' => new Collection(),
                'calls' => new Collection(),
                'task_store' => new Collection(),
                'task_done' => new Collection(),
                'task_delete' => new Collection(),
                'task_update' => new Collection(),
                'meet_store' => new Collection(),
                'meet_done' => new Collection(),
                'meet_update' => new Collection(),
                'meet_delete' => new Collection(),
                'custom_store' => new Collection(),
                'custom_delete' => new Collection(),
                'custom_potencial' => new Collection(),
                'custom_update' => new Collection(),
                'custom_done' => new Collection()
            ]);
            $report->status = 0;
            $report->save();
        }
        $plan = Plan::where('created_at','>=',$today)->where('user_id',auth()->id())->first();
            if($plan == null)
            {
                $admin = User::find(1);
                $plan = New Plan();
                if(auth()->user()->calls){
                    $plan->calls_goal = auth()->user()->calls;
                }else{
                    $plan->calls_goal = $admin->calls;
                }
                if(auth()->user()->meets){
                    $plan->meets_goal = auth()->user()->meetings;
                }else {
                    $plan->meets_goal = $admin->meetings;
               }
                $plan->calls_score = 0;
                $plan->meets_score = 0;
                $plan->user_id = auth()->id();
                $plan->save();
            }
//            if($plan->calls_score >= 60 && $plan->meets_score >= 0 && $plan->status != 1)
//            {
//                $plan->status = 1;
//                $plan->save();
//            }
//            elseif($plan->calls_score >= 30 && $plan->meets_score >= 1 && $plan->status != 1)
//            {
//                $plan->status = 1;
//                $plan->save();
//            }
//            elseif($plan->calls_score >= 0 && $plan->meets_score >= 2 && $plan->status != 1)
//            {
//                $plan->status = 1;
//                $plan->save();
//            }
            $user = Auth::user();
            if (Carbon::yesterday()->month != Carbon::now()->month)
            {
                $user->balance = 0;
                $user->save();
            }

        $penalty = $user->balance;
        $week = Carbon::now()->addWeek()->setTime('23', '59', '59');
        $tasks = Task::where('taskable_type', null)->where('user_id',auth()->id())->where('deadline_date', '>=', $today)->get();
        if(Auth::user()->role == 'admin')
        {
            $customers = Task::where('status_id','=', 1)->hasMorph(
                'taskable',
                'App\Customer'
            )->get();
        }
        else
        {
            $customers = Task::where('user_id',auth()->id())->where('deadline_date', '>=', $today)->where('status_id','=', 1)->hasMorph(
                'taskable',
                'App\Customer'
            )->get();
        }
        if(Auth::user()->role == 'admin'){
            $meetings = Task::where('deadline_date', '>=', $today)->hasMorph(
                'taskable',
                'App\Meeting'
            )->get();
        }else{
            $meetings = Task::where('user_id',auth()->id())->where('deadline_date', '>=', $today)->hasMorph(
                'taskable',
                'App\Meeting'
            )->get();
        }


        $calls = Call::where('user_id', auth()->id())->where('active',0)->get()->reverse();
        $wcalls = Call::where('user_id', auth()->id())->where('active',1)->get()->reverse();
        return view('home',[
            'plan' => $plan,
            'tasks' => $tasks,
            'customers' => $customers,
            'meetings' => $meetings,
            'calls' => $calls,
            'wcalls' => $wcalls,
            'penalty' => $penalty
        ]);
    }

    public function settings()
    {
        $statuses = Status::all();

        return view('pages.settings.settings',['statuses' => $statuses])->with('alert', 'hello');
    }
}
