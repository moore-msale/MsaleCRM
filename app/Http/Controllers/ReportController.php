<?php

namespace App\Http\Controllers;

use App\Mail\ReportGeneration;
use App\Mail\SendReport;
use App\Plan;
use App\Report;
use App\User;
use Carbon\Carbon;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function index(Request $request)
    {

            $startDate = Carbon::make($request->date);
            $endDate = Carbon::make($startDate)->setTime('23','59','59');
            $reports = Report::where('created_at','>=',$startDate)->where('created_at','<=', $endDate)->get();
        return view('report.reports',['reports' => $reports]);
    }

    public function balance(Request $request)
    {
        $user = User::find($request->id);
        $user->balance = $request->balance;
        $user->save();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $user,
            ], 200);
        }

        return back();

    }
    public function mail(Request $request)
    {
        $user = User::find(1);
        $reports = $user->reports;

        return new ReportGeneration($reports);

//        Mail::to($user)->send(new ReportGeneration($reports));

//        return 0;
    }

    public function penalty()
    {
        $today = Carbon::now()->setTime('00', '00');
        $endday = Carbon::now()->setTime('18','00','00');
        $users = User::all();

        foreach ($users as $user)
        {
            $report = Report::where('created_at','>=',$today)->where('user_id', $user->id)->first();
            if(Carbon::now()->englishDayOfWeek != "Sunday"){
            if($report == null)
            {
                $user->balance = $user->balance-400;
                $user->save();
            }
            }
            
            $plan = Plan::where('created_at','>=',$today)->where('user_id', $user->id)->first();
            if($plan != null) {
                if ($plan->calls_score >= 100 && $plan->meets_score >= 0 && $plan->status != 1) {
                    $plan->status = 1;
                    $plan->save();
                } elseif ($plan->calls_score >= 66 && $plan->meets_score >= 1 && $plan->status != 1) {
                    $plan->status = 1;
                    $plan->save();
                } elseif ($plan->calls_score >= 33 && $plan->meets_score >= 2 && $plan->status != 1) {
                    $plan->status = 1;
                    $plan->save();
                } elseif ($plan->calls_score >= 0 && $plan->meets_score >= 3 && $plan->status != 1) {
                    $plan->status = 1;
                    $plan->save();
                } elseif ($plan->status != 1 && $plan->status != 3 && Carbon::now()->englishDayOfWeek != "Sunday") {
                    $plan->status = 2;
                    $plan->save();
                }
                if (Carbon::now() > $endday) {
                    if ($plan->status == 2) {
                        $plan->status = 3;
                        $plan->save();
                        $user->balance = $user->balance - 400;
                        $user->save();
                    }
                }
            }
        }

        $plans = Plan::where('created_at','>=',$today)->where('user_id', '!=', 1)->get();
        Mail::to('mackinkenny@gmail.com')->send(new SendReport($plans));
        return back();
    }
}
