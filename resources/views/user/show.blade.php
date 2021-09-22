@extends('layouts.app')

@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Update User </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="tile">
                <div class="tile-body">
                    <div class="form-group">
                        <label class="control-label" for="first_name">First Name <span class="m-l-5 text-danger"> *</span></label>
                        <input disabled class="form-control @if ($errors->has('first_name')) is-invalid @endif" type="text" name="first_name" id="first_name" value="{{ $user->first_name }}"/>
                        @if ($errors->has('first_name')) {{ $errors->first('first_name') }} @endif
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="last_name">Last Name <span class="m-l-5 text-danger"> *</span></label>
                        <input disabled class="form-control @if ($errors->has('last_name')) is-invalid @endif" type="text" name="last_name" id="last_name" value="{{ $user->last_name }}"/>
                        @if ($errors->has('first_name')) {{ $errors->first('first_name') }} @endif
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="email">Email <span class="m-l-5 text-danger"> *</span></label>
                        <input disabled class="form-control @if ($errors->has('email')) is-invalid @endif" type="text" name="email" id="email" value="{{ $user->email }}"/>
                        @if ($errors->has('email')) {{ $errors->first('email') }} @endif
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="user_type">User Type <span class="m-l-5 text-danger"> *</span></label>
                        <select id="user_type" class="form-control" disabled name="user_type">
                            <option value="blogger" @if($user->user_type == 'blogger') selected @endif >Blogger</option>
                            <option value="supervisor" @if($user->user_type == 'supervisor') selected @endif >Supervisor</option>
                            <option value="admin" @if($user->user_type == 'admin') selected @endif >Admin</option>
                        </select>
                        @if ($errors->has('description')) {{ $errors->first('description') }} @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="assign-blogger">Assign Bloggers</label>
                        <select id="assign-blogger" class="form-control" disabled name="assign_bloggers[]" multiple>
                            @foreach($bloggers as $id => $name)
                                <option value="{{$id}}" @if(in_array($id ,  $assigned_bloggers)) selected @endif >{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tile-footer">

                    <a class="btn btn-secondary" href="{{ route('user.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </div>
        </div>
    </div>
    @if($user->is_supervisor)
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-title">
                        Assigned Bloggers
                    </div>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> User Type </th>
                                <th> Last Login </th>
                                <th> Created At </th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($user->assignedBloggers as $usr)
                                <tr>
                                    <td> {{$usr->id}} </td>
                                    <td> {{$usr->name}} </td>
                                    <td> {{$usr->email}} </td>
                                    <td> {{$usr->user_type }} </td>
                                    <td> {{$usr->last_login ? $user->last_login->format('d M Y H:i'):'' }} </td>
                                    <td> {{$usr->created_at->format('d M Y H:i')}} </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{route('user.show', $usr->id)}}" class="btn btn-sm btn-info">show</a>
                                            @if(auth()->user()->is_admin)
                                                <a href="{{route('user.edit', $usr->id)}}" class="btn btn-sm btn-primary">edit</a>
                                                <form action="{{route('user.destroy', $usr->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger">delete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">No records founds</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
