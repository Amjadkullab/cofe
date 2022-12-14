
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Business Casual - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('front_asset/css/styles.css')}}" rel="stylesheet" />
        @if(App::isLocale('ar'))
            <style>

                body{
                    direction: rtl;
                    text-align: right;
                }


            </style>
            @endif
            <ul>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                @if(App::currentLocale()!=$localeCode)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>

                @endif
                @endforeach
            </ul>


    </head>
    <body>
        <header>
            <h1 class="site-heading text-center text-faded d-none d-lg-block">

                <span class="site-heading-upper text-primary mb-3">{{__('general.title')}}</span>

                <span class="site-heading-lower">{{__('general.site_name')}}</span>
            </h1>

        </header>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="{{route('home')}}">{{__('general.header')}}</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="{{route('about')}}">{{__('general.header1')}}</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="{{route('products')}}">{{__('general.header2')}}</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="{{route('store')}}">{{__('general.header3')}}</a></li>
                    </ul>
                </div>
            </div>
        </nav>
       @yield('content')

        <footer class="footer text-faded text-center py-5">
            <div class="container"><p class="m-0 small">{{__('general.footer')}} &copy; {{env('APP_NAME')}}     ({{now()->year}}-{{now()->year+1}})</p></div>
        </footer>
        <script> const UserId={{Auth::id()}}; </script>
        <script src="{{asset('js/app.js')}}"></script>
        <!-- Bootstrap core JS-->
        <script src="{{asset('front_asset/https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Core theme JS-->
        <script src="{{asset('front_asset/js/scripts.js')}}"></script>
    </body>
</html>

