<?php

namespace App\Http\Controllers;




use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function index()
    {
//
//        $view_tasks = User::join("tasks", function ($join) {
//            $join->on("tasks.user_id", "=", "users.id");
//        })->get();

        $user_id =Auth::user()->id;
        $view_tasks = Task::with('user')->where('user_id',$user_id)->get();
       // dd($view_tasks);

        return view('dashboards.user.index',['view_tasks'=>$view_tasks]);


    }
}
