@extends('layouts.app')

@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Dashboard</h1>
        </div>
        <a class="btn btn-primary pull-right"
           href="javascript:void(0)"
           data-toggle="modal"
           data-target="#updateProfile">Update Profile</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="row">
                        <div class="col-4">
                            <b>First Name</b>: {{auth()->user()->first_name}} <br>
                            <b>Last Name</b>: {{auth()->user()->last_name}} <br>
                            <b>Email</b>: {{auth()->user()->email}} <br>
                            <b>Register At</b>: {{auth()->user()->created_at->format('d M Y H:i')}} <br>
                            <b>Last Login</b>: {{auth()->user()->last_login->format('d M Y H:i')}} <br>
                        </div>
                        <div class="col-4">
                            <b>Total blogs</b>: {{ $total_blogs }} <br>
                            @if(auth()->user()->is_admin || auth()->user()->is_supervisor)
                                <b>Total {{auth()->user()->is_supervisor? "Assigned ":""}}Users</b>: {{ $total_users }}
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
