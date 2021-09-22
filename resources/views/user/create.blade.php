@extends('layouts.app')

@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Create User </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="tile">
                <form action="{{route('user.store')}}" method="post">
                    @csrf
                    <div class="tile-body">

                        <div class="form-group">
                            <label class="control-label" for="first_name">First Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @if ($errors->has('first_name')) is-invalid @endif" type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"/>
                            @if ($errors->has('first_name')) {{ $errors->first('first_name') }} @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="last_name">Last Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @if ($errors->has('last_name')) is-invalid @endif" type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"/>
                            @if ($errors->has('first_name')) {{ $errors->first('first_name') }} @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="email">Email <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @if ($errors->has('email')) is-invalid @endif" type="text" name="email" id="email" value="{{ old('email') }}"/>
                            @if ($errors->has('email')) {{ $errors->first('email') }} @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="password">Password <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @if ($errors->has('password')) is-invalid @endif" type="password" name="password" id="password" />
                            @if ($errors->has('password')) {{ $errors->first('password') }} @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="user_type">User Type <span class="m-l-5 text-danger"> *</span></label>
                            <select id="user_type" class="form-control" name="user_type">
                                <option selected value="blogger">Blogger</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="admin">Admin</option>
                            </select>
                            @if ($errors->has('description')) {{ $errors->first('description') }} @endif
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('blog.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
