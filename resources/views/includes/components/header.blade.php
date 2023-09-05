<header class="header fixed has-top-menu">

    <div class="logo-container">

        <a href="{{ url("/") }}" class="logo">
            <img src="{{ url("/public/HomeImages/Logo for expedition games.png") }}" width="300" height="70" alt="{{ config("app.name") }}"/>
        </a>
    </div>


    <!-- start: search & user box -->

    <div class="header-right">


        <span class="d-xl-inline-block">
<!-- @include("includes/partials/lang") -->

        </span>
        <!-- <span class="separator"></span> -->

        @guest
            <br>
            <span class="">
                {{ link_to('/login', __("label.login"), ['class' => 'btn btn-sm btn-default']) }}
                {{ link_to('/register', __("label.registration"), ['class' => 'btn btn-sm btn-default']) }}
                &nbsp;
        </span>
        @endguest




        @auth

            <span class="separator"></span>

            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <div class="profile-info" data-lock-name="{{ access()->user()->username }}" data-lock-email="{{ access()->user()->email }}">
                        <span class="name"></span>
                        @auth
                            <span class="name"> <span class="badge badge-pill badge-success">&nbsp;</span> {{  access()->user()->username }}</span>
                        @endauth
                    </div>
                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled">
                        <li class="divider"></li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="{{ route('user.profile', access()->user()) }}"><i
                                    class="fas fa-user"></i> @lang('label.my_profile')</a>
                        </li>
                        <li>
                            {{ Form::open(['route' => 'logout', 'id' => 'logout-form']) }}
                            {{ Form::close() }}
                            <a role="menuitem" tabindex="-1" href="{{ route("logout") }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="fas fa-power-off"></i> @lang("label.logout") </a>
                        </li>
                    </ul>
                </div>
            </div>

        @endauth
    </div>
    <!-- end: search & user box -->


</header>
