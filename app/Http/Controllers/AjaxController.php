<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function balance_get(Request $request)
    {
        $user = User::find($request->user_id);

        if ($request->ajax()){
            return response()->json([
                'status' => "success",
                'balance' => $user->balance,
            ], 200);
        }
    }
}
