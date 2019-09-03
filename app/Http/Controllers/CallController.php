<?php

namespace App\Http\Controllers;

use App\Call;
use App\Customer;
use Illuminate\Http\Request;

class CallController extends Controller
{
    //

    public function call_to_customer(Request $request)
    {
        $call = Call::find($request->id);
        $customer = New Customer();
        $customer->name = $call->title;
        $customer->contacts = $call->phone;
        $customer->company = $call->company;
        $customer->save();

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'data' => $customer,
                'view' => view('tasks.potentials-card', [
                    'customer' => $customer,
                ])->render(),
            ], 200);
        }

        return back();
    }
}
