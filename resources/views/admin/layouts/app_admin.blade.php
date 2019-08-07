<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="/css/chartjs/Chart.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="/js/ckeditor5/ckeditor.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                        Izzyme
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toogle" data-toggle="dropdown" role="button" area-expanded="false">Пользователи</a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{{ route('admin.user_managment.user.index') }}">Показать</a></li>
                          <li><a href="{{ route('admin.user_managment.user.create') }}">Добавить</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toogle" data-toggle="dropdown" role="button" area-expanded="false">Компании</a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{{ route('admin.company.index') }}">Показать</a></li>
                          <li><a href="{{ route('admin.company.create') }}">Добавить</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toogle" data-toggle="dropdown" role="button" area-expanded="false">Точки</a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{{ route('admin.points.index') }}">Показать</a></li>
                          <li><a href="{{ route('admin.points.create') }}">Добавить</a></li>
                        </ul>
                      </li>
                      <li><a href="{{ route('admin.posts.index') }}">Посты</a></li>
                      <li><a href="{{ route('admin.statistics') }}">Статистика</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/chartjs/Chart.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/myscript.js"></script>
</body>
</html>
