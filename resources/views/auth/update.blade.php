@extends('adminlayout.main')

@section('content')
    <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            <a href="{{ route('admin/users') }}" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i>View All Users</a>
        </div>
        <div id="solid">
            <div class="card mb-4">
                <div class="card-header">Add Users</div>
                <div class="card-body">
                    <!-- Component Preview-->
                    <div class="sbp-preview">
                        <div class="sbp-preview-content">
                            <form method="post" action="{{ route('admin/updateuser', $data->id) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">First Name</label>
                                    <input type="text"
                                        class="form-control form-control-solid  @error('fname') is-invalid @enderror"
                                        name="fname" id="exampleFirstName" value="{{ $data->fname }}">
                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">Last Name</label>
                                    <input type="text"
                                        class="form-control form-control-solid  @error('lname') is-invalid @enderror"
                                        name="lname" id="exampleFirstName" value="{{ $data->lname }}">
                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">Email</label>
                                    <input type="email"
                                        class="form-control form-control-solid  @error('email') is-invalid @enderror"
                                        name="email" id="exampleFirstName" value="{{ $data->email }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">Contact Number</label>
                                    <input type="number"
                                        class="form-control form-control-solid  @error('phno') is-invalid @enderror"
                                        name="phno" id="exampleFirstName" value="{{ $data->phnumber }}">
                                    @error('phno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <button type="Submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>


                    </div>
                @endsection
