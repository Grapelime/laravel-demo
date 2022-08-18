@extends('adminlayout.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Task List</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Tasks</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    @if (session()->get('success'))
                        <span style="color:green">{{ session()->get('success') }}
                        </span>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created at</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions </th>
                        </tr>
                        <tr>
                            @foreach ($data as $data)
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->description }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->due_date }}</td>
                                <td>{{ $data->status }}</td>
                                <td><a href="{{ route('user/taskview', $data->id) }}"
                                        class="btn btn-outline-warning">View</a></td>
                        </tr>
                        @endforeach
                        <tbody>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
    </div>
@endsection
