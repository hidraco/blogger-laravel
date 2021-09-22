@extends('layouts.app')

@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Blogs </h1>
        </div>
        <a href="{{route('blog.create')}}" class="btn btn-outline-dark pull-right">Create Blog</a>
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
                            <th> Description </th>
                            <th> Created By </th>
                            <th> Created At </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($blogs as $blog)
                            <tr>
                                <td> {{$blog->id}} </td>
                                <td> {{$blog->name}} </td>
                                <td> {{substr($blog->description, 0, 10) }}... </td>
                                <td> {{$blog->createdBy->name}} </td>
                                <td> {{$blog->created_at->format('d M Y H:i')}} </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{route('blog.edit', $blog->id)}}" class="btn btn-sm btn-primary">edit</a>
                                        <form action="{{route('blog.destroy', $blog->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger">delete</button>
                                        </form>
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
                    {{$blogs->links()}}
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
