<?php

namespace App\Http\Controllers;

use App\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function planer()
    {
        $plans = Plan::where('created_at','<=',Carbon::now()->month(9)->day(30))->where('user_id','!=',1)->get();

        return view('pages.planer',['plans' => $plans->groupBy('user_id')]);
    }
}
