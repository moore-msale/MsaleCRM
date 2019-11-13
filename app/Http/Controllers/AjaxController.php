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
        $result = collect(['Задачи' => Task::where('taskable_type', null)->where('title', 'like', "%$search%")->orWhere('description','like',"%$search%")->orWhere('deadline_date','like',"%$search%")->get()]);
        $count = count($result);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('_partials.search_result', [
                    'result' => $result,
                    'count' => $count,
                ])->render(),
            ]);
        }

        return view('_partials.search-result', [
            'result' => $result,
        ]);
    }
}
