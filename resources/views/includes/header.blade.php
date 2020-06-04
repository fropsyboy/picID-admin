<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <b>
{{--                    <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />--}}
{{--                    <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />--}}
                </b>
                <span>
                    <img src="{{asset('assets/images/Logo-white.png')}}" alt="homepage" class="dark-logo" >
                    <img src="{{asset('assets/images/Logo-white.png')}}" class="light-logo" alt="homepage" />
                </span>
            </a>
        </div>

        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                <!-- <li class="nav-item">
                    <form class="app-search d-none d-md-block d-lg-block">
                        <input type="text" class="form-control" placeholder="Search & enter">
                    </form>
                </li> -->
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown">
                   

                </li>


                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    

                    <span class="hidden-md-down">{{ Auth::user()->name }} &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">

                        <a href="{{route('profile')}}" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                        <div class="dropdown-divider"></div>

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
                <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
            </ul>
        </div>
    </nav>
</header>
