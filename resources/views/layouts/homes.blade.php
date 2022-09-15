<!doctype html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1 height=device-height">
    <!-- CSRF Token -->
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css')}}">
    @yield('style')
</head>
<body>

<div class="d-flex flex-column flex-shrink-0 p-3 sidenav navbar-expand-md  ">
   <div class="row">
    <a href="/" class=" col-11 d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4 "> {{str_replace( '_',' ',config('app.name', 'Laravel')) }}</span>

    </a>
    <button class="col-1 navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"
    style="position:relative;bottom: 5px; right: 10px;">
       <i class="fa fa-bars" aria-hidden="true"></i>
    </button></div>
    <hr>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="nav nav-pills flex-column mb-auto accordion" id="accordionExample">
            <li class="nav-item">
                <a href="{{Route('home')}}" class="nav-link active" aria-current="page">
                    Home
                </a>
            </li>
            <li class="nav-item">

                <div class="accordion-item">


                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">

                            Incomings
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ">
                                <li><a href="{{Route('incoming-add')}}" class="btn-link rounded">Add
                                        new
                                        incomings</a>
                                </li>

                                <li><a href="{{route('incoming-dis-date')}}" class="btn-link rounded">Display incomings
                                        by
                                        date</a>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
            </li>
            <li class="nav-item">

                <div class="accordion-item">

                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Outgoings
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ">
                                <li><a href="{{Route('outgoing-add')}}" class="btn-link rounded">Add
                                        new
                                        outgoings</a></li>

                                <li><a href="{{route('outgoing-dis-date')}}" class="btn-link rounded">Display outgoings
                                        by
                                        date</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">

                <div class="accordion-item">

                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false    " aria-controls="collapseThree">

                            Dashboard

                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ">

                                <li><a href="{{ route('yearly-dashboard') }}" class="btn-link rounded">Yearly</a></li>
                                <li><a href="{{ route('monthly-dashboard') }}" class="btn-link rounded">Monthly</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <hr>

                <div class="nav-item">
                    <div class=" accordion dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                           id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                                 class="rounded-circle me-2">
                            <strong>{{Auth::user()->name}}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();
                           ">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>

    </div>
</div>
<div class="logo">
    <h2>Manage your money</h2>
    <hr class="hr">
</div>
<div class="container content">

    @yield('content-container')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>

</body>
</html>
