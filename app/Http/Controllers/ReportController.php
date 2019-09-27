<?php

namespace App\Http\Controllers;

use App\Mail\ReportGeneration;
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
}
