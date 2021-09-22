<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle color-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->last_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                               href="javascript:void(0)"
                               data-toggle="modal"
                               data-target="#updateProfile">Update Profile</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                    <!-- Modal -->
                    <div id="updateProfile" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <form action="{{route('update-profile')}}" method="post">
                                @csrf
                                <!-- Modal content-->
                                <div class="modal-content text-black-50">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Update Profile Info</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="prof_first_name">First Name</label>
                                            <input type="text" class="form-control" id="prof_first_name" name="first_name" value="{{auth()->user()->first_name}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="prof_last_name">Last Name</label>
                                            <input type="text" class="form-control" id="prof_last_name" name="last_name" value="{{auth()->user()->last_name}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="prof_password">Password</label>
                                            <input type="password" class="form-control" id="prof_password" name="password">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-outline-primary" >Update</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                @endguest
            </ul>
        </div>
    </div>
</nav>
