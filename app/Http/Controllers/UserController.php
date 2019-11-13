<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        if($user->role == 'admin')
        {
            return view('pages.Users.profile_admin', ['user' => $user]);
        }
        else
        {
            return view('pages.Users.profile', ['user' => $user]);
        }

    }

    public function editUser(Request $request)
    {
//        dd($request->file('avatar'));
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->address = $request->address;
        if($request->password)
        {
            $user->password = Hash::make($request['password']);
        }

        $user->save();
        if($file = $request->file('scan_pas')){
            $name = 'user_pas'.$user->id.$user->email;
            if ($file->move('passport', $name))
            {
                $user->scan_pas = mb_strtolower($name);
                $user->save();
            }
        }
        if($file = $request->file('scan2_pas')){
            $name = 'user_pas2'.$user->id.$user->email;
            if ($file->move('passport', $name))
            {
                $user->scan2_pas = mb_strtolower($name);
                $user->save();
            }
        }
        if($file = $request->file('avatar')){
            $name = 'user_img'.$user->id.$user->email;
            if ($file->move('users', $name))
            {
                $user->avatar = mb_strtolower($name);
                $user->save();
            }
        }

        $user->save();
//        if ($request->ajax()){
//            return response()->json([
//                'status' => "success",
//                'data' => $request->all(),
//            ], 200);
//        }

        return back();

    }
    public function archive()
    {
        $user = Auth::user();
        if($user->role == 'admin')
        {
            return view('pages.Users.archive_users');
        }

    }

    public function blockUser($id){
        $user = User::find($id);
        $user->status = 'blocked';
        $user->save();
        return back();
    }


    public function activateUser($id){
        $user = User::find($id);
        $user->status = 'active';
        $user->save();
        return back();
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        return back();
    }

}
