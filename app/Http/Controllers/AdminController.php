<?php

namespace App\Http\Controllers;



use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        try {

          $view_task = User::with('task')->get();
        //dd($view_task);
            return view('dashboards.admin.index',['view_task'=>$view_task]);

        } catch
        (\Throwable $e) {
            (report($e));
            return redirect()->back()->with('danger', __('messages.old_pass_error'));
        }

    }


}
