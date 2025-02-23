<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html" charset=utf-8 />

    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    @yield('cssAndJs')
</head>

<body class="">
    <div class="row m-0">
        <div class="col-2 side_bar" style="height: 100vh;position:fixed;top:0;right:0;z-index:22">

            <div class="my-2">
                <img class="img-fluid w-50" src="{{ asset('images/logo.jpg') }}">

                <h4 class="text-white mt-2">{{ \Illuminate\Support\Facades\Auth::user()->name }}</h4>
            </div>


            <hr style="color: #fff" />

            <div class="text-end">

                <a href="{{ route('index') }}">

                    <div class="menu_item @if (request()->routeIs('dashboard.index')) menu_item_active @endif">
                        <i class="fa-solid fa-house mx-2"></i>
                        Home
                    </div>
                </a>


                <a href="{{ route('members.index') }}">
                    <div class="menu_item @if (request()->routeIs('members.*')) menu_item_active @endif">
                        <i class="fa-solid fa-users mx-2"></i>
                        المسجلين
                    </div>
                </a>

                <a href="{{ route('offered_courses.index') }}">
                    <div class="menu_item @if (request()->routeIs('offered_corses.*')) menu_item_active @endif">
                        <i class="fa-solid fa-book mx-2"></i>
                        الكورسات المتوفرة
                    </div>
                </a>

                <a href="{{ route('courses.index') }}">
                    <div class="menu_item @if (request()->routeIs('courses.*')) menu_item_active @endif">
                        <i class="fa-solid fa-chalkboard-teacher mx-2"></i>
                        الدورات التدريبية
                    </div>
                </a>

                <a href="{{ route('stages.index') }}">
                    <div class="menu_item @if (request()->routeIs('stages.*')) menu_item_active @endif">
                        <i class="fa-solid fa-flag mx-2"></i>
                         المراحل
                    </div>
                </a>

                <a href="{{ route('logout') }}">
                    <div class="menu_item ">
                        <i class="fa-solid fa-house mx-2"></i>
                        Logout
                    </div>
                </a>
            </div>
        </div>
        <div class="col-2 side_bar" style="height: 100vh;"></div>
        <div class="col-10 p-0 m-0">
            <div class="p-2">
                @yield('main')
            </div>
        </div>
    </div>


</body>

</html>
