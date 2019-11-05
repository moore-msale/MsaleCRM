<?php

namespace App\Http\Controllers;

use App\Plan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = collect();
        $month = Carbon::now()->month-1;
//        dd($month);
        $users = User::where('role','!=','admin')->get();

        foreach ($users as $user)
        {
            $full = count(Plan::whereMonth('created_at',$month)->where('user_id',$user->id)->get());
            $current = count(Plan::whereMonth('created_at', $month)->where('user_id',$user->id)->where('status', 1)->get());
            if($full != 0 && $current != 0)
            {
            $kpd = (100 / $full) * $current;
            $kpd = (int)$kpd;
            $statistics->push([$user->id => $kpd]);
            }
            else
            {
                $statistics->push([$user->id => 0]);
            }
        }
        return view('pages.Statistic.statistic',['statistics' => $statistics]);
    }
}
