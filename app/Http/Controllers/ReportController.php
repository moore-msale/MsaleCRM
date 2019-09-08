<?php

namespace App\Http\Controllers;

use App\Mail\ReportGeneration;
use App\Report;
use App\User;
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
    public function mail(Request $request)
    {
        $user = User::find(1);
        $reports = $user->reports;

        return new ReportGeneration($reports);

//        Mail::to($user)->send(new ReportGeneration($reports));

//        return 0;
    }
}
