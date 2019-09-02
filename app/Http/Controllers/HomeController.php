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
        $tasks = Task::all();
        $potentials = Customer::all();
        $meetings = Meeting::all();
        $calls = Call::all();
        return view('home',['tasks' => $tasks, 'potentials' => $potentials, 'meetings' => $meetings, 'calls' => $calls]);
    }
}
