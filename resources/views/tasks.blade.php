@extends('adminlayout.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Task List</h1>
            <a href="{{ route('admin/addtask') }}" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create a New
                Task</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All TAsks</h6>
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
                            <th>Last Updated</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th class="text-center">Actions </th>
                        </tr>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>{{ $data->date }}</td>
                                    <td>{{ $data->due_date }}</td>
                                    <td>{{$data->updated_at_date}}   <br>  {{ $data->updated_time }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->assigned_to->name }}</td>
                                    <td>
                                        <a href="{{ route('admin/edittask', $data->id) }}"
                                            class="btn btn-outline-primary">edit</a>
                                        <a href="{{ route('admin/deletetask', $data->id) }}" class="btn btn-outline-danger"
                                            onclick="deletecall()" id="taskdelete">delete</a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
                {{ $datas->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>
    </div>
    <script>
        function deletecall() {
            let x = confirm('Do You Want to delete')
            if (!x) {
                event.preventDefault();
            }
        }
    </script>
@endsection
