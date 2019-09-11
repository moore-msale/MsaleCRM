<?php

namespace App\Http\Controllers;

use App\Mail\ReportGeneration;
use App\Report;
use App\User;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all()->groupBy('user_id');


//        dd($reports[1]);
        return view('report.report',['reports' => $reports]);
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
}
