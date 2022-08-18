@extends('adminlayout.main')

@section('content')
    <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Task </h1>
            <a href="{{ route('admin/tasklist') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">View All
                Tasks</a>
        </div>
        <div id="solid">
            <div class="card mb-4">
                <div class="card-header">Add Task</div>
                <div class="card-body">
                    <!-- Component Preview-->
                    <div class="sbp-preview">
                        <div class="sbp-preview-content">
                            <form method="post" action="{{ route('admin/addtasks') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">Task Name</label>
                                    <input class="form-control form-control-solid @error('title') is-invalid @enderror"
                                        id="exampleFormControlInput1" type="text" name="title">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1">Task Description</label>
                                    <textarea class="form-control form-control-solid @error('description') is-invalid @enderror"
                                        id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                                </div>
                                <div class="mb-3">
                                <input type="hidden" value="" name ="created_time" id="localtime">
                                    <label for="exampleFormControlduedate">Task Due Date</label>
                                    <input name="duedate"
                                        class="form-control form-control-solid @error('duedate') is-invalid @enderror"
                                        type="text" onfocus="(this.type='date')" onblur="(this.type='text')"
                                        id="date">
                                </div>
                                @error('duedate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1">Task Assigned To</label>
                            <select class="form-control form-control-solid @error('assignedto') is-invalid @enderror"
                                id="exampleFormControlSelect1" name="assignedto">
                                <option value="">assigned to</option>
                                @foreach ($name as $name)
                                    <option value="{{ $name->id }}">{{ $name['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect2">Example multiple select</label>
                            <select class="form-control form-control-solid @error('status') is-invalid @enderror"
                                id="exampleFormControlSelect2" multiple="" name="status">
                                <option>Assigned</option>
                                <option>In progress</option>
                                <option>Completed</option>
                                <option>Pending</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="Submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            <script>
          function getLocaltime(){
              return new Date().toLocaleTimeString();
             }
             document.getElementById('localtime').value=getLocaltime()
            </script>
            @endsection
