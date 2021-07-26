<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Products;
use App\Models\Task;
use Illuminate\Http\Request;
use Auth;

class TaskController extends Controller
{
    public function addTask(TaskRequest $request)
    {

//        try {
            $request->validated();

            $task = new Task();
            $task->title = $request['title'];
            $task->description = $request['desc'];
            $task->user_id = Auth::user()->id;
            $task->save();
            return redirect()->back()->with('success', __('messages.success'));


       // } catch (\Throwable $e) {
       //     (report($e));
       //     return redirect()->back()->with('danger', __('messages.old_pass_error'));
      //  }
    }

    public function updateSectionStatus(Request $request)
    {
//dd($request);

        try {

            if ($request->ajax()) {
                $data = $request->all();
                //dd($data);
                if ($data['status']=='new') {
                    $status = 0;

                }else{
                    $status = 1;

                }
                Task::where('id', $data['task_id'])->update(['status' => $status]);
                return response()->json(['status' => $status, 'task_id' => $data['task_id']]);
            }
            }
        catch
            (\Throwable $e) {
                (report($e));
                return redirect()->back()->with('danger', __('messages.error'));

            }
    }

    public function deleteTask($id)
    {
        try {

            $delete = Task::find($id);
            $delete->delete();
            return redirect()->back()->with('danger', __('messages.delete'));
        } catch (\Throwable $e) {
            (report($e));
            return redirect()->back()->with('danger', __('messages.error'));

        }
    }
}
