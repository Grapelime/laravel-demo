@extends('adminlayout.main')

@section('content')
    <div class="container">
        <div>
            <div class="d-flex justify-content-center align-items-center">

                <div class="col-12">

                    <h1 class="h3 mb-0 text-gray-800">Update Task</h1>
                    <form method="post" action="{{ route('admin/edittasks', $data->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label> Task title</label>
                            <input type="text" name="title" placeholder="title" value="{{ $data->title }}"
                                class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Task Description</label>
                            <input type="text" name="description" value="{{ $data->description }}"
                                placeholder="Description" class="form-control @error('description') is-invalid @enderror"
                                id="exampleInputPassword1">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Due Date</label>
                            <input placeholder="Due Date" name="duedate" value="{{ $data->due_date }}"
                                class="form-control @error('duedate') is-invalid @enderror" type="text"
                                onfocus="(this.type='date')" onblur="(this.type='text')" id="date">
                        </div>
                        @error('duedate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="mb-3">
                            <label>Assigned To</label>
                            <select class="form-control @error('assignedto') is-invalid @enderror" name="assignedto">
                                <option value="{{ $data->assigned_to_id }}">{{ $data->assigned_to_name }}</option>
                                @foreach ($name as $name)
                                    @if ($data->assigned_to_name != $name->name)
                                        <option value="{{ $name->id }}">{{ $name->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('assignedto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Task Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status">
                                <option value="">{{ $data->status }}</option>
                                
                                <option>In progress</option>
                                <option>Completed</option>
                                <option>Pending</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
