<!doctype html>
<html lang="ru">
<head>
    @include('includes.head')
    <title>@yield('title')</title>
    @yield('head')
    @php $hour = (int)date('H', time() + 60 * 60 * 3); @endphp
    <style>
        html {
            @if ($hour >= 22 || $hour <= 4)
            background-image: url('/images/system/bg-night.png');
            @elseif ($hour >= 4 && $hour <= 10)
            background-image: url('/images/system/bg-dawn.png');
            @elseif ($hour >= 10 && $hour <= 16)
            background-image: url('/images/system/bg-day.png');
            @elseif ($hour >= 16 && $hour <= 22)
            background-image: url('/images/system/bg-sunset.png');
            @endif
        }
        .text-block {
            background-color: white;
            box-shadow: 0 0 7px 5px white;
        }
    </style>
</head>
<body>
    @include('includes.header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-9">
                @yield('content')
            </div>
            <div class="col-12 col-md-3" id="js-sidebar">
                <div class="text-block mt-3 mr-1">
                    @include('includes.menu')
                    <hr>
                    @yield('sidebar')
                </div>
            </div>
        </div>
    </div>
    @include('includes.controls.message')
</body>
</html>
