@extends('layouts.app')

@section('content')

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{ __('Dashboard') }}</div>

                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('danger'))
                    <div class="alert alert-danger">{{ Session::get('danger') }}</div>
                @endif

                <h1>{{__('messages.add-task')}}</h1>


                <form action="{{url('user/add-task')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="control-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="title" value="{{old('title')}}">
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc" class="control-label">Description</label>
                        <textarea  class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{old('desc')}}"></textarea>
                        @error('desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>
        </div>
    </div>
</div>
</div>

<div class="task">
    @if(!empty($view_tasks))
        @foreach($view_tasks as $task)
            <div class="box">
                <div class="box1">

                    <p>{{$task->user->name}}</p>
                    <p>{{$task->title}}</p>
                    <p>{{$task->description}}</p>
                    <p>
                        @if($task->status ==1)
                            New
                        @else
                        pending
                            @endif
                    </p>


                </div>
            </div>
        @endforeach
    @endif








</body>
</html>
@endsection
