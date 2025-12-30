@php
    $user = DB::table('users')->where('is_admin', 1)->get();
@endphp
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="{{ url('/') }}" class="logo" target="_blank"><i class="md md-terrain"></i> <span>{{auth()->user()->name }}</span></a>
        </div>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left">
                        <i class="fa fa-bars"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                    </li>

                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                                <img src="{{ auth()->user()->photo ? asset('uploads/user/' . auth()->user()->photo) : asset('uploads/default.png') }}" alt="User Photo" width="50" height="50">           
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin.profile.edit') }}"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="{{ route('admin.password.change') }}"><i class="fa fa-key"></i> Change Password</a></li>
                            <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
