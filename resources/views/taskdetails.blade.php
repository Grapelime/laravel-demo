@extends('adminlayout.main')

@section('content')
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            width: 300px;
            padding: 5px
        }

        .geeks {
            border-right: hidden;
        }

        .gfg {
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        h1 {
            color: green;
        }

        .custom {
            left: 700px;
        }

        @media (max-width: 1176px) {
            .custom {
                left: 600px;
            }
        }

        @media (max-width: 1085px) {
            .custom {
                left: 500px;
            }
        }

        @media (max-width: 991px) {
            .custom {
                left: 400px;
            }
        }

        @media (max-width: 882px) {
            .custom {
                left: 300px;
            }
        }

        @media (max-width: 776px) {
            .custom {
                left: 200px;
            }
        }

        @media (max-width: 600px) {
            .custom {
                left: 100px;
            }
        }
    </style>
    <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
        </div>
        <script>
            function boss() {
                const button = document.getElementById('btnupdate');
                const select = document.getElementById('select');
                if (select.value != '') {
                    button.disabled = false
                } else {
                    button.disabled = true
                }
            }
            
        </script>


        <div id="solid">
            <div class="card mb-4">
                <div class="card-header position relative">Task
                    <div class="d-inline position-absolute custom">
                        <form method="post" action="{{ route('user/update_status', $data->id) }}"
                            class="d-inline position-relative">
                            @csrf
                            <select class="select-class @error('status') is-invalid @enderror" onchange="boss()"
                                name="status" id="select">
                                <option value="">Update status</option>
                                <option>In progress</option>
                                <option>Completed</option>

                            </select>
                            <input type="hidden" value="" name ="created_time" id="localtime">
                            <button type="submit" id="btnupdate" disabled
                                class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm">Update</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Component Preview-->
                    <div class="sbp-preview">
                        <div class="sbp-preview-content">
                            <div class="row">
                                <table style="margin:10px">
                                    <tr>
                                        <th>Title</th>
                                        <th>: {{ $data->title }}</th>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <th>: {{ $data->description }}</th>
                                    </tr>
                                    <tr>
                                        <th>Created On</th>
                                        <th>: {{ $data->date }}</th>
                                    </tr>
                                    <tr>
                                        <th>Due Date</th>
                                        <th>: {{ $data->due_date }}</th>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <th>: {{ $data->status }}</th>
                                    </tr>
                                    <tr>
                                        <th>Last Updated Date</th>
                                        <th>: {{ $data->updated_at_date }}</th>
                                    </tr>
                                    <tr>
                                        <th>Last Updated Time</th>
                                        <th>: {{ $data->updated_time }}</th>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
          function getLocaltime(){
              return new Date().toLocaleTimeString();
             }
             document.getElementById('localtime').value=getLocaltime()
            </script>
@endsection
