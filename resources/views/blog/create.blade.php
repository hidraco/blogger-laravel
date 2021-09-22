@extends('layouts.app')

@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Create Blog </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="tile">
                <form action="{{route('blog.store')}}" method="post">
                    @csrf
                    <div class="tile-body">

                        <div class="form-group">
                            <label class="control-label" for="name">Blog Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @if ($errors->has('name')) is-invalid @endif" type="text" name="name" id="name" value="{{ old('name') }}"/>
                            @if ($errors->has('name')) {{ $errors->first('name') }} @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea
                                class="form-control @if ($errors->has('description')) is-invalid @endif"
                                name="description"
                                rows="10"
                                id="description">{{ old('description') }}</textarea>
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
