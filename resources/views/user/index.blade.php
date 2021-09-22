@extends('layouts.app')

@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Users </h1>
        </div>
        @if(auth()->user()->is_admin)
            <a href="{{route('user.create')}}" class="btn btn-outline-dark pull-right">Create user</a>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form id="search-form">
                        <div class=" form-inline float-right mb-3">
                            <label for="search" class="mr-2 font-weight-bold">Search </label>
                            <input type="text" id="search" class="form-control w-250" name="search" value="{{ request()->get('search', '') }}">
                        </div>
                    </form>
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
                        @forelse($users as $user)
                            <tr>
                                <td> {{$user->id}} </td>
                                <td> {{$user->name}} </td>
                                <td> {{$user->email}} </td>
                                <td> {{$user->user_type }} </td>
                                <td> {{$user->last_login ? $user->last_login->format('d M Y H:i'):'' }} </td>
                                <td> {{$user->created_at->format('d M Y H:i')}} </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{route('user.show', $user->id)}}" class="btn btn-sm btn-info">show</a>
                                        @if(auth()->user()->is_admin)
                                            <a href="{{route('user.edit', $user->id)}}" class="btn btn-sm btn-primary">edit</a>
                                            <form action="{{route('user.destroy', $user->id)}}" method="post">
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
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var globalTimeout = null;
        $(document).ready( function ()  {
            $("#search").on('keyup', function () {

                if (globalTimeout != null) {
                    clearTimeout(globalTimeout);
                }
                globalTimeout = setTimeout(function() {
                    globalTimeout = null;
                    $("#search-form").submit();
                }, 500);
            });
        })

    </script>
@endsection
