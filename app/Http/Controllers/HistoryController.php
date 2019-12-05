<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
class HistoryController extends Controller
{
    public function delete($id){
        $history = History::find($id);
        $history->delete();

        return response()->json(['status' => "success"], 200);
     }
}
