@extends('layouts.app')

@section('content')
   <div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">Task</div>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('danger'))
                    <div class="alert alert-danger">{{ Session::get('danger') }}</div>
                @endif

                <div class="card-body">
                    <div border="1" class="table-responsive">
                        <table class="table table-striped table-bordered" id="dt">

                            <thead class="text-primary">
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($view_task))
                                @foreach($view_task as $task)

                                    <tr>
                                        @if(!empty($task->task))
                                            @foreach($task->task as $tasks)

                                                <td>{{$tasks->id}}</td>
                                                <td>{{$tasks->user->name}}</td>
                                                <td>{{$tasks->title}}</td>
                                                <td>{{$tasks->description}}</td>


                                        <td>
                                            @if($tasks->status==1)
                                                <a class="updateSectionStatus" id="task-{{$tasks->id}}" task_id="{{$tasks->id}}" href="javscript:void(0)">New</a>
                                            @else
                                                <a class="updateSectionStatus" id="task-{{$tasks->id}}" task_id="{{$tasks->id}}"  href="javscript:void(0)">pending</a>
                                                @endif
                                        </td>


                                        <td>
                                            <form action="{{url('admin/delete-task/'.$tasks->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                            @endforeach
                                        @endif
                                    </tr>


                                @endforeach
                            @endif
                            </tbody>
                            <tfoot class="text-primary">
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
       <script type='text/javascript'>

           $(document).ready(function() {

               $('.updateSectionStatus').click(function () {


                       var status = $(this).text();
                       var task_id = $(this).attr('task_id');

                   $.ajax({
                       type: 'post',
                       url: '/admin/update-task-status',
                       data: {status: status,task_id:task_id,_token: '{{csrf_token()}}'},
                       success: function (resp) {

                           if (resp['status'] == 1) {
                               $("#task-"+ task_id).html("<a class='updateSectionStatus'  href='javscript:void(0);'>new</a>")
                           }else if(resp['status'] == 0) {
                               $("#task-"+ task_id).html("<a class='updateSectionStatus'  href='javscript:void(0);'>pending</a>")
                           }
                       },error:function (){
                           alert('error');
                       }

                   });

               });
           });


       </script>

@endsection









