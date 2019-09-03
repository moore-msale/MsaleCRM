<?php


namespace App\Cron;


use App\Call;
use Illuminate\Support\Facades\DB;

class DeleteCalls
{
    public static function delete()
    {
        DB::table('calls')->delete();
        echo 'deleted';
    }
}
