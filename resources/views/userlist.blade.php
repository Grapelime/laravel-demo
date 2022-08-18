@extends('adminlayout.main')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User List</h1>
            <a href="{{ route('register') }}" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm">Create a New
                User</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User List</h6>
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
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th class="text-center">Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $dataa)
                                <tr>
                                    <td>{{ $dataa->name }}</td>
                                    <td>{{ $dataa->email }}</td>
                                    <td>{{ $dataa->phnumber }}</td>
                                    <td class="text-center"><a href="{{ route('admin/editusers', $dataa->id) }}"
                                            class="btn btn-outline-success">Edit</a>
                                        <a href="{{ route('admin/deleteusers', $dataa->id) }}"
                                            class="btn btn-outline-danger ">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
            {{ $data->links('pagination::bootstrap-5') }}
        </div>

    </div>

    </div>
@endsection
