<?php

namespace App\Http\Controllers;

use App\Call;
use App\Imports\CallsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function create()
    {
        return view('excel');
    }

    public function import(Request $request)
    {
        $excel = $request->excel;
        if ($excel) {
            $calls = Excel::toCollection(CallsImport::class, $excel)->collapse();
            $calls2 = Call::all();
            if (count($calls)) {
                foreach ($calls2 as $call2) {
                    foreach ($calls as $call) {
                        if($call2->company == $call[1] || $call2->phone = $call[2] )
                        {
                            continue;
                        }
                        else {
                            $newCall = new Call();
                            $newCall->name = $call[0];
                            $newCall->phone = $call[2];
                            $newCall->company = $call[1];
                            $newCall->user_id = auth()->id();
                            $newCall->save();
                        }
                    }
                }
                Session::flash('excel_status', 'success');
            }
        } else {
            Session::flash('excel_status', 'error');
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'view' => view('tasks.list', [
                    'calls3' => Call::where('user_id', auth()->id())->get(),
                ])->render(),
            ]);
        }

        return redirect()->back();
    }
}
