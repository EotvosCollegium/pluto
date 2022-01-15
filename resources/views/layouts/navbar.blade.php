<!--navbar-->
<div class="navbar-fixed">
    <nav class="top-nav">
        <div class="nav-wrapper">
            <div class="row">
                <!--sidenav trigger for mobile-->
                <a href="#" data-target="sidenav" class="sidenav-trigger hide-on-large-only"><i
                        class="material-icons">menu</i></a>
                <!--title-->
                <div class="col hide-on-med-and-down noselect" style="margin-left:310px">
                    @yield('title')
                </div>

                <!-- Right Side Of Navbar -->
                <ul class="right">
                    @guest
                        <li><a class="waves-effect" href="{{ route('login') }}">@lang('user.login')</a></li>
                        <li><a class="waves-effect" href="{{ route('register') }}">@lang('user.register')</a></li>
                    @else
                        <li><a class="waves-effect" href="https://laravel.com/docs/8.x" target="_blank">Laravel</a></li>
                        <li><a class="waves-effect" href="https://www.php.net/docs.php" target="_blank">PHP</a></li>
                        <li><a class="waves-effect" href="https://materializecss.github.io/materialize/" target="_blank">Materialize</a></li>
                        {{-- account settings --}}
                        <li><a class="waves-effect" href="{{ route('user') }}"><i class="material-icons left">account_circle</i>{{ auth()->user()->name }}</a></li>
                                                        {{-- 192.168.10.10/user --}}
                        @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>

<!--sidebar-->
<ul class="sidenav sidenav-fixed" id="sidenav">
    <!-- logo -->
    @include('layouts.logo')

      
    <li>
        <ul class="collapsible collapsible-accordion">
            {{-- Accounts --}}
            <li><a class="waves-effect" href="{{ route('accounts.index') }}"><i class="material-icons left">account_balance</i>Accounts</a>
            {{-- Todos --}}
            <li><a class="waves-effect" href="{{ route('todos.index') }}"><i class="material-icons left">done</i>@lang('todo.todos')</a>
            <!-- language select -->
            <li>
                <a class="collapsible-header waves-effect" style="padding-left:32px">
                    <i class="material-icons left">language</i>Language
                    <i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        @foreach (config('app.locales') as $locale)
                        <li><a class="waves-effect" href="{{ route('setlocale', $locale) }}">{{ $locale }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
        </ul>
    </li>

    <!-- logout -->
    @auth
        <li>
            <a class="waves-effect" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="material-icons left">login</i>@lang('user.logout')
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth
</ul>

