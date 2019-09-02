<?php

namespace App\Http\Controllers;

use App\Call;
use App\Customer;
use App\Meeting;
use App\Task;
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
        $tasks = Task::doesntHaveMorph(
            'taskable',
            ['App\Customer', 'App\Meeting']
        )->get();
        $customers = Task::hasMorph(
            'taskable',
            'App\Customer'
        )->get();
        $meetings = Task::hasMorph(
            'taskable',
            'App\Meeting'
        )->get();
        return view('home',[
            'tasks' => $tasks,
            'customers' => $customers,
            'meetings' => $meetings
        ]);
    }
}
