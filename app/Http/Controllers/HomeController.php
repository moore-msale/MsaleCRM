<?php

namespace App\Http\Controllers;

use App\Call;
use App\Customer;
use App\Meeting;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $week = Carbon::now()->addWeek();
        $tasks = Task::where('taskable_type', null)->where('user_id',auth()->id())->where('deadline_date', '>=', $today)
            ->where('deadline_date', '<=', $week)->get();
        $customers = Task::where('user_id',auth()->id())->where('deadline_date', '>=', $today)
            ->where('deadline_date', '<=', $week)->hasMorph(
            'taskable',
            'App\Customer'
        )->get();
        $meetings = Task::where('user_id',auth()->id())->where('deadline_date', '>=', $today)
            ->where('deadline_date', '<=', $week)->hasMorph(
            'taskable',
            'App\Meeting'
        )->get();

        $calls = Call::where('user_id', auth()->id())->get();
        return view('home',[
            'tasks' => $tasks,
            'customers' => $customers,
            'meetings' => $meetings,
            'calls' => $calls,
        ]);
    }
}
