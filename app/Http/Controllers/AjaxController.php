<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('changeDB');
    } 


    public function searchTask(Request $request)
    {
        $search = $request->search;
        $result = collect(['Задачи' => Task::where('taskable_type', '')->where('title', 'like', "%$search%")->get()]);

//        $result = $result['Задачи']->merge(collect(Task::where('taskable_type', null)->where('description','like',"%$search%")->get()));
//        $result = $result->merge(collect(Task::where('taskable_type', null)->where('deadline_date','like',"%$search%")->get()));
//        dd($result);
        //        $result = collect(['Задачи' => Task::where(function ($query, $search) {
//            $query->where('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%")->orWhere('deadline_date', 'like', "%$search%");
//        })->get()]);

        $count = count($result);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('_partials.search_result_task', [
                    'result' => $result,
                    'count' => $count,
                ])->render(),
            ]);
        }

        return view('_partials.search-result', [
            'result' => $result,
        ]);
    }


     public function searchMeet(Request $request)
        {
            $search = $request->search;
            $result = collect(['Встречи' => Task::where('taskable_type', 'App\Meeting')->where('title', 'like', "%$search%")->get()]);

            $count = count($result);

            if ($request->ajax()) {
                return response()->json([
                    'html' => view('_partials.search_result_meet', [
                        'result' => $result,
                        'count' => $count,
                    ])->render(),
                ]);
            }

            return view('_partials.search-result', [
                'result' => $result,
            ]);
        }

    public function searchCustomer(Request $request)
    {
        $search = $request->search;
        $result = collect(['Клиенты' => Task::where('taskable_type', 'App\Customer')->where('title', 'like', "%$search%")->get()]);

        $count = count($result);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('_partials.search_result_customer', [
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
