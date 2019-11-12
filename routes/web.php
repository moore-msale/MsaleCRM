<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/call_to_customer', 'CallController@call_to_customer')->name('call_to_customer');
    Route::post('/calldelete', 'CallController@delete')->name('calldelete');


    Route::resource('task', 'TaskController');
    Route::post('add_1_call', 'CallController@add_1_call')->name('call_1_add');
    Route::resource('customer', 'CustomerController');
    Route::post('/customerdelete', 'CustomerController@delete')->name('customerdelete');
    Route::post('/customerdone', 'CustomerController@done')->name('customerdone');
    Route::post('/customerupdate', 'CustomerController@update')->name('customerupdate');
    Route::post('/customerchange', 'CustomerController@change')->name('customerchange');
    Route::post('/taskdelete', 'TaskController@delete')->name('taskdelete');
    Route::post('/taskdone', 'TaskController@done')->name('taskdone');
    Route::post('/taskupdate', 'TaskController@update')->name('taskupdate');
    Route::resource('meeting', 'MeetingController');
    Route::post('/meetdelete', 'MeetingController@delete')->name('meetdelete');
    Route::post('/meetdone', 'MeetingController@done')->name('meetdone');
    Route::post('/meetupdate', 'MeetingController@update')->name('meetupdate');
    Route::resource('report', 'ReportController');
    Route::get('/excel/create', 'ExcelController@create')->name('excel.create');
    Route::post('/excel', 'ExcelController@import')->name('excel.import');
    Route::get('/delete/calls', 'CallController@cronDelete');
    Route::get('/mail', 'ReportController@mail');
    Route::post('/callw', 'CallController@waitCall')->name('callw');
    Route::post('/calln', 'CallController@notCall')->name('calln');
    Route::get('/clearCall', 'CallController@call_clear')->name('clearCall');
    Route::post('/balance_change', 'ReportController@balance')->name('balance_change');
    Route::get('/planer','PlanController@planer')->name('planer');


    Route::get('/waitCall', function () {
        return view('pages.waitCall',['calls' => \App\Call::where('user_id', auth()->id())->where('active',1)->get()->reverse()]);
    });
    Route::get('/notCall', function () {
        return view('pages.notCall', ['calls' => \App\Call::where('user_id', auth()->id())->where('active',2)->get()->reverse()]);
    });
    Route::get('/tasks_admin', function () {
        return view('pages.Tasks.task_page_admin', ['tasks' => \App\Task::where('taskable_type', null)->get()->reverse()]);
    });
    Route::get('/tasks', function () {
        return view('pages.Tasks.task_page', ['tasks' => \App\Task::where('taskable_type', null)->where('user_id',auth()->id())->get()->reverse()]);
    });
    Route::get('/meets_admin', function () {
        return view('pages.Meets.meet_page_admin', ['tasks' => \App\Task::where('taskable_type','App\Meeting')->get()->reverse() ]);
    });
    Route::get('/meets', function () {
        return view('pages.Meets.meet_page', ['tasks' => \App\Task::where('taskable_type','App\Meeting')->where('user_id', auth()->id())->get()->reverse()]);
    });
    Route::get('/statistic','StatisticController@index')->name('statistic');
    Route::post('/balance_get', 'AjaxController@balance_get')->name('balance_get');
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::post('/editUser', 'UserController@editUser')->name('editUser');
    Route::get('/blockuser/{id}','UserController@blockUser')->name('blockuser');
    Route::get('/archive','UserController@archive')->name('archive');


    //admin routes
    Route::post('/DoneTaskAdmin', 'AdminController@done_task')->name('DoneTaskAdmin');
    Route::post('/DeleteTaskAdmin', 'AdminController@delete_task')->name('DeleteTaskAdmin');
    Route::post('/EditTaskAdmin', 'AdminController@edit_task')->name('EditTaskAdmin');

    Route::post('/DoneMeetAdmin', 'AdminController@done_meet')->name('DoneMeetAdmin');
    Route::post('/DeleteMeetAdmin', 'AdminController@delete_meet')->name('DeleteMeetAdmin');
    Route::post('/EditMeetAdmin', 'AdminController@edit_meet')->name('EditMeetAdmin');

    Route::post('/DoneCustomerAdmin', 'AdminController@done_customer')->name('DoneCustomerAdmin');
    Route::post('/DeleteCustomerAdmin', 'AdminController@delete_customer')->name('DeleteCustomerAdmin');
    Route::post('/EditCustomerAdmin', 'AdminController@edit_customer')->name('EditCustomerAdmin');
});
Route::get('/penalty_for_the_end_day','ReportController@penalty')->name('penalty_for_the_end_day');
Route::get('/manager_push_notification', 'NotificationController@notification')->name('manager_push_notification');

