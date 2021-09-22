<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}" href=" {{route('dashboard')}} ">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>

        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'blog.index' ? 'active' : '' }}" href="{{ route('blog.index') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Blogs</span>
            </a>
        </li>
        @if(in_array(auth()->user()->user_type , [\App\Models\User::USER_SUPERVISOR_TYPE, \App\Models\User::USER_ADMIN_TYPE]))
            <li>
                <a class="app-menu__item {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}" href="{{ route('user.index') }}">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Users</span>
                </a>
            </li>
        @endif
        @if(auth()->user()->is_admin)
            <li>
                <a class="app-menu__item {{ Route::currentRouteName() == 'supervisors.index' ? 'active' : '' }}" href="{{ route('supervisors.index') }}">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Supervisors</span>
                </a>
            </li>
        @endif
    </ul>
</aside>
