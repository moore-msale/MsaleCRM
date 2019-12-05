<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('changeDB');
    }


    public function searchTask(Request $request)
    {
        $search = $request->search;
        if(auth()->user()->role=='admin'){
            $result = collect(['Задачи' => Task::where([['taskable_type' ,null],['title', 'like', "%$search%"]])->orWhere([['taskable_type' ,null],['description', 'like', "%$search%"]])->get()]);
        }else{
            $result = collect(['Задачи' => Task::where([['taskable_type' ,null],['title', 'like', "%$search%"],['user_id',auth()->id()]])->orWhere([['taskable_type' ,null],['description', 'like', "%$search%"],['user_id',auth()->id()]])->get()]);
        }

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
            if(auth()->user()->role=='admin'){
                $result = collect(['Встречи' => Task::where([['taskable_type', 'App\Meeting'],['title', 'like', "%$search%"]])->orWhere([['taskable_type', 'App\Meeting'],['description', 'like', "%$search%"]])->get()]);
            }else{
                $result = collect(['Встречи' => Task::where([['taskable_type', 'App\Meeting'],['title', 'like', "%$search%"],['user_id',auth()->id()]])->orWhere([['taskable_type', 'App\Meeting'],['description', 'like', "%$search%"],['user_id',auth()->id()]])->get()]);
            }
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
        $result = collect(['Клиенты' => Customer::where('company', 'like', "%$search%")->orWhere('contacts', 'like', "%$search%")->orWhere('name', 'like', "%$search%")->get()]);
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
