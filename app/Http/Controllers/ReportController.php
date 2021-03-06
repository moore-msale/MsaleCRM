<?php

namespace App\Http\Controllers;

use App\Mail\ReportGeneration;
use App\Mail\SendReport;
use App\Plan;
use App\Report;
use App\User;
use Carbon\Carbon;
use foo\bar;
use GuzzleHttp\Client;
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
        $admin = User::find(1);
        foreach ($users as $user) {
            if($user->role != 'admin') {
                $report = Report::where('created_at', '>=', $today)->where('user_id', $user->id)->first();
                if (Carbon::now()->englishDayOfWeek != "Sunday") {
                    if ($report == null) {
                        $user->balance = $user->balance - 400;
                        $user->save();
                    }
                }

                $plan = Plan::where('created_at', '>=', $today)->where('user_id', $user->id)->first();
                if (Carbon::now()->englishDayOfWeek != "Sunday") {
                    if ($plan != null) {
                        if ($plan->calls_score >= 60 && $plan->meets_score >= 0 && $plan->status != 1) {
                            $plan->status = 1;
                            $plan->save();
                        } elseif ($plan->calls_score >= 30 && $plan->meets_score >= 1 && $plan->status != 1) {
                            $plan->status = 1;
                            $plan->save();
                        } elseif ($plan->calls_score >= 0 && $plan->meets_score >= 2 && $plan->status != 1) {
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
                                $penalty = $user->balance - isset($user->penalty) ? $user->penalty : $admin->penalty;
                                $user->balance = $penalty;
                                $user->save();
                            }
                        }
                    }else{
                        $plan = new Plan();
                        $plan->calls_goal = isset($user->calls) ? $user->calls : $admin->calls;
                        $plan->calls_score = 0;
                        $plan->meets_goal = isset($user->meetings) ? $user->meetings : $admin->meetings;
                        $plan->meets_score = 0;
                        $plan->status = 3;
                        $plan->user_id = $user->id;
                        $plan->save();
                    }
                }
            }
        }

        $plans = Plan::where('created_at','>=',$today)->where('user_id', '!=', 1)->get();
//        $client = new Client();
//        foreach ($plans as $plan)
//        {
//            $user = User::find($plan->user_id)->name;
//            $url = "https://api.telegram.org/bot925882756:AAEt3HsNT_PWsK_bYFzhFqXZUaq34Ayiz0c/sendMessage?chat_id=600765954&text=$user\"";
//            $response = $client->request('POST', $url);
//            $url = "https://api.telegram.org/bot925882756:AAEt3HsNT_PWsK_bYFzhFqXZUaq34Ayiz0c/sendMessage?chat_id=600765954&text=Звонков: $plan->calls_score\"";
//            $response = $client->request('POST', $url);
//            $url = "https://api.telegram.org/bot925882756:AAEt3HsNT_PWsK_bYFzhFqXZUaq34Ayiz0c/sendMessage?chat_id=600765954&text=Встреч: $plan->meets_score\"";
//            $response = $client->request('POST', $url);
//        }

        Mail::to('buvladi@gmail.com')->send(new SendReport($plans));
        return back();
    }
}
