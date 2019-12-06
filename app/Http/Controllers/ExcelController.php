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
            if (count($calls)) {
                    foreach ($calls as $call) {
                        if($call[0] and $call[1])
                        {
                            $newCall = new Call();
                            $newCall->phone = $call[1];
                            $newCall->company = $call[0];
                            $newCall->user_id = auth()->id();
                            $newCall->save();
                        }
//
                }
                Session::flash('excel_status', 'success');
            }
        } else {
            Session::flash('excel_status', 'error');
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $calls,
                'view' => view('tasks.list', [
                    'calls3' => Call::where('user_id', auth()->id())->get(),
                ])->render(),
            ]);
        }

        return redirect()->back();
    }
}
