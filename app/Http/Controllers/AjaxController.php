<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function searchTask(Request $request)
    {
        $search = $request->search;
        $result = collect(['Задачи' => Task::where('title', 'like', "%$search%")->where('taskable_type', null)->get()]);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('_partials.search-result-ajax', [
                    'result' => $result,
//                    'count' => count($result->collapse()),
                ])->render(),
            ]);
        }
        return view('_partials.search-result', [
            'result' => $result,
        ]);
    }
}
