@extends('adminlayout.main')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Reset Password</h1>
            <a href="{{ route('admin/addtask') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="text-white-50"></i>Back</a>
        </div>
        <div id="solid">
            <div class="card mb-4">
                <div class="card-header">reset password</div>
                <div class="card-body">
                    <!-- Component Preview-->
                    <div class="sbp-preview">
                        <div class="sbp-preview-content">
                            @if (session()->get('success'))
                                <span style="color:green">{{ session()->get('success') }}
                                </span>
                            @endif
                            @if (!session()->get('success'))
                                @if (session()->get('fail'))
                                    <span style="color:red">{{ session()->get('fail') }}
                                    </span>
                                @endif
                            @endif
                            <form method="post" action="{{ route('resetpassword') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">Old Password</label>
                                    <input
                                        class="form-control form-control-solid @error('oldpassword') is-invalid @enderror"
                                        id="exampleFormControlInput1" type="text" name="oldpassword">
                                    @error('oldpassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">New Password</label>
                                    <input
                                        class="form-control form-control-solid @error('newpassword') is-invalid @enderror"
                                        id="exampleFormControlInput1" type="text" name="newpassword">
                                    @error('newpassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1">Confirm Password</label>
                                    <input
                                        class="form-control form-control-solid @error('confirmpassword') is-invalid @enderror"
                                        id="exampleFormControlInput1" type="text" name="confirmpassword">
                                    @error('confirmpassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
